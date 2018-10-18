<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Location;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
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
        if(userHasPermission("listar_catalogo_ubicaciones")) {
            $locations = Location::all();
            return view('catalogs.locations.index', compact('locations'));
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
        if(userHasPermission("crear_catalogo_ubicaciones")) {

            $location = new Location();
            return view('catalogs.locations.create', compact('location'));
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        try{
            Location::create($request->get('location'));
            $request->session()->flash('message', 'Ubicación guardada correctamente');
            return redirect()->route('locations.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission("editar_catalogo_ubicaciones")) {
            $location = Location::find($id);
            return view('catalogs.locations.edit', compact('location'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        try{
            $location->fill($request->get('location'));
            $location->save();
            $request->session()->flash('message', 'Ubicación actualizada correctamente');
            return redirect()->route('locations.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['errors' => false];
        $location = Location::find($id);

        if(count($location->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        } else {
            try {
                $location->delete();
                Session::flash('message', 'Ubicación eliminada correctamente');
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
