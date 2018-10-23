<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Incident;
use App\Person;
use App\Quotation;
use App\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IncidentRequest;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(userHasPermission("listar_registro_incidencias")) {
            $incidents = Incident::all();
            return view('incident.index', compact('incidents'));
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
        if(userHasPermission("crear_registro_incidencias")) {
            $persons = Person::all();
            return view('incident.create')->with('persons', $persons);
        }
        return \redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidentRequest $request)
    {
        $data = $request->all();

        if(!empty($data['parts'])){
            $parts = $data['parts'];
        }

        $data['suggested_date'] = Input::has('suggested_date')?Carbon::parse($data['suggested_date'])->format('Y-m-d'):'';
        $data['suggested_time'] = Input::has('suggested_time')?Carbon::parse($data['suggested_time'])->format('H:i:s'):'';

        $evidence_file = Input::file('evidence_file');
        $file = $evidence_file->getClientOriginalName();
        $ext = $evidence_file->getClientOriginalExtension();
        $name = str_random(10)."_".time()."_"."incidents" . "." . $ext;
        $fileLogo = 'images/incidents/'.$name;

        if(Incident::count() == 0){
            $val = 1;

            $data['folio'] =  $data['folio'].$val;
        }else{
            $value = Incident::all();
            $aux = $value->last()->id+1;

            $data['folio'] =  $data['folio'].$aux;
        }

        $data['evidence_file'] = $fileLogo;

        $incident = Incident::create($data);

        if(!empty($parts)){
            $incident->parts()->attach($parts);
        }

        $folder = public_path().'/images/incidents';
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
            $evidence_file->move(public_path().'/images/incidents/',$fileLogo);
        }else{
            $evidence_file->move(public_path().'/images/incidents/',$fileLogo);
        }

        Session::flash('message', 'Incidencia creada correctamente.');
        return Redirect::to('/incidents');
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
        if(userHasPermission("editar_registro_incidencias")) {
            $incident = Incident::find($id);
            $persons = Person::all();

            return view('incident.edit', ['incident' => $incident])
                ->with('persons', $persons);
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
    public function update(IncidentRequest $request, $id)
    {
        $data = $request->all();

        if(!empty($data['parts'])){
            $parts = $data['parts'];
        }

        $incident = Incident::find($id);

        $data['suggested_date'] = Input::has('suggested_date')?Carbon::parse($data['suggested_date'])->format('Y-m-d'):'';
        $data['suggested_time'] = Input::has('suggested_time')?Carbon::parse($data['suggested_time'])->format('H:i:s'):'';

        $evidence_file = Input::file('evidence_file');
        if(!empty($evidence_file)){
            $file = $evidence_file->getClientOriginalName();
            $ext = $evidence_file->getClientOriginalExtension();
            $name = str_random(10)."_".time()."_"."signature".".".$ext;
            $fileLogo = 'images/incidents/'.$name;
        }else{
            $fileLogo = $incident->evidence_file;
        }

        if(!empty($evidence_file)){
            $file = $incident->evidence_file;
            if($file != ''){
                if(file_exists(public_path().'/'.$file)){
                    unlink(public_path().'/'.$file);
                }
            }
        }

        $data['evidence_file'] = $fileLogo;

        $incident->update($data);

        if(!empty($parts)){
            $incident_parts = $incident->parts()->sync($parts);
        }

        if(!empty($evidence_file)){
            $folder = public_path().'/images/incidents';
            if(!file_exists($folder)){
                mkdir($folder, 0777, true);
                $evidence_file->move(public_path().'/images/incidents/',$fileLogo);
            }else{
                $evidence_file->move(public_path().'/images/incidents/',$fileLogo);
            }
        }

        Session::flash('message', 'Incidencia actualizada correctamente.');
        return Redirect::to('/incidents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Incident::select('service_order.status as service_status')
            ->join('assets', 'assets.id', '=', 'incidents.asset_id')
            ->join('persons', 'persons.id', '=', 'assets.person_id')
            ->join('service_order', 'service_order.type_id', '=', 'incidents.id')
            ->where('service_order.type', 0)
            ->where('incidents.id', $id)
            ->first();

        $data = false;
        if(!$status){
            $incident = Incident::find($id);
            $incident->parts()->detach();
            $incident->delete();

            Session::flash('message', 'Incidencia eliminada correctamente.');

            $data = false;
        }else{
            if($status->service_status == 1){
                $data = true;
            }
        }

        return response()->json(['success' => $data]);
    }

    public function getIncidents(){
        if(userHasPermission("listar_consulta_atencion_incidencias")):
        $incidents = Incident::all();

        foreach($incidents as $incident){
            $asset = Asset::find($incident->asset_id);
            $location = $asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();

            $dir = '';
            foreach ($location as $item){
                $dir = $item->address.", Edificio #".$item->building.", Piso #".$item->floor;
            }

            $incident->location = $dir;

            $order = ServiceOrder::where('type', 0)
                ->where('type_id', $incident->id)->first();
                // dd($incident->id);
                // dd($order);
                // print_r($order);
            if(is_object($order)){
                $name = $order->technician()->select('users.username')->first();
                $incident->technician = $name->username;

                if($order->status == 0)
                    $incident->status = 'Pendiente';
                else{
                    $incident->status = 'Atendido';
                }
            }else{
                $incident->technician = '';
                $incident->status = '';
            }
        }

        return view('incident.aid', compact('incidents'));
        else:
            return \redirect()->back();
        endif;
    }

    public function getIncidentDetails($id){

        if(userHasPermission("mostrar_consulta_atencion_incidencias")):
            $incident = Incident::find($id);

            $name_parts = $incident->person()->select('persons.name', 'persons.father_last_name', 'persons.mother_last_name')->get();

            $full_name = '';
            foreach ($name_parts as $item){
                $full_name = $item->name." ".$item->father_last_name." ".$item->mother_last_name;
            }

            $incident->full_name = $full_name;

            // Datos del activo
            $asset = Asset::find($incident->asset_id);
            $location = $asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();

            $dir = '';
            foreach ($location as $item){
                $dir = $item->address.", Edificio #".$item->building.", Piso #".$item->floor;
            }

            $incident->location = $dir;

            // Datos de las partes
            $parts = $asset->parts()->select('parts.name as part_name', 'parts.number as part_number')->get();

            $data = [];
            foreach ($parts as $part){
                $class = new \stdClass;
                $class->part_name = $part->part_name;
                $class->part_number = $part->part_number;

                array_push($data, $class);
            }

            // Datos de la orden de servicio
            $order = ServiceOrder::where('type', 0)
                ->where('type_id', $incident->id)->first();

            if(count($order)>0){
                $name = $order->technician()->select('users.username')->first();
                $incident->technician = $name->username;

                $person = $order->authorizer()->select('persons.name', 'persons.father_last_name', 'persons.mother_last_name')->first();
                if(count($person)==1){
                    $incident->person = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
                }else{
                    $incident->person = '';
                }

                if($order->status == 0)
                    $incident->status = 'Pendiente';
                else{
                    $incident->status = 'Atendido';
                }

                $incident->person_notes = $order->notes;
                $incident->date = $order->date;
                $incident->time = $order->time;
                $incident->signature = '/'.$order->signature;
            }else{
                $incident->technician = '';
                $incident->person = '';
                $incident->status = '';
                $incident->person_notes = '';
                $incident->date = '';
                $incident->time = '';
                $incident->signature = '#';
            }

            return view('incident.details', compact('incident', 'data'));
        else:
            return \redirect()->back();
        endif;
    }

    public function getCustomerIncidents($id){
        $customer_id = $id;

        $incidents = Incident::select('incidents.id', 'incidents.folio as folio', 'incidents.asset_id as asset_id', 'incidents.type as type',
            'incidents.description as description', 'incidents.suggested_time', 'incidents.suggested_date', 'incidents.priority')
            ->join('assets', 'assets.id', '=', 'incidents.asset_id')
            ->join('customers', 'customers.id', '=', 'assets.customer_id')
            ->join('users_customers', 'users_customers.customer_id', 'customers.id')
            ->where('users_customers.user_id', '=', $id)->get();

        foreach($incidents as $incident){
            $asset = Asset::find($incident->asset_id);
            $location = $asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();

            $dir = '';
            foreach ($location as $item){
                $dir = $item->address.", Edificio #".$item->building.", Piso #".$item->floor;
            }

            $incident->location = $dir;

            $order = ServiceOrder::where('type', 0)
                ->where('type_id', $incident->id)->first();

            if(count($order)>0){
                $name = $order->technician()->select('users.username')->first();
                $incident->technician = $name->username;

                if($order->status == 0)
                    $incident->status = 'Pendiente';
                else{
                    $incident->status = 'Atendido';
                }
            }else{
                $incident->technician = '';
                $incident->status = '';
            }

            // Quotations data
            $quotation = Quotation::where('incident_id', $incident->id)->first();
            $incident->quotation_id = $quotation->id;
            $incident->quotation_authorization = $quotation->authorization;
        }

        return view('incident.customer_view', compact('incidents', 'customer_id'));
    }

    public function getCustomerIncidentsDetails($id){
        $incident = Incident::find($id);

        $name_parts = $incident->person()->select('persons.name', 'persons.father_last_name', 'persons.mother_last_name')->get();

        $full_name = '';
        foreach ($name_parts as $item){
            $full_name = $item->name." ".$item->father_last_name." ".$item->mother_last_name;
        }

        $incident->full_name = $full_name;

        // Datos del activo
        $asset = Asset::find($incident->asset_id);
        $location = $asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();

        $dir = '';
        foreach ($location as $item){
            $dir = $item->address.", Edificio #".$item->building.", Piso #".$item->floor;
        }

        $incident->location = $dir;

        // Datos de las partes
        $parts = $asset->parts()->select('parts.name as part_name', 'parts.number as part_number')->get();

        $data = [];
        foreach ($parts as $part){
            $class = new \stdClass;
            $class->part_name = $part->part_name;
            $class->part_number = $part->part_number;

            array_push($data, $class);
        }

        // Datos de la orden de servicio
        $order = ServiceOrder::where('type', 0)
            ->where('type_id', $incident->id)->first();

        if(count($order)>0){
            $name = $order->technician()->select('users.username')->first();
            $incident->technician = $name->username;

            $person = $order->authorizer()->select('persons.name', 'persons.father_last_name', 'persons.mother_last_name')->first();
            if(count($person)==1){
                $incident->person = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
            }else{
                $incident->person = '';
            }

            if($order->status == 0)
                $incident->status = 'Pendiente';
            else{
                $incident->status = 'Atendido';
            }

            $incident->person_notes = $order->notes;
            $incident->date = $order->date;
            $incident->time = $order->time;
            $incident->signature = '/'.$order->signature;
        }else{
            $incident->technician = '';
            $incident->person = '';
            $incident->status = '';
            $incident->person_notes = '';
            $incident->date = '';
            $incident->time = '';
            $incident->signature = '#';
        }

        // Datos de cotización
        $quotation = Quotation::where('incident_id', $incident->id)->first();

        return view('incident.customer_view_details', compact('incident', 'data', 'quotation'));
    }

    public function getAsset(Request $request){
        $keyword = $request->input('q');

        if($request->ajax()){
            $data = Asset::select('id','name AS text')
                ->where('name','like','%'.$keyword.'%')
                ->get();
            return response()->json($data);
        }
    }

    public function getDataAsset($id)
    {
        $asset = Asset::find($id);

        $data = [];
        if(!$asset){
            return  response()->json([]);
        }else{
            $location = $asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();

            $dir = '';
            foreach ($location as $item){
                $dir = $item->address.", Edificio #".$item->building.", Piso #".$item->floor;
            }

            $item = [
                'asset_id' => $asset->id,
                'asset_custom_id' => $asset->asset_custom_id,
                'name' => $asset->name,
                'brand' => $asset->brand,
                'location' => $dir,
                'serial' => $asset->serial,
                'flag' => false,
            ];

            $data[] = $item;

            return response()->json($data);
        }
    }

    public function getIncidentParts(Request $request)
    {
        if($request->ajax()){
            $asset_parts = Asset::find($request->get('asset_id'))->parts;
            Log::debug('assets parts: '. $asset_parts);
            $asset_edit = false;
            $check_all_status = false;

            if(null != $request->get('incident_id')){
                $incident_parts = Incident::find($request->get('incident_id'))->parts;
                Log::debug('incidents parts: '.$incident_parts);
                $incident_parts_ids = $incident_parts->pluck('id')->toArray();
                $asset_edit = true;
                $check_all_status = (count($incident_parts) == count($asset_parts)) ? true : false;
                Log::debug('verificacion si son iguales: '.$check_all_status);
                foreach ($asset_parts as $k => $asset_part){
                    Log::debug('comparacion de valores: '. in_array($asset_part->id, $incident_parts_ids));
                    if(in_array($asset_part->id, $incident_parts_ids)){
                        $asset_parts[$k]->checkbox_status = 'checked';
                        Log::debug('Checkbox marcado: '.$asset_parts[$k].' estado -> '.$asset_parts[$k]->checkbox_status);
                    }else{
                        $asset_parts[$k]->checkbox_status = '';
                    }
                }
            }

            Log::debug('assets parts: '. $asset_parts);

            $response = [
                'asset_parts' => $asset_parts,
                'incident_parts_table_view' => \View::make('incident.incident_parts_table')
                    ->with([
                        'asset_parts' => $asset_parts,
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

    public function tagAsset($id){
        $asset = Incident::find($id);

        $tags = array();

        array_push($tags, array('id' => $asset->asset->id, 'text' => $asset->asset->name, 'bandera' => false));

        return $tags;
    }
}
