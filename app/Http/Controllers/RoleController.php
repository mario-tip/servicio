<?php

namespace App\Http\Controllers;
use DB; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Categories_permission;
use App\Permission;
use App\Permission_role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Support\Facades\Session;



class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Muestra todos los roles existentes en el sistema.
     *
     * Se recuperan todos los roles y se pasan como parametro a la vista asignada (roles.index).
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(userHasPermission("listar_roles")) {

        $roles = Role::all();
       
        return view('roles.index', compact('roles'));

        }
        return \redirect()->back();
    }

    /**
     * Se va a crear un nuevo rol con los permisos que sean asignados.
     * 
     * Se recuperan las categorias por las que se agruparon los permisos, se recuperan todos los permisos y se pasan como parametros a la vista asignada 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Categories_permission::all();
        $permissions = Permission::all();
        return view('roles.create', compact('categories','permissions'));
    }

    /**
     * Guarda el nuevo role.
     * 
     * Se valida que el nombre del role sea requerido, se pone en mayusculas el campo display_name del role, y se guarda el nuevo role, se hace un ciclo foreach para guardar los permisos para ese nuevo role y se notifica que el role fue guardado exitosamente y al final se redirecciona a la pantalla index.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule= [
            'name' => 'required'
        ];

        $this->validate($request,$rule);
        
        $request['display_name'] = ucwords($request->name);

        $role =  Role::create($request->all());
        
        foreach ($request->permissions_arr as $key => $value) {
             DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]); 
         }
        
        Session::flash('message', 'Role saved successfully!');
        return Redirect::to('/roles');
        

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
     * Muestra la interfaz para editar el role.
     *
     * Se busca el role que vamos a editar, se recuperan los permisos que ya tiene ese role, se recuperan las categorias de los permisos y asi tambien todos los permisos, se ejecuta un ciclo foreach para sabe cuales son los permisos de el role a editar y se pasan a la vista para poder saber cuales son los checks a habilitar.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions_active = DB::table('permissions')
            ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->select('permissions.*')
            ->where('permission_role.role_id', '=', $role->id )
            ->get();
        
        $categories = Categories_permission::all();
        $permissions = Permission::all();

        foreach ($permissions as $key => $permission) {
            foreach ($permissions_active as $key => $permission_active) {
                if ($permission->name == $permission_active->name  ){
                    $permission['active'] = true;
                }
            }
        }
    return view('roles.edit', compact('permissions_active','role','categories','permissions'));
    }

    /**
     * Actualiza el role.
     * 
     * Se valida que el nombre sea requerido, y se actuliza el nombre del role, se declaran dos arreglos para controlar los permisos, el ciclo foreach inserta los $id de todos los permisos, el segundo for each inserta los $id de los permisos que ya estan activos en ese role que viene en el $request, el arreglo $adds contiene los $id de los permisos los cuales se van a insertar, el arreglo $deletes contiene los $id de los permisos que van a eliminarse de ese role, y el tercer ciclo foreach se ejecuta y se insertan los permisos el cuarto ciclo foreach elimina uno por uno los permisos que fueron removidos de ese role, para finalizar se notifica que el role fue actualizado exitosamente y se redirecciona a la pagina para seguir editando otros roles.  
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule= [
            'name' => 'required'
        ];

        $this->validate($request,$rule);

        Role::findOrFail($id)->update($request->all());

        $permissions = DB::table('permissions')
            ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->select('permissions.*')
            ->where('permission_role.role_id', '=', $id )  
            ->get();

        $data = array();
        $data2 = array();

        foreach ($permissions as $key => $permission) {
            array_push ( $data , $permission->id );
        }

        if($request->permissions_arr){
            foreach ($request->permissions_arr as $key => $permission_arr) {
                $aux = intval($permission_arr); 
                array_push ( $data2 ,$aux); 
            }
        }

        $adds = array_diff($data2,$data); //este array contiene los permisos a insertar.
        $deletes = array_diff($data,$data2); //este array contiene los permisos a eliminar 

        foreach ($adds as $key => $add) {
            DB::table('permission_role')->insert([
               'permission_id' => $add,
               'role_id' => $id,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
               
           ]); 
        }

        foreach ($deletes as $key => $delete) {
            DB::table('permission_role')->where('permission_id', '=', $delete)
                                        ->where('role_id', '=', $id)
                                        ->delete();
        }
        
        Session::flash('message', 'Roll update successfully!');
        return Redirect::to('/roles');
    }

    /**
     * Se eliminan los roles.
     * 
     * Se recupera el rol que vamos a eliminar, se recuperan todos los usuarios, el ciclo foreach busca si el role pertenece a un usuario, la condicion ($data) sabemos si el role pertenece a un usuario en caso de ser verdad no se puede eliminar el role, en caso contrario se elimina el role y todos los permisos que le pertenecen a el mismo, se notifica que el role fue eliminado y se retorna la bandera para saber si se elimino o no.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $users = User::all();

        $data = false; //variable auxiliar funciona como bandera 
        foreach ($users as $key => $user) {
            if ($user->type_user == $id) {
                $data = true;
            }else{
                
            }
        }
        
        if ($data) {
            
        }else{
            $role->delete();
            DB::table('permission_role')->where('role_id', '=', $id)->delete();
            Session::flash('message', 'Role deleted successfully.');
        }

        return response()->json(['success' => $data]);
    }


    

}
