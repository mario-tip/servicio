<?php

namespace App\Http\Controllers;

use App\User;
use App\Role_user;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      $rule= [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'username' => 'required',
        ];
        $this->validate($request,$rule);

        // dd($request->all());
        $user =  User::create($request->all());

        $data['role_id'] = $user->is_central;
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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


          // dd($user);
          $user->fill($request->all());
          $user->save();
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
