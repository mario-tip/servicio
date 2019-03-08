<?php
namespace App\Http\Controllers;
use App\Http\Requests\ServiceOrderRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderServiceMail;
use App\Mail\sendUserMail;
use Illuminate\Http\Request;
use App\ServiceOrder;
use App\Incident;
use App\Person;
use App\User;
use DB;

class ServiceOrderController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = $request->user();

        if(userHasPermission("listar_consulta_servicio")) {
            if ($user->type_user == 2 ) {
                $service_orders = $user->getOrders;
            } else {
                $service_orders = ServiceOrder::all();
            }

            return view('help_service.service_orders.index', compact('service_orders'));
        }
        return redirect()->back();
    }

    public function create($incident_id){
        if(userHasPermission("generar_orden_servicio")) {
            $incident = Incident::find($incident_id);
            $dependencies = $this->getDependenciesData();
            return view('help_service.service_orders.create', compact('incident', 'dependencies'));
        }
        return redirect()->back();
    }

    /*Obtiene las dependencias de la orden de servicio, para los select del form*/
    private function getDependenciesData() {
        return [
            'technicians' => User::getSelectTechnicians()];
    }

    public function store(ServiceOrderRequest $request){
        $user = $request->user();
        // dd($user->email);

        $service_order_data = $request->get('service_order');
        $service_order_data['date'] = AssetController::date2SQLFormat($service_order_data['date']);
        $service_order_data['type'] = '0';
        $service_order_data['status'] = '0';

        try{
            $serviceOrderTemp = ServiceOrder::create($service_order_data);


            //Manda correo a la persona que esta generando la orden de servicio en caso de que tenga activa las notificaciones de ordenes de servicio.
            if($user->active_notification_order){
                Mail::to($user->email)->send(new sendUserMail($serviceOrderTemp));
            }

            //Envia correo de notificacion al tecnico asignado.
            // dd($serviceOrderTemp->technician['email']);

            Mail::to($serviceOrderTemp->technician['email'])->send(new OrderServiceMail($serviceOrderTemp));

            // Se envia correo a los de "con copia a" configurado en usuario.
            $users_send = DB::table('users')
                ->join('user_notification_order', 'users.id', '=', 'user_notification_order.notification_order_id')
                ->select('users.*')
                ->where('user_notification_order.user_id', '=', $user->id)
                ->get();

            foreach ($users_send as $key => $user_send) {
                // Mail::to($user_send->email)->send(new copyServiceOrder($serviceOrderTemp,$user_send));
                Mail::to($user_send->email)->send(new sendUserMail($serviceOrderTemp));
            }

            $request->session()->flash('message', 'Service order saved correctly');
            return redirect('/service-orders');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id){
        if(userHasPermission("mostrar_consulta_servicio")) {
            $service_order = ServiceOrder::find($id);
            return view('help_service.service_orders.show', compact('service_order'));
        }
        return redirect()->back();
    }

}
