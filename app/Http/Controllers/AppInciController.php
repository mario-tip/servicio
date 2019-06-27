<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceOrder;
use Carbon\Carbon;
use App\Incident;
use App\Asset;
use DB;

class AppInciController extends Controller
{
    public function index(Request $request){
      $validate = Validator::make($request->all(), ['status' => 'required|numeric|between:0,1']);
        if ($validate->fails()) {return response()->json($validate->messages(),404);}

      $service_orders =  ServiceOrder::whereUser_id($request->user()->id)
      ->whereType(0)
      ->whereStatus($request->status)
      ->pluck('type_id');

      if ($request->has('date_month')) {
        
      }

      $result = Incident::whereIn('id', $service_orders)
      ->with('asset','order')->paginate(4);

      return count($service_orders) ? $result : response()->json(['message' => 'No se encontraron incidencias'],404);
    }

    public function store(Request $request){

      $validate = Validator::make($request->all(), [
        'asset_id' => 'required|numeric',
        'type' => 'required|numeric|between:0,1',
        'description' => 'required',
        'person_id' => 'required|numeric',
        'suggested_date' => 'required|date',
        'suggested_time' => 'required|date_format:H:i:s',
        'priority' => 'required|numeric|between:0,2',
        'evidence_file' => 'file',
      ]);
        if ($validate->fails()) {
          return response()->json($validate->messages(),404);
        }

        $data = $request->all();
        $data['suggested_date'] = Input::has('suggested_date')?Carbon::parse($data['suggested_date'])->format('Y-m-d'):'';
        $data['suggested_time'] = Input::has('suggested_time')?Carbon::parse($data['suggested_time'])->format('H:i:s'):'';

        $evidence_file = Input::file('evidence_file');
        $file = $evidence_file->getClientOriginalName();
        $ext = $evidence_file->getClientOriginalExtension();
        $name = str_random(5)."_".time()."_"."incidents" . "." . $ext;
        $fileLogo = 'images/incidents/'.$name;
        $evidence_file->move(public_path().'/images/incidents/',$fileLogo);
        $data['evidence_file'] = request()->root().'/'.$fileLogo;

        $table = Incident::all();
        $aux = $table->last()->id + 1;
        $data['folio'] =  'EEO-'.$aux;
        $data['user_id'] = $request->user()->id;

        $incident = Incident::create($data);

        $user = $request->user();//se recupera el usuario en sesion para asignar el id a la incidencia.

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

        return response()->json(['message'=>'Incidente registrado con éxito'],201);

    }

    public function show($id){
      $result = Incident::whereId($id)->with('asset','order')->get();
      return count($result) ? $result : response(['message' => 'No se encontro mantenimiento con el id '.$id],404);
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
