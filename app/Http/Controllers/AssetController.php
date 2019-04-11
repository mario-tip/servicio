<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Subcategory;
use App\Equipment;
use Carbon\Carbon;
use App\Provider;
use App\Customer;
use App\Location;
use App\Project;
use App\Person;
use App\Asset;
use Validator;

class AssetController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission('listar_captura_info')) {

          $assets = Asset::all();

          foreach ($assets as $asset) {
          $resp  =  $asset->dame($asset->adquisition_date, $asset->depreciation, $asset->cost);
          // $assets->put('actual_price', $resp);

          }
          // echo $assets;
          return view("assets.index", compact('assets'));
        }
        // return redirect()->back();
    }

    public function create(){
        if(userHasPermission('crear_captura_info')) {
            $dependencies = $this->getDependenciesData();
            $asset = new Asset;
            $location_id = null;
            // dd($dependencies);
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

    public function store(Request $request){

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
        // dd(response()->json($asset_data));

        $locations = [];
        $locations[$asset_data['location_id']] = ['status' => '1'];
        $equipment_parts = $request->get('equipment_parts');

        try {
            $asset = Asset::create($asset_data);
            $asset->parts()->attach($equipment_parts);
            $asset->locations()->attach($locations);
            $request->session()->flash('message', 'Asset saved successfully');
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
            'asset_custom_id.required' => 'The id of the asset is required',
            'adquisition_date.required' => 'The purchase date of the asset is required',
            'name.required' => 'The name of the asset is required',
            'model.required' => 'The asset model is required',
            'unique' => 'The model already exists',
            'condition.required' => 'The state of the asset is required',
            'serial.required' => 'The serial number of the asset is required',
            'status.required' => 'The status of the asset is required',
            'brand.required' => 'The brand of the asset is required',
            'location_id.required' => 'The location of the asset is required',
            'barcode.required' => 'The barcode is required',
            'subcategory_id.required' => 'The subcategory is required',
            'equipment_id.required' => 'The type of asset is required',
            'maintenance_date.required' => 'The maintenance date is required',
            'cost.required' => 'The price is required',
            'person_id.required' => 'The person is required',
            'description.required' => 'The description is required',
            'customer_id.required' => 'The customer is required',
            'project_id.required' =>  'The project is required'
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
            'customer_id' => 'required',
            'project_id' => 'required'
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

        $asset_data['project_id'] = intval($asset_data['project_id']);
        $asset_data['provider_id'] = intval($asset_data['provider_id']);
        $asset_data['customer_id'] = intval($asset_data['customer_id']);
        $asset_data['subcategory_id'] = intval($asset_data['subcategory_id']);
        $asset_data['equipment_id'] = intval($asset_data['equipment_id']);

        return $asset_data;
    }

    /*Formatea una fecha a Y-m-d*/
    public static function date2SQLFormat($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function show($id){
        if(userHasPermission('mostrar_captura_info')) {
            $asset = Asset::find($id);
            return view('assets.show', compact('asset'));
        }
        return redirect()->back();
    }

    public function edit($id){
        if(userHasPermission('editar_captura_info')) {
            $asset = Asset::find($id);
            $location_id = count($asset->locations) == 0 ? null : $asset->locations[0]->id;
            $dependencies = $this->getDependenciesData();
            return view('assets.edit', compact('asset', 'dependencies', 'location_id'));
        }
        return redirect()->back();
    }

    public function update(Request $request, $id){
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
            $request->session()->flash('message', 'Asset updated successfully');
            return response()->json(['errors' => false]);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return $response;
        }
    }

    public function destroy($id){
        /*No se elimina activo desde el sistema de soporte*/
    }

    public function getEquipmentParts(Request $request){
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
