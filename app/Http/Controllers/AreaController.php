<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller {
    public function index(){
        return Area::all();
    }

    public function store(Request $request){

        $data = $request->all();

    }

    public function show(Area $area){
      return $area;
    }

    public function edit(Area $area){
        //
    }

    public function update(Request $request, Area $area){
        //
    }

    public function destroy(Area $area){
        //
    }
}
