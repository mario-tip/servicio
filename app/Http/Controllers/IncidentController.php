<?php

namespace App\Http\Controllers;

use App\User;
use App\Asset;
use App\Person;
use App\Incident;
use App\Quotation;
use Carbon\Carbon;
use App\ServiceOrder;
use Illuminate\Http\Request;
use App\Mail\IncidentMailUser;
use App\Mail\IncidentMailAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IncidentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(userHasPermission("listar_registro_incidencias")) {
            $user = $request->user();

            if ($user->type_user != 1 ) {
                $incidents = $user->getIncidents;
            } else {
                $incidents = Incident::all();
            }


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
            $aux = $value->last()->id + 1;

            $data['folio'] =  $data['folio'].$aux;
        }

        $data['evidence_file'] = $fileLogo;

        $user = $request->user();//se recupera el usuario en sesion para asignar el id a la incidencia.

        $data['user_id'] = $user->id;

        $incident = Incident::create($data);

        //Disparar el correo de notificacion de que la incidencia fue guardada y esta en epera para que el admin de AOC Programador(Nuevo) asigne la incidencia a un tecnico
        $asset = Asset::findOrFail($incident->asset_id); //se busca el activo de la incidencia.

        // se valida si el usuario tiene activo el permiso para recibir notificaciones.
        if($user->active_notification == 1){
            Mail::to($user->email)->send(new IncidentMailUser($incident,$asset,$user));
        }

        // se recuperan todos los usuarios a los que se les va a notificar el registro de la incidencia.
        $users_send = DB::table('users')
        ->join('user_notification', 'users.id', '=', 'user_notification.notification_id')
        ->select('users.*')
        ->where('user_notification.user_id', '=', $user->id)
        ->get();

        // En el siguiente foreach se envian correos segun el numero de usuarios a notificar.
        foreach ($users_send as $key => $user_send) {
            Mail::to($user_send->email)->send(new IncidentMailAdmin($incident,$asset,$user,$user_send));
        }

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

        Session::flash('message', 'Incident saved successfully.');
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

        Session::flash('message', 'Incident update successfully.');
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

            Session::flash('message', 'Incident deleted successfully.');

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
        // dd($incidents);
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
                    $incident->status = 'Pending';
                else{
                    $incident->status = 'Attended';
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

            if(is_object($order)){
                $name = $order->technician()->select('users.username')->first();
                $incident->technician = $name->username;

                $person = $order->authorizer()->select('persons.name', 'persons.father_last_name', 'persons.mother_last_name')->first();

                if(is_object($person)){
                    $incident->person = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
                }else{
                    $incident->person = '';
                }

                if($order->status == 0)
                    $incident->status = 'Pending';
                else{
                    $incident->status = 'Attended';
                }

                $incident->person_notes = $order->notes;
                $incident->date = $order->date;
                $incident->time = $order->time;
                $incident->signature = '/'.$order->signature;
            }else{
                $incident->technician = '';
                $incident->person = '';
                $incident->status = 'Pending';
                $incident->person_notes = '';
                $incident->date = '';
                $incident->time = '';
                $incident->signature = '';
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
                    $incident->status = 'Pending';
                else{
                    $incident->status = 'Served';
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
                $incident->status = 'Pending';
            else{
                $incident->status = 'Served';
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

            $user = $request->user();

            // DB::table('log')->insert([
            //     "texto" => $user
            // ]);
            if ($user->type_user ==  1) {
                $data = Asset::select('id','name AS text')
                ->where('name','like','%'.$keyword.'%')

                ->get();
            } else {
                $data = Asset::select('id','name AS text')
                ->where('name','like','%'.$keyword.'%')
                ->where('customer_id', '=', $user->customer_id)
                ->get();
            }


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
