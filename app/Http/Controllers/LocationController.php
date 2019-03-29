<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Location;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(userHasPermission("listar_catalogo_ubicaciones")) {
            $locations = Location::all();
            return view('catalogs.locations.index', compact('locations'));
        }
        return redirect()->back();
    }

    public function create() {
        if(userHasPermission("crear_catalogo_ubicaciones")) {

            $location = new Location();
            return view('catalogs.locations.create', compact('location'));
        }
        return redirect()->back();
    }

    public function store(LocationRequest $request) {
        try{
            Location::create($request->get('location'));
            $request->session()->flash('message', 'Location saved successfully');
            return redirect()->route('locations.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id) {
        if(userHasPermission("editar_catalogo_ubicaciones")) {
            $location = Location::find($id);
            return view('catalogs.locations.edit', compact('location'));
        }
        return redirect()->back();
    }

    public function update(LocationRequest $request, Location $location) {
        try{
            $location->fill($request->get('location'));
            $location->save();
            $request->session()->flash('message', 'Location update successfully');
            return redirect()->route('locations.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id) {
        $response = ['errors' => false];
        $location = Location::find($id);

        if(count($location->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        } else {
            try {
                $location->delete();
                Session::flash('message', 'Location delete successfully');
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
