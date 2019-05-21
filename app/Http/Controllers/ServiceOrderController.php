<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Person;
use App\Incident;
use App\ServiceOrder;
use Illuminate\Http\Request;
use App\Mail\OrderServiceMail;
use App\Mail\sendUserMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ServiceOrderRequest;


class ServiceOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $user = $request->user();
        // dd($user->type_user);

        if(userHasPermission("listar_consulta_servicio")) {
            if ($user->type_user == 2 ) {
                // dd($user->getOrders);
                $service_orders = $user->getOrders;
                // dd(service_orders);
            } else {
                $service_orders = ServiceOrder::all();
                // dd($service_orders);
            }

            return view('help_service.service_orders.index', compact('service_orders'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($incident_id)
    {
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

    public function store(ServiceOrderRequest $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(userHasPermission("mostrar_consulta_servicio")) {
            $service_order = ServiceOrder::find($id);
            return view('help_service.service_orders.show', compact('service_order'));
        }
        return redirect()->back();
    }

}
