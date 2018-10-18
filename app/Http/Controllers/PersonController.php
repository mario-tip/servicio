<?php
namespace App\Http\Controllers;

use App\Department;
use App\Person;
use App\User;
use App\State;
use App\Http\Requests\PersonRequest;
use Session;

class PersonController extends Controller
{

    /**
     * PersonController constructor.
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
        if(userHasPermission("listar_catalogo_personas")) {
            $persons = Person::all();
            return view('catalogs.persons.index', compact('persons'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(userHasPermission("crear_catalogo_personas")) {
            $person = new Person();
            $requirements = $this->getRequirements();
            return view('catalogs.persons.create', compact('person', 'requirements'));
        }
        return redirect()->back();
    }

    private function getRequirements()
    {
        return [
            'states' => State::getSelectStates(),
            'departments' => Department::getSelectDepartments()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $person_data = $request->get('person');
         try {
            /*$password = str_random(8);
            $user_data = [
                'username' => $person_data['email'],
                'password' => $password,
                'name' => $person_data['name'],
                'email' => $person_data['email']
            ];
            $user = User::create($user_data);
            $user->roles()->attach('4');
            $person_data['user_id'] = $user->id;*/
            Person::create($person_data);
            //$person->notifyCreatedUser($person_data['email'], $password);
            $request->session()->flash('message', 'Persona creada correctamente');
            return redirect()->route('persons.index');
         } catch(\Exception $e) {
             return redirect()->back()->withErrors($e->getMessage());
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission("editar_catalogo_personas")) {
            $person = Person::find($id);
            $requirements = $this->getRequirements();
            return view('catalogs.persons.edit', compact('person', 'requirements'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        $person_data = $request->get('person');
        /*$user_data = [
            'username' => $person_data['email'],
            'name' => $person_data['name'],
            'email' => $person_data['email']
        ];*/
        try {
            $person->fill($person_data)->save();
            //$person->user->fill($user_data)->save();
            $request->session()->flash('message', 'Persona actualizada correctamente');
            return redirect()->route('persons.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['errors' => false];
        $person = Person::find($id);

        if(count($person->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        }
        else {
            try {
                /*$person->user->roles()->detach();
                $user_id = $person->user->id;*/
                $person->delete();
                //User::destroy($user_id);
                Session::flash('message', 'Persona eliminada correctamente');
                return response()->json(['errors' => false]);
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['type_error'] = 'exception';
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors([$e->getMessage()])
                    ->render();
                return response()->json($response);
            }
        }
    }
}
