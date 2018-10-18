<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Provider;
use App\State;
use Session;
use Illuminate\Support\Facades\Log;

class ProviderController extends Controller
{
    /**
     * ProviderController constructor.
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
        if(userHasPermission("listar_catalogo_proveedores")) {
            $providers = Provider::all();
            return view('catalogs.providers.index', compact('providers'));
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
        if(userHasPermission("crear_catalogo_proveedores")) {
            $provider = new Provider();
            $states = State::getSelectStates();
            return view('catalogs.providers.create', compact('provider', 'states'));
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        try{
            Provider::create($request->get('provider'));
            $request->session()->flash('message', 'Proveedor creado de manera correcta');
            return redirect()->route('providers.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission("editar_catalogo_proveedores")) {
            $provider = Provider::find($id);
            $states = State::getSelectStates();
            return view('catalogs.providers.edit', compact('provider', 'states'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        try{
            $provider->fill($request->get('provider'));
            $provider->save();
            $request->session()->flash('message', 'Proveedor actualizado de manera correcta');
            return redirect()->route('providers.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
                Session::flash('message', 'Proveedor eliminado correctamente');
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
