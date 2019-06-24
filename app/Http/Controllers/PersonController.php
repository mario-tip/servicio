<?php
namespace App\Http\Controllers;
use App\Http\Requests\PersonRequest;
use App\Department;
use App\Person;
use App\State;
use App\User;
use App\Customer;
use Session;

class PersonController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission("listar_catalogo_personas")) {
            $persons = Person::all();
            return view('catalogs.persons.index', compact('persons'));
        }
        return redirect()->back();
    }

    public function create(){
        if(userHasPermission("crear_catalogo_personas")) {
            $person = new Person();
            $requirements = $this->getRequirements();
            return view('catalogs.persons.create', compact('person','requirements'));
        }
        return redirect()->back();
    }

    private function getRequirements(){
        return [
            'states' => State::getSelectStates(),
            'departments' => Department::getSelectDepartments(),
            'customers' => Customer::orderBy('name', 'asc')->pluck('name','id')
        ];
    }

    public function store(PersonRequest $request){
        $person_data = $request->get('person');
         try {

            Person::create($person_data);
            $request->session()->flash('message', 'Person created successfully');
            return redirect()->route('persons.index');
         } catch(\Exception $e) {
             return redirect()->back()->withErrors($e->getMessage());
         }
    }

    public function edit($id){
        if(userHasPermission("editar_catalogo_personas")) {
            $person = Person::find($id);
            $requirements = $this->getRequirements();
            return view('catalogs.persons.edit', compact('person', 'requirements'));
        }
        return redirect()->back();
    }

    public function update(PersonRequest $request, Person $person){
        $person_data = $request->get('person');
        try {

            $person->fill($person_data)->save();
            $request->session()->flash('message', 'Person updated successfully');
            return redirect()->route('persons.index');

        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id){
        $response = ['errors' => false];
        $person = Person::find($id);

        if(count($person->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        }
        else {
            try {

                $person->delete();
                
                Session::flash('message', 'Person deleted successfully');
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
