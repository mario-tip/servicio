<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Role_user;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra todos los usuarios.
     * 
     * Se recuperan todos los usuarios, se recuperan todos los roles, en un ciclo foreach se asignan el nombre del role al que pertenece para que en el index.php  se muestre dependiendo el role 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        
        foreach ($users as $key => $user) {
            foreach ($roles as $key => $role) {
                if ($user->type_user == $role->id) {
                    $user['name_role'] = $role->name;
                }
            }
            
        }
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles_aux = Role::all();

        foreach ($roles_aux as $key => $role) {
            $roles[$role->id] = $role->name;
          }
        $users = User::all();

        // foreach ($users_aux as $key => $user) {
        //     $users[$user->id] = $user->name;
        // }

        return view('users.create',compact('roles','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $rule= [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'username' => 'required|unique:users',
            'type_user' => 'required',
        ];
        $this->validate($request,$rule);

        // dd($request->all());
        $request['is_central'] = 0;

        // 1 verifica que el campo exista en caso de que No se asigna un cero y en caso que SI se agrega un uno para saber si esta activo.
        if ($request['active_notification']) {
            $request['active_notification'] = 1;
        }else{
            $request['active_notification'] = 0;
        }

        // 2 verifica que el campo exista en caso de que No se asigna un cero y en caso que SI se agrega un uno para saber si esta activo.
        if ($request['active_notification_order']) {
            $request['active_notification_order'] = 1;
        }else{
            $request['active_notification_order'] = 0;
        }

        // 3 verifica que el campo exista en caso de que No se asigna un cero y en caso que SI se agrega un uno para saber si esta activo.
        if ($request['active_notification_end']) {
            $request['active_notification_end'] = 1;
        }else{
            $request['active_notification_end'] = 0;
        }

        // se Guarda el usuario.
        $user =  User::create($request->all());

        // 1 se valida  $request->notifications en caso verdadero se ejecuta un foreach para guardar a que usuarios se les va a notificar por la incidencia.
        if($request->notifications){
            foreach ($request->notifications as $key => $notification) {
                DB::table('user_notification')->insert([
                   'user_id' => $user->id,
                   'notification_id' => $notification,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               ]); 
            }
        }
        // 2 se valida  $request->notifications_order en caso verdadero se ejecuta un foreach para guardar a que usuarios se les va a notificar por la orden de servicio.
        if($request->notifications_order){
            foreach ($request->notifications_order as $key => $notification_order) {
                DB::table('user_notification_order')->insert([
                   'user_id' => $user->id,
                   'notification_order_id' => $notification_order,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               ]); 
            }
        }

        // 3 se valida  $request->notifications_order en caso verdadero se ejecuta un foreach para guardar a que usuarios se les va a notificar por el servicio terminado .
        if($request->notifications_end){
            foreach ($request->notifications_end as $key => $notification_end) {
                DB::table('user_notification_end')->insert([
                   'user_id' => $user->id,
                   'notification_end_id' => $notification_end,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               ]); 
            }
        }
       

        $data['role_id'] = $user->type_user;
        $data['user_id'] = $user->id;

        $role = Role_user::make($data);
        $role->save();

        Session::flash('message', 'User saved successfully!');
        return Redirect::to('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_edit = User::find($id);

        $roles_aux = Role::all();
        foreach ($roles_aux as $key => $role) {
            $roles[$role->id] = $role->name;
          }
        $users = User::all();

        // 1 usuarios activos para notificar incidencias
        $users_active = DB::table('users')
            ->join('user_notification', 'users.id', '=', 'user_notification.notification_id')
            ->select('users.*')
            ->where('user_notification.user_id', '=', $user_edit->id )
            ->get();
        // 2 usuarios activos para notificar ordenes de servicio 
        $users_active_order = DB::table('users')
            ->join('user_notification_order', 'users.id', '=', 'user_notification_order.notification_order_id')
            ->select('users.*')
            ->where('user_notification_order.user_id', '=', $user_edit->id )
            ->get();

        // 3 usuarios activos para notificar ordenes de servicio 
        $users_active_end = DB::table('users')
            ->join('user_notification_end', 'users.id', '=', 'user_notification_end.notification_end_id')
            ->select('users.*')
            ->where('user_notification_end.user_id', '=', $user_edit->id ) 
            ->get();

        // 1 foreach para asignar si esta activo el usuario o no.
        foreach ($users as $key => $user) {
            foreach ($users_active as $key => $user_active) {
                if ($user->name == $user_active->name ){
                    $user['active'] = true;
                }
            }
        }

        // 2 foreach para asignar si esta activo el usuario o no.
        foreach ($users as $key => $user) {
            foreach ($users_active_order as $key => $user_active_order) {
                if ($user->name == $user_active_order->name ){
                    $user['active_order'] = true;
                }
            }
        }

        // 3 foreach para asignar si esta activo el usuario o no.
        foreach ($users as $key => $user) {
            foreach ($users_active_end as $key => $user_active_end) {
                if ($user->name == $user_active_end->name ){
                    $user['active_end'] = true;
                }
            }
        }


        // ** en caso de ocuparse este foreach se ocupa para traer un arreglo de usuarios para mostrar en los select de la vista.
        // foreach ($users_aux as $key => $user) {
        //     if($user->type_user == 1){
        //        $users[$user->id] = $user->name;
        //     }
            
        //   }

        return view('users.edit', compact('user_edit','roles','users','users_active','users_active_order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
     
      $user_aux = $request->all();

      if ($user_aux['email'] == $user['email'] ) {
        $rule= [
              'name' => 'required',
              'email' => 'required|email|exists:users',
              'username' => 'required',
          ];
      }else {
        $rule= [
              'name' => 'required',
              'email' => 'required|email|unique:users,email',
              'username' => 'required',
          ];
      }

        $this->validate($request,$rule);

        if ($request['active_notification']) {
            $request['active_notification'] = 1;
        }else{
            $request['active_notification'] = 0;
        }


        if ($request['active_notification_order']) {
            $request['active_notification_order'] = 1;
        }else{
            $request['active_notification_order'] = 0;
        }

        if ($request['active_notification_end']) {
            $request['active_notification_end'] = 1;
        }else{
            $request['active_notification_end'] = 0;
        }
        
        
          $user->fill($request->all());
          $user->save();

          Role_user::where('user_id', $user->id)->update(['role_id' => $user->type_user]);


        $users_active = DB::table('users')
            ->join('user_notification', 'users.id', '=', 'user_notification.notification_id')
            ->select('users.*')
            ->where('user_notification.user_id', '=', $user->id)
            ->get();

        $users_active_order = DB::table('users')
            ->join('user_notification_order', 'users.id', '=', 'user_notification_order.notification_order_id')
            ->select('users.*')
            ->where('user_notification_order.user_id', '=', $user->id )
            ->get();

        $users_active_end = DB::table('users')
            ->join('user_notification_end', 'users.id', '=', 'user_notification_end.notification_end_id')
            ->select('users.*')
            ->where('user_notification_end.user_id', '=', $user->id ) 
            ->get();

        $data = array();
        $data2 = array();

        $data_order = array();
        $data_notifications_order = array();

        $data_end = array();
        $data_notifications_end = array();

        //---1---
        foreach ($users_active as $key => $user_active) {
            array_push ( $data , $user_active->id );
        }
        if($request->notifications){
            foreach ($request->notifications as $key => $notification_arr) {
                $aux = intval($notification_arr);
                array_push ( $data2 ,$aux); 
            }
        }

        //---2---
        foreach ($users_active_order as $key => $user_active_order) {
            array_push ( $data_order , $user_active_order->id );
        }
        if($request->notifications_order){
            foreach ($request->notifications_order as $key => $notification_arr_order) {
                $aux = intval($notification_arr_order);
                array_push ( $data_notifications_order ,$aux); 
            }
        }

        //---3---
        foreach ($users_active_end as $key => $user_active_end) {
            array_push ( $data_end , $user_active_end->id );
        }
        if($request->notifications_end){
            foreach ($request->notifications_end as $key => $notification_arr_end) {
                $aux = intval($notification_arr_end);
                array_push ( $data_notifications_end ,$aux); 
            }
        }
        
        //---1---
        $adds = array_diff($data2,$data); //este array contiene los usuarios a insertar.

        $deletes = array_diff($data,$data2); //este array contiene los usuarios a eliminar (Compara array 1 con uno o mas arrays y devuelve los valores de array 1 que no estan en los otros arrays  )

        //---2---
        $adds_order = array_diff($data_notifications_order,$data_order);//arreglo que contiene los id de los usuarios a insertar 

        $deletes_order = array_diff($data_order,$data_notifications_order);//arreglo que contiene los id de los usuarios a eliminar 
        
        //---3---
        $adds_end = array_diff($data_notifications_end,$data_end);//arreglo que contiene los id de los usuarios a insertar 

        $deletes_end = array_diff($data_end,$data_notifications_end);//arreglo que contiene los id de los usuarios a eliminar 

    

        //---1----
        foreach ($adds as $key => $add) {
            DB::table('user_notification')->insert([
               'user_id' => $user->id,
               'notification_id' => $add,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
           ]); 
        }

        foreach ($deletes as $key => $delete) {
            DB::table('user_notification')->where('user_id', '=', $user->id)
                                        ->where('notification_id', '=', $delete)
                                        ->delete();
        }
        //---2----
        foreach ($adds_order as $key => $add) {
            DB::table('user_notification_order')->insert([
               'user_id' => $user->id,
               'notification_order_id' => $add,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
           ]); 
        }

        foreach ($deletes_order as $key => $delete) {
            DB::table('user_notification_order')->where('user_id', '=', $user->id)
                                        ->where('notification_order_id', '=', $delete)
                                        ->delete();
        }

         //---3----
         foreach ($adds_end as $key => $add) {
            DB::table('user_notification_end')->insert([
               'user_id' => $user->id,
               'notification_end_id' => $add,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
           ]); 
        }

        foreach ($deletes_end as $key => $delete) {
            DB::table('user_notification_end')->where('user_id', '=', $user->id)
                                        ->where('notification_end_id', '=', $delete)
                                        ->delete();
        }

          Session::flash('message', 'User updated successfully!');
          return Redirect::to('/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        User::destroy($id);
        Session::flash('message', 'User deleted successfully!');
    }

    public function searchEmail(Request $request){ 
        $email = $request->input('email');

        if($request->ajax()){
            $carrier = User::where('email', $email)->first();

            $data = false;
            if(!empty($carrier)){
                if($carrier->email == strtolower($email) || $carrier->email == strtoupper($email)){
                    $data = true;
                }
            }else{
                $data = false;
            }

            return response()->json(array('success' => $data));
        }
    }
}
