<?php
namespace App\Http\Controllers;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Log;
use App\Provider;
use App\State;
use Session;

class ProviderController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission("listar_catalogo_proveedores")) {
            $providers = Provider::all();
            return view('catalogs.providers.index', compact('providers'));
        }
        return redirect()->back();

    }

    public function create(){
        if(userHasPermission("crear_catalogo_proveedores")) {
            $provider = new Provider();
            $states = State::getSelectStates();
            return view('catalogs.providers.create', compact('provider', 'states'));
        }
        return redirect()->back();
    }

    public function store(ProviderRequest $request){
        try{
            Provider::create($request->get('provider'));
            $request->session()->flash('message', 'Provider successfully created');
            return redirect()->route('providers.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        if(userHasPermission("editar_catalogo_proveedores")) {
            $provider = Provider::find($id);
            $states = State::getSelectStates();
            return view('catalogs.providers.edit', compact('provider', 'states'));
        }
        return redirect()->back();
    }

    public function update(ProviderRequest $request, Provider $provider){
        try{
            $provider->fill($request->get('provider'));
            $provider->save();
            $request->session()->flash('message', 'Successfully updated provider');
            return redirect()->route('providers.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id){
        $response = ['errors' => false];
        $provider = Provider::find($id);

        if(count($provider->assets) > 0 || count($provider->products) > 0 || count($provider->receptions) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        }
        else {
            try {
                $provider->delete();
                Session::flash('message', 'Successfully eliminated provider');
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
