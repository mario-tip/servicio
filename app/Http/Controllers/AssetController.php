<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Customer;
use App\Equipment;
use App\Person;
use App\Provider;
use App\Location;
use App\Project;
use App\Subcategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Log;



class AssetController extends Controller
{

    /**
     * AssetController constructor.
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
        if(userHasPermission('listar_captura_info')) {
            $assets = Asset::all();
            return view("assets.index", compact('assets'));
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
        if(userHasPermission('crear_captura_info')) {
            $dependencies = $this->getDependenciesData();
            $asset = new Asset;
            $location_id = null;
            return view("assets.create", compact('dependencies', 'asset', 'location_id'));
        }
        return redirect()->back();
    }

    /*Obtiene las dependencias del asset, para los select del form*/
    private function getDependenciesData() {
        return [
            'equipments' => Equipment::all()->pluck('name', 'id'),
            'locations' => Location::all()->pluck('address', 'id'),
            'persons' => Person::all()->pluck('name', 'id'),
            'providers' => Provider::all()->pluck('name', 'id'),
            'customers' => Customer::all()->pluck('name', 'id'),
            'projects' => Project::all()->pluck('name', 'id'),
            'subcategories' => Subcategory::all()->pluck('name', 'id'),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asset_data = $request->get('asset');
        $validator = $this->validateInputs($asset_data, 'POST');

        if($validator->fails()) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors($validator)->render()
            ];
            return response()->json($response);
        }

        $asset_data = $this->formatFormData($asset_data);

        $locations = [];
        $locations[$asset_data['location_id']] = ['status' => '1'];
        $equipment_parts = $request->get('equipment_parts');

        try {
            $asset = Asset::create($asset_data);
            $asset->parts()->attach($equipment_parts);
            $asset->locations()->attach($locations);
            $request->session()->flash('message', 'Activo guardado correctamente');
            return response()->json(['errors' => false]);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return response()->json($response);
        }
    }

    private function validateInputs($form_data, $method) {
        $messages = [
            'asset_custom_id.required' => 'El id del activo es requerido',
            'adquisition_date.required' => 'La fecha de compra del activo es requerida',
            'name.required' => 'El nombre del activo es requerido',
            'model.required' => 'El modelo del activo es requrerido',
            'unique' => 'El modelo ya existe',
            'condition.required' => 'La condición del activo es requerida',
            'serial.required' => 'El número de serie del activo es requerido',
            'status.required' => 'El estatus del activo es requerido',
            'brand.required' => 'La marca del activo es requerida',
            'location_id.required' => 'La ubicación del activo es requerida',
            'barcode.required' => 'El código de barras es requerido',
            'subcategory_id.required' => 'La subcategoria es requerida',
            'equipment_id.required' => 'El tipo de activo es requerido',
            'maintenance_date.required' => 'La fecha de mantenimiento es requerida',
            'cost.required' => 'El costo es requerido',
            'person_id.required' => 'La persona es requerida',
            'description.required' => 'La descripción es requerida',
            'customer_id.required' => 'El cliente es requerido'
        ];

        $validations = [
            /*'asset_custom_id' => 'required',*/
            'adquisition_date' => 'required',
            'name' => 'required',
            'model' => 'required',
            'condition' => 'required',
            'serial' => 'required',
            'status' => 'required',
            'brand' => 'required',
            'location_id' => 'required',
            'barcode' => 'required',
            'subcategory_id' => 'required',
            /*'equipment_id' => 'required',*/ //|array|min:1
            'maintenance_date' => 'required',
            'cost' => 'required',
            'person_id' => 'required',
            'description' => 'required',
            /*'customer_id' => 'required'*/
        ];

        if($method == 'POST') $validations['model'] = 'required|unique:assets';

        $validator = Validator::make($form_data, $validations, $messages);

        return $validator;
    }


    /*formateando algunos datos del form para guardarlos en la db*/
    private function formatFormData($asset_data) {
        $asset_data['cost'] =  str_replace(',', '', $asset_data['cost']);
        $asset_data['adquisition_date'] = $this->date2SQLFormat($asset_data['adquisition_date']);
        $asset_data['expires_date'] = $this->date2SQLFormat($asset_data['expires_date']);
        $asset_data['maintenance_date'] = $this->date2SQLFormat($asset_data['maintenance_date']);

        return $asset_data;
    }

    /*Formatea una fecha a Y-m-d*/
    public static function date2SQLFormat($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(userHasPermission('mostrar_captura_info')) {
            $asset = Asset::find($id);
            return view('assets.show', compact('asset'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission('editar_captura_info')) {
            $asset = Asset::find($id);
            $location_id = count($asset->locations) == 0 ? null : $asset->locations[0]->id;
            $dependencies = $this->getDependenciesData();
            return view('assets.edit', compact('asset', 'dependencies', 'location_id'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asset_data = $request->get('asset');
        $validator = $this->validateInputs($asset_data, 'PUT');

        if($validator->fails()) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors($validator)->render()
            ];

            return response()->json($response);
        }

        $asset_data = $this->formatFormData($asset_data);

        $locations = [];
        $locations[$asset_data['location_id']] = ['status' => '1'];

        $equipment_parts = $request->get('equipment_parts');
        $equipment_parts = $equipment_parts == null ? [] : $equipment_parts;

        try {
            $asset = Asset::find($id);
            $asset->fill($asset_data);
            $asset->parts()->sync($equipment_parts);
            $asset->locations()->sync($locations);
            $asset->save();
            $request->session()->flash('message', 'Activo actualizado correctamente');
            return response()->json(['errors' => false]);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return $response;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*No se elimina activo desde el sistema de soporte*/
    }

    public function getEquipmentParts(Request $request)
    {
        if($request->ajax()) {

            $equipment_parts = Equipment::find($request->get('equipment_id'))
                ->parts;

            $asset_edit = false;
            $check_all_status = false;

            if(null != $request->get('asset_id')) {
                $asset_parts = Asset::find($request->get('asset_id'))->parts;
                $asset_parts_ids = $asset_parts->pluck('id')->toArray();
                $asset_edit = true;
                $check_all_status = (count($asset_parts) == count($equipment_parts)) ? true : false;
                foreach($equipment_parts as $k=>$equipment_part) {
                    if(in_array($equipment_part->id, $asset_parts_ids)) {
                        $equipment_parts[$k]->checkbox_status = 'checked';
                        $equipment_parts[$k]->serial = $asset_parts->find($equipment_part->id)->pivot->serial;
                    } else {
                        $equipment_parts[$k]->checkbox_status = '';
                    }
                }
            }

            $response = [
                'equipment_parts' => $equipment_parts,
                'equipment_parts_table_view' => \View::make('assets.forms.equipment_parts_table')
                    ->with([
                        'equipment_parts' => $equipment_parts,
                        'asset_edit' => $asset_edit,
                        'check_all_status' => $check_all_status])
                    ->render()
            ];

            return response()->json($response);
        }
        return response()->json([
            'error' => '400',
            'message' => 'Only ajax requests are allowed'
        ]);
    }
}
