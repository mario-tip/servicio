<?php

namespace App\Http\Controllers;

use App\User;
use App\Role_user;
use App\Role;
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
    //   dd($request->all());
      $rule= [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'username' => 'required',
            'type_user' => 'required',
        ];
        $this->validate($request,$rule);

        dd($request->all());
        $request['is_central'] = 0;

        if ($request['admin_incident']) {
            
        }else{
            $request['admin_incident'] = 0;
        }

        $user =  User::create($request->all());

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
        $users_aux = User::all();

        foreach ($users_aux as $key => $user) {
            if($user->type_user == 1){
               $users[$user->id] = $user->name;
            }
            
          }

        return view('users.edit', compact('user_edit','roles','users'));
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
      // dd($user);
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

          $user->fill($request->all());
          $user->save();

          Role_user::where('user_id', $user->id)->update(['role_id' => $user->type_user]);

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
