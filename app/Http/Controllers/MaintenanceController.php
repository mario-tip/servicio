<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Requests\MaintenanceRequest;
use App\Maintenance;
use App\Person;
use App\ServiceOrder;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceRequest $request)
    {
        $data = $request->all();

        $data['maintenance_date'] = Input::has('maintenance_date')?Carbon::parse($data['maintenance_date'])->format('Y-m-d'):'';
        $data['maintenance_time'] = Input::has('maintenance_time')?Carbon::parse($data['maintenance_time'])->format('H:i:s'):'';

        // Valores por default
        $data['type'] = 0;
        $data['is_periodical'] = false;

        $maintenance = Maintenance::create($data);

        $folio = '';
        $total = count(ServiceOrder::where('type', 1)->get());
        if($total==0){
            $val = 1;

            $folio =  'EEOM-'.$val;
        }else{
            $value = ServiceOrder::where('type', 1)->get();
            $aux = $value->last()->id+1;

            $folio =  'EEOM-'.$aux;
        }

        // Registro de orden de servicio
        $service_order = new ServiceOrder();
        $service_order->folio = $folio;
        $service_order->date = $data['maintenance_date'];
        $service_order->time = $data['maintenance_time'];
        $service_order->type = 1;
        $service_order->status = 0;
        $service_order->type_id = $maintenance->id;
        $service_order->user_id = $data['user_id'];
        $service_order->save();

        Session::flash('message', 'Maintenance created succesfully.');
        return Redirect::to('/maintenances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance = Maintenance::find($id);

        $asset = Asset::find($maintenance->asset_id);

        $service_order = ServiceOrder::where('type', '=', 1)
            ->where('type_id', '=', $maintenance->id)->first();

        if(count($service_order)>0){
            $person = Person::find($service_order->person_id);

            $maintenance->folio = $service_order->folio;
            $maintenance->person_notes = $service_order->notes;

            if(count($person)>0){
                $maintenance->person_name = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
            }else{
                $maintenance->person_name = '';
            }

            $name = $service_order->technician()->select('users.username')->first();
            $maintenance->technician = $name->username;

            $maintenance->signature = '/'.$service_order->signature;
        }else{
            $maintenance->folio = '';
            $maintenance->person_notes = '';
            $maintenance->person_name = '';
            $maintenance->signature = '';
        }

        return view('maintenances.show', compact('maintenance', 'asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintenance = Maintenance::find($id);

        $service_order = ServiceOrder::where('type', '=', 1)
            ->where('type_id', '=', $id)->first();

        if(count($service_order)>0){
            $maintenance->user_id = $service_order->user_id;
        }else{
            $maintenance->user_id = '';
        }

        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaintenanceRequest $request, $id)
    {
        $data = $request->all();

        var_dump($data);

        $maintenance = Maintenance::find($id);

        $data['maintenance_date'] = Input::has('maintenance_date')?Carbon::parse($data['maintenance_date'])->format('Y-m-d'):'';
        $data['maintenance_time'] = Input::has('maintenance_time')?Carbon::parse($data['maintenance_time'])->format('H:i:s'):'';

        $maintenance->update($data);

        $service_order = ServiceOrder::where('type', '=', 1)
            ->where('type_id', '=', $id)->first();

        if(count($service_order)==0){
            $folio = '';
            $total = count(ServiceOrder::where('type', 1)->get());
            if($total==0){
                $val = 1;

                $folio =  'EEOM-'.$val;
            }else{
                $value = ServiceOrder::where('type', 1)->get();
                $aux = $value->last()->id+1;

                $folio =  'EEOM-'.$aux;
            }

            $new_service_order = new ServiceOrder();
            $new_service_order->folio = $folio;
            $new_service_order->date = $data['maintenance_date'];
            $new_service_order->time = $data['maintenance_time'];
            $new_service_order->type = 1;
            $new_service_order->status = 0;
            $new_service_order->type_id = $maintenance->id;
            $new_service_order->user_id = $data['user_id'];
            $new_service_order->save();
        }else{
            $service_order->date = $data['maintenance_date'];
            $service_order->time = $data['maintenance_time'];
            $service_order->user_id = $data['user_id'];
            $service_order->save();
        }

        Session::flash('message', 'Incident update succesfully.');
        return Redirect::to('/maintenances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findTechnician(Request $request){
        $keyword = $request->input('q');

        if($request->ajax()){
            $data = User::select('users.id','users.name AS text')
                ->join('role_user', 'role_user.user_id', 'users.id')
                ->where('role_user.role_id', '=', 2)
                ->where('name','like','%'.$keyword.'%')
                ->get();
            return response()->json($data);
        }
    }

    public function search_dates(){
        $maintenances = Maintenance::all();

        if(Maintenance::count()>0){
            foreach ($maintenances as $maintenance){
                $service_order = ServiceOrder::where('type', '=', 1)
                    ->where('type_id', '=', $maintenance->id)->first();

                if(count($service_order)>0){
                    $maintenance->pending = 0;
                    $maintenance->folio = $service_order->folio;
                }else{
                    $maintenance->message = 'Pendiente de configurar';
                    $maintenance->pending = 1;
                }
            }
        }

        return response()->json($maintenances);
    }

    public function assetData($id){
        $maintenance = Maintenance::find($id);

        $data = array();

        array_push($data, array('id' => $maintenance->asset->id, 'text' => $maintenance->asset->name));

        return $data;
    }

    public function getDataTechnician($id){
        $user = User::find($id);

        $data = [];

        if(!$user){
            return  response()->json([]);
        }else{
            $item = [
                'id' => $user->id,
                'name' => $user->name
            ];

            $data[] = $item;

            return response()->json($data);
        }
    }
}
