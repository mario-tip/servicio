<?php

namespace App\Http\Controllers;
use DB; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $categories = Categories_permission::all();
        $permissions = Permission::all();
        // dd($permissions);
        return view('roles.create', compact('categories','permissions'));
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
            'name' => 'required'
        ];

        $this->validate($request,$rule);
        
        $request['display_name'] = ucwords($request->name);

        $role =  Role::create($request->all());

        // dd($role->id);
        
        foreach ($request->permissions_arr as $key => $value) {

             DB::table('permission_role')->insert([
                'permission_id' => $value,
                'role_id' => $role->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ]); 
         }
        
        Session::flash('message', 'Role saved successfully!');
        return Redirect::to('/roles');
        // dd($permission);

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
     * Update the specified resource in storage.
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
        // dd($id);

        $permissions = DB::table('permissions')
            ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->select('permissions.*')
            ->where('permission_role.role_id', '=', $id )
            ->get();

        // dd($permissions);

        dd($request->permissions_arr);

        foreach ($permissions as $key => $permission) {
            foreach ($request->permissions_arr as $key => $permission_arr) {
                if ($permission->id == $permission_arr ){
                    
                }else {
                    $data ['permission'] = $permission_arr;
                }
            }
        }

        dd($data);

        // dd($request->all());
        // dd("hola mundo");




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
