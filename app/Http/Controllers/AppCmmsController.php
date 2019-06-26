<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ServiceOrder;
use App\Maintenance;
use Carbon\Carbon;
use App\Incident;
use App\Provider;
use App\Person;
use App\Asset;
use App\User;
use DB;

class AppCmmsController extends Controller
{
    public function index(Request $request){

      if ($request->has('perra')) {
      return $request->perra;
      }
      $service_orders =  ServiceOrder::whereUser_id(Auth::user()->id)
      ->whereType(1)->pluck('type_id');
      $result = Maintenance::whereIn('id', $service_orders)->with('asset','order')
      ->paginate(4);
      return $result;
    }

    public function store(Request $request){

      $valin = Validator::make($request->all(), [
            'asset_id' => 'required|numeric',
            'provider_id' => 'required|numeric',
            'maintenance_date' => 'required|date',
            'maintenance_time' => 'required|date_format:H:i:s',
            'user_id' => 'required|numeric',
            'notes' => 'required'
        ]);

        $resp = [];
        if ($valin->fails()) {
          $variable = $valin->messages();
          foreach ($variable as $key => $value) {
            $resp = [
              'key' => $value
            ];
          }
          return $variable;
          return response()->json($valin->messages(),400);
        }

      $data = $request->all();

      $data['maintenance_date'] = Input::has('maintenance_date')?Carbon::parse($data['maintenance_date'])->format('Y-m-d'):'';
      $data['maintenance_time'] = Input::has('maintenance_time')?Carbon::parse($data['maintenance_time'])->format('H:i:s'):'';

      // Valores por default (todos menzos porque estan esos campos)
      $data['type'] = 0;
      $data['is_periodical'] = false;
      // dd($data);
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
      return response()->json([
        'msg' => 'Se creo orden de mantenimiento con exito',
        'id' => $service_order->id,
        'code' => 201
      ], 201);
    }

    public function show($id){
      if(userHasPermission("mostrar_mantenimientos")):
          $maintenance = Maintenance::find($id);

          $asset = Asset::find($maintenance->asset_id);

          $service_order = ServiceOrder::where('type', '=', 1)
              ->where('type_id', '=', $maintenance->id)->first();

          if($service_order != null){
              $person = Person::find($service_order->person_id);

              $maintenance->folio = $service_order->folio;
              $maintenance->person_notes = $service_order->notes;

              if($person != null){
                  $maintenance->person_name = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
              }else{
                  $maintenance->person_name = '';
              }

              $name = $service_order->technician()->select('users.username')->first();
              $maintenance->technician = $name->username;

              if($service_order->signature){
                  $maintenance->signature = '/'.$service_order->signature;
              }

          }else{
              $maintenance->folio = '';
              $maintenance->person_notes = '';
              $maintenance->person_name = '';
              $maintenance->signature = '';
          }

          return $maintenance;
      else:
          return 'sin permisos';
      endif;

    }

    public function update(Request $request, $id){

      $data = $request->all();

      $maintenance = Maintenance::find($id);

      $data['maintenance_date'] = Input::has('maintenance_date')?Carbon::parse($data['maintenance_date'])->format('Y-m-d'):'';
      $data['maintenance_time'] = Input::has('maintenance_time')?Carbon::parse($data['maintenance_time'])->format('H:i:s'):'';

      $maintenance->update($data);
    }

    public function destroy($id){
      $maintenance = Maintenance::find($id);
      if ($maintenance) {
        return $maintenance;
      }
      return 'no esxiste el mantenimiento';
    }

    public function getUser(){
      return Auth::user();
    }

    public function create(){
      $providers = Provider::all('id', 'name');
      $technicians = User::where('type_user', 2)->select('id','name','username')->get();
      $assets = Asset::all('id','asset_custom_id','name','serial','barcode','image');
      $data = [
        'providers' => $providers,
        'technicians' => $technicians,
        'assets' => $assets
      ];
      return $data;
    }

    public function searchServices(Request $request){

      $valin = Validator::make($request->all(), [
            'customer_id' => 'required',
            'service_order_date' => 'required',
        ]);

        if ($valin->fails()) {
          return response()->json($valin->messages(),400);
        }
        return 'ola k ase';
    }

    public function ResolveMain(Request $request){
      // IDEA: URL: attend

      $valin = Validator::make($request->all(), [
          'type_id' => 'required|numeric',
          'person_id' => 'required|numeric',
          'signature' => 'required|image',
          'img_evidence' => 'image',
          'comments' => 'required',
          'status' => 'required|numeric'
        ]);

        if ($valin->fails()) {
          return response()->json($valin->messages(),404);
        }
          $sign = $request->file('signature');
          $ImgEvidence = $request->file('img_evidence');

          $data = $request->only(['type_id','person_id','signature','img_evidence','comments','status']);

          $OrderService = ServiceOrder::whereType_id($data['type_id'])->whereType(0)->latest()->get();
          if (!count($OrderService)) {
            return response()->json(['message' => 'No se encontro la orden de servicio'],400);
          }

          if (!empty($sign)) {
              $file = $sign->getClientOriginalName();
              $ext = $sign->getClientOriginalExtension();
              $name = str_random(5) . "_" . time() . "_" . "signature" . "." . $ext;
              $fileLogo = 'images/resolutions/' . $name;
              $sign->move(public_path() . '/images/resolutions/', $fileLogo);
              $data['signature'] = request()->root().'/'.$fileLogo;
          }

          if (!empty($ImgEvidence)) {
            $file = $ImgEvidence->getClientOriginalName();
            $ext = $ImgEvidence->getClientOriginalExtension();
            $name = str_random(5) . "_" . time() . "_" . "evidence_maintenance" . "." . $ext;
            $name_evidence = 'images/resolutions/' . $name;
            $ImgEvidence->move(public_path() . '/images/resolutions/', $name_evidence);
            $data['img_evidence'] = request()->root().'/'.$name_evidence;
          }

          $data['resolution_date'] = Carbon::now()->format('Y-m-d');
          $data['resolution_time'] = Carbon::now()->format('H:i:s');
          // ServiceOrder::whereId($request->id)->update($data);
          ServiceOrder::whereType_id($data['type_id'])->whereType(0)->latest()->update($data);

          $user = $request->user();

          $users_send = DB::table('users')
          ->join('user_notification_end', 'users.id', '=', 'user_notification_end.notification_end_id')
          ->select('users.*')
          ->where('user_notification_end.user_id', '=', $user->id)
          ->get();


          if($user->active_notification_end){
              Mail::to($user->email)->send(new ServiceOrderEnd($service_order));
          }

          foreach ($users_send as $key => $user_send) {
              Mail::to($user_send->email)->send(new ServiceOrderEnd($service_order));
          }

          if (!empty($parts)) {
              if ($service_order->type == 0) {
                  $incident = Incident::find($service_order->type_id);
                  $incident_parts = $incident->parts()->sync($parts);
              }
          }

        return response()->json(['error' => false, 'message' => 'Registro actualizado correctamente'],201);
    }

    public function GetPersons(Request $request){

      return $request->user()->customers;
    // IDEA: Servicio para obtener la lista de clientes que pueden autorizar
      // $identicon = new \Identicon\Identicon();
      // return  $identicon->displayImage('tachi',150);
      // return Person::select('id','name','father_last_name','mother_last_name','email','created_at','updated_at')
      // ->where('customer_id', )->get();
    }

}
