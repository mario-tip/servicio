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
use App\Asset;
use App\Person;

class AppCmmsController extends Controller
{
    public function index(){
      $service_orders =  ServiceOrder::whereUser_id(Auth::user()->id)
      ->whereType(1)->pluck('type_id');
      $result = Maintenance::whereIn('id', $service_orders)->with('asset')
      ->paginate(2);
      return $result;
    }

    public function store(Request $request){

      $valin = Validator::make($request->all(), [
            'asset_id' => 'required',
            'provider' => 'required'
        ]);

        if ($valin->fails()) {
          return response()->json($valin->messages());
        }

      $data = $request->all();

      $data['maintenance_date'] = Input::has('maintenance_date')?Carbon::parse($data['maintenance_date'])->format('Y-m-d'):'';
      $data['maintenance_time'] = Input::has('maintenance_time')?Carbon::parse($data['maintenance_time'])->format('H:i:s'):'';

      // Valores por default (toods menzos porque estan esos campos)
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
      return response()->json('Se creo orden de mantenimiento', 201);
    }

    public function show($id){
      if(userHasPermission("mostrar_mantenimientos")):
          $maintenance = Maintenance::find($id);

          $asset = Asset::find($maintenance->asset_id);

          $service_order = ServiceOrder::where('type', '=', 1)
              ->where('type_id', '=', $maintenance->id)->first();
              // dd(['estas es la orden de servicio'=>$service_order]);

          if($service_order != null){
              $person = Person::find($service_order->person_id);

              $maintenance->folio = $service_order->folio;
              $maintenance->person_notes = $service_order->notes;



              if($person != null){
                  $maintenance->person_name = $person->name.' '.$person->father_last_name.' '.$person->mother_last_name;
                  // dd($maintenance);
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
}
