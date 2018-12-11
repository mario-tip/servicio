<?php

namespace App\Http\Controllers;

use App\User;

use App\Person;
use App\Incident;
use App\ServiceOrder;
use Illuminate\Http\Request;
use App\Mail\OrderServiceMail;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceOrderRequest $request)
    {

        $service_order_data = $request->get('service_order');

        $service_order_data['date'] = AssetController::date2SQLFormat($service_order_data['date']);
        $service_order_data['type'] = '0';
        $service_order_data['status'] = '0';

        try{
            $serviceOrderTemp = ServiceOrder::create($service_order_data);
            // dd($serviceOrderTemp->technician['email']);
            // $request->notify(new AsignedOrder($serviceOrderTemp->technician['email'])) ;
            // return (new Mailable())->to($serviceOrderTemp->technician['email']);
            
            Mail::to($serviceOrderTemp->technician['email'])->send(new OrderServiceMail($serviceOrderTemp));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
