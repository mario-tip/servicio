<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Equipment;
use App\Part;
use App\Provider;
use Carbon\Carbon;
use Validator;
use Session;

class EquipmentController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission("listar_tipo_equipo")) {
            $equipments = Equipment::all();
            return view('equipments.index', compact('equipments'));
        }
        return redirect()->back();
    }

    public function create(){
        if(userHasPermission("crear_tipo_equipo")) {

            $providers = $this->getDependences();
            $equipment = new Equipment;
            return view('equipments.create', compact('equipment','providers'));
        }
        return redirect()->back();
    }

    private function getDependences(){
      return [
        'provide' => Provider::all()->pluck('name','id')
      ];
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

    public function store(Request $request){



        $equipment_data = $request->get('equipment');
        $validator = $this->validateInputs($equipment_data);
        $equipment_data['date_purchase'] = Carbon::parse($equipment_data['date_purchase'])->format('Y-m-d');

          $img = Input::file('image_eq');
          dd($request->image_eq);
          $ext = $img->getClientOriginalExtension();
          $name = str_random(10).'.'.time().'.'.'image'.'.'.$ext;
          $img->move(public_path().'/images/parts/',$name);
          $equipment_data['image'] = $name;

        /*if ($request->has('doc_file')) {
          $doc = Input::file('doc_file');
          $file = $doc->getClientOriginalName();
          $extension = $doc->getClientOriginalExtension();
          $name = str_random(10).'_'.time().'_'.'file'.'.'.$extension;
          $main_doc = 'images/parts'.$name;

          $doc->move(public_path().'/images/parts/',$main_doc);
        }*/

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

    private function validateInputs($form_data){
        $messages = [
            'name.required' => 'The equipment name is required'
        ];

        $validator = Validator::make($form_data, [
            'name' => 'required',
            'price' => 'required',
            'serial' => 'required',
            'date_purchase' => 'required',
            'quantity' => 'required',
            'provider_id' => 'required',
            'description' => 'required',
            'image_eq' => 'image '
        ], $messages);

        return $validator;
    }

    public function edit($id){
        if(userHasPermission("editar_tipo_equipo")) {
            $equipment = Equipment::find($id);
            return view('equipments.edit', compact('equipment'));
        }
        return redirect()->back();
    }

    public function update(Request $request, $id){
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

    public function destroy($id){
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
