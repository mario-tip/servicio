<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Session;

class EquipmentController extends Controller
{
    /**
     * EquipmentController constructor.
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
        if(userHasPermission("listar_tipo_equipo")) {
            $equipments = Equipment::all();
            return view('equipments.index', compact('equipments'));
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
        if(userHasPermission("crear_tipo_equipo")) {
            $equipment = new Equipment;
            return view('equipments.create', compact('equipment','parts'));
        }
        return redirect()->back();
    }

    /*Obtiene las partes para el select2*/
    public function getSelect2Parts(Request $request) {

        if($request->ajax()) {
            $query = $request->get('q');

            $parts = Part::select('id', 'name as text')
                ->where('name', 'like', '%' . $query . '%')
                ->get()->toArray();

            $response = [
                "results" => $parts
            ];

            return response()->json($response);
        }
        return $this->onlyAjaxAllowed();
    }

    /*Obtiene la parte seleccionada, para agregarla a la tabla*/
    public function getPart(Request $request) {
        $part_id = $request->get('part_id');

        $response = [
            'errors' => false,
        ];

        if(is_numeric($part_id)) {
            if($request->ajax()) {
                $part = Part::find($part_id);
                $response['part'] = $part;
                return response()->json($response);
            } else {
                return $this->onlyAjaxAllowed();
            }

        } else {
            $errors = [
                'error_message' => 'You must write the part before adding it'
            ];
            $response['errors'] = true;
            $response['errors_fragment'] = \View::make('partials.request')->withErrors($errors)->render();
            return response()->json($response);
        }
    }

    /*Retorna response cuando no es ajax request*/
    private function onlyAjaxAllowed() {
        return response()->json([
            'error' => '400',
            'message' => 'Only ajax requests are allowed'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipment_data = $request->get('equipment');
        $validator = $this->validateInputs($equipment_data);

        if($validator->fails()) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors($validator)->render()
            ];
            return response()->json($response);
        }
        $parts =  ($request->get('parts') == null) ? [] : array_unique($request->get('parts'));

        try {
            $equipment = Equipment::create($equipment_data);
            $equipment->parts()->attach($parts);
            $request->session()->flash('message', 'Equipment saved successfully');
            return response()->json(['errors' => false]);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return response()->json($response);
        }
    }

    private function validateInputs($form_data)
    {
        $messages = [
            'name.required' => 'The equipment name is required'
        ];

        $validator = Validator::make($form_data, [
            'name' => 'required'
        ], $messages);

        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission("editar_tipo_equipo")) {
            $equipment = Equipment::find($id);
            return view('equipments.edit', compact('equipment'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipment_data = $request->get('equipment');
        $validator = $this->validateInputs($equipment_data);

        if($validator->fails()) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors($validator)->render()
            ];
            return response()->json($response);
        }

        $parts = ($request->get('parts') == null) ? [] : array_unique($request->get('parts'));

        try {
            $equipment = Equipment::find($id);
            $equipment->fill($equipment_data);
            $equipment->parts()->sync($parts);
            $equipment->save();
            $request->session()->flash('message', 'Equipment update successfully');
            return response()->json(['errors' => false]);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['errors' => false];
        $equipment = Equipment::find($id);

        if(count($equipment->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        } else {
            try {
                $equipment->parts()->detach();
                $equipment->delete();
                Session::flash('message', 'Equipment delete successfully');
                return response()->json(['errors' => false]);
            }catch(\Exception $e){
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
