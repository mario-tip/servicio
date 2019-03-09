<?php

namespace App\Http\Controllers;

use App\Part;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PartRequest;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(userHasPermission('listar_catalogo_correlativos')) {
            $parts = Part::all();
            return view('part.index', compact('parts'));
        }
        return \redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(userHasPermission("crear_catalogo_correlativos")) {
            return view('part.create');
        }
        return \redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartRequest $request)
    {
        $data = Input::all();

        $data['price'] = str_replace(",", "", $data['price']);

        $part = Part::create($data);

        Session::flash('message', 'Part created successfully.');
        return Redirect::to('/parts');
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
        if(userHasPermission("editar_catalogo_correlativos")) {
            $part = Part::find($id);
            return view('part.edit')->with('part', $part);
        }
        return \redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, $id)
    {
        $data = Input::all();

        $data['price'] = str_replace(",", "", $data['price']);

        $part = Part::find($id);
        $part->update($data);

        Session::flash('message', 'Part updated successfully.');
        return Redirect::to('/parts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
