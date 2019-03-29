<?php

namespace App\Http\Controllers;

use App\Part;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PartRequest;

class PartController extends Controller {
    public function index() {
        if(userHasPermission('listar_catalogo_correlativos')) {
            $parts = Part::all();
            return view('part.index', compact('parts'));
        }
        return \redirect()->back();
    }

    public function create() {
        if(userHasPermission("crear_catalogo_correlativos")) {
            return view('part.create');
        }
        return \redirect()->back();
    }

    public function store(PartRequest $request) {
        $data = Input::all();

        if ($data == null ) {
          Alert('no sirve esta vaina');
        }

        $data['price'] = str_replace(",", "", $data['price']);

        $part = Part::create($data);

        Session::flash('message', 'Part created successfully.');
        return Redirect::to('/parts');
    }

    public function edit($id) {
        if(userHasPermission("editar_catalogo_correlativos")) {
            $part = Part::find($id);
            return view('part.edit')->with('part', $part);
        }
        return \redirect()->back();
    }

    public function update(PartRequest $request, $id) {
        $data = Input::all();

        $data['price'] = str_replace(",", "", $data['price']);

        $part = Part::find($id);
        $part->update($data);

        Session::flash('message', 'Part updated successfully.');
        return Redirect::to('/parts');
    }

    public function destroy($id) {
        $part = Part::find($id);

        if($part->assets()->count() == 0 && $part->equipments()->count() == 0) {
            $part->delete();
            Session::flash('message', 'Part deleted successfully.');
            $data = false;
        } else {
            $data = true;
        }

        return response()->json(['success' => $data]);
    }
}
