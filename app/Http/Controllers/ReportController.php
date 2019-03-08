<?php
namespace App\Http\Controllers;
use App\Customer;
use App\Project;
use App\ServiceOrder;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**START TECHNICIAN_TICKETS REPORT**/
    /*Muestra la vista de reporte de tickets*/
    public function showTechnicianTickets()
    {
        if(userHasPermission("generar_reporte_tickets")):
            $technicians =  User::getSelectTechnicians()->toArray();
            $technicians[0] = 'Todos';
            ksort($technicians);
            $projects = Project::getSelectProjects()->toArray();
            $projects[0] = 'Todos';
            ksort($projects);
            return view('reports.technician_tickets', compact('technicians', 'projects'));
        else:
            return redirect()->back();
        endif;
    }

    /*Genera los resultados con los filtros aplicados*/
    public function generateTechnicianTickets(Request $request)
    {
        if(userHasPermission("generar_reporte_tickets")):
            $response = ['errors' => false];
            $filters = $request->get('tickets');

            try {
                $results = ServiceOrder::generateTechnicianTickets($filters);
                Log::notice($results);
                $response['results'] = $results;
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            if(count($response['results']) == 0) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['message' => 'No results found'])
                    ->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }


    /*Exporta el reporte a excel*/
    public function exportTechnicianTickets(Request $request)
    {
        if(userHasPermission("exportar_reporte_tickets")):
            $response = ['errors' => false];
            $tickets = $request->get('data');

            $report_excel = [];
            foreach (json_decode($tickets) as $key){
                $aux = [
                    "folio" => $key->folio,
                    "customer" => $key->customer,
                    "person" => $key->person,
                    "asset" => $key->asset,
                    "resolution_date" => $key->resolution_date,
                    "technician" => $key->technician,
                    "location" => $key->location,
                    "status" => $key->status,
                ];
                array_push($report_excel, $aux);
            }

            $headers = ["folio", "customer", "person", "asset_attended", "date_attention" , "technical", "location", "status"];

            array_unshift($report_excel, $headers);

            try {
                Excel::create('reporte_tickets', function($excel) use($report_excel) {
                    $excel->sheet('Tickets', function($sheet) use ($report_excel) {
                        $sheet->fromArray($report_excel, null, 'A1', false, false);
                    });
                })->export('xls');

            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }
    /**END TECHNICIAN_TICKETS REPORT**/

    /**START INCIDENTS REPORT**/
    /*Muestra la vista reporte de incidencias*/
    public function showIncidents()
    {
        if(userHasPermission("generar_reporte_incidencias")){
            return view('reports.incidents');
        }
        return redirect()->back();
    }

    /*Genera los resultados con los filtros aplicados*/
    public function generateIncidents(Request $request)
    {
        if(userHasPermission("generar_reporte_incidencias")):
            $response = ['errors' => false];
            $filters = $request->get('incidents');

            try {
                $results = ServiceOrder::generateIncidents($filters);
                $response['results'] = $results;
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            if(count($response['results']) == 0) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['message' => 'No results found'])
                    ->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }
    /*Exporta el reporte a excel*/
    public function exportIncidents(Request $request)
    {
        if(userHasPermission("exportar_reporte_incidencias")):
            $response = ['errors' => false];
            $incidents = $request->get('data');
            var_dump( $incidents );

            $report_excel = [];
            foreach (json_decode($incidents) as $key){
                $aux = [
                    "folio" => $key->folio,
                    "asset_id" => $key->asset_id,
                    "customer" => $key->customer,
                    "person" => $key->person,
                    "asset_name" => $key->asset_name,
                    "resolution_date" => $key->resolution_date,
                    "technician" => $key->technician,
                    "location" => $key->location,
                    "status" => $key->status,
                ];
                array_push($report_excel, $aux);
            }

            $headers = ["folio", "asset_ID", "customer", "person", "asset_attended" , "date_attention", "technical", "location", "status"];
            array_unshift($report_excel, $headers);

            try {
                Excel::create('reporte_incidencias', function($excel) use($report_excel) {
                    $excel->sheet('Incidencias', function($sheet) use ($report_excel) {
                        $sheet->fromArray($report_excel, null, 'A1', false, false);
                    });
                })->export('xls');

            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }
    /**END INCIDENTS REPORT**/

    /**START CUSTOMER_SERVICE_ORDERS REPORT**/
    /*Muestra la vista de reporte de tickets*/
    public function showCustomerServiceOrders()
    {
        if(userHasPermission("generar_reporte_servicio")):
            $customers =  Customer::getSelectCustomers()->toArray();
            $customers[0] = 'All';
            ksort($customers);
            $projects = Project::getSelectProjects()->toArray();
            $projects[0] = 'All';
            ksort($projects);
            return view('reports.customer_service_orders', compact('customers', 'projects'));
        else:
            return redirect()->back();
        endif;
    }

    /*Genera los resultados con los filtros aplicados*/
    public function generateCustomerServiceOrders(Request $request)
    {
        // dd($request);
        if(userHasPermission("generar_reporte_servicio")):
            $response = ['errors' => false];
            $filters = $request->get('service_orders');
            // dd($filters);
            // $filters['project_id'] = intval($filters['project_id']);

            // echo $filters['project_id'];
            try {
                $results = ServiceOrder::generateCustomerServiceOrders($filters);

                // $results = ServiceOrder::join('incidents', 'incidents.folio', '=', 'service_order.folio')
                //                         ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                //                         ->join('projects', 'projects.id','=', 'assets.project_id')
                //                         ->where('projects.id','=', $filters['project_id'])
                //                         ->get();

                // dd ($results);

                // $results = DB::select( DB::raw("SELECT projects.`name`,assets.id,incidents.folio,service_order.id,service_order.folio from assets
                //   INNER JOIN projects ON assets.project_id = projects.id
                //   INNER JOIN incidents ON assets.id = incidents.asset_id
                //   INNER JOIN service_order ON incidents.folio = service_order.folio
                //   WHERE projects.id = 7") );


                $response['results'] = $results;

            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            if(count($response['results']) == 0) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['message' => 'No results found'])
                    ->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }

    /*Exporta el reporte a excel*/
    public function exportCustomerServiceOrders(Request $request)
    {
        if(userHasPermission("exportar_reporte_servicio")):
            $response = ['errors' => false];
            $tickets = $request->get('data');

            $report_excel = [];
            foreach (json_decode($tickets) as $key){
                $aux = [
                    "folio" => $key->folio,
                    "customer" => $key->customer,
                    "person" => $key->person,
                    "asset" => $key->asset,
                    "resolution_date" => $key->resolution_date,
                    "technician" => $key->technician,
                    "location" => $key->location,
                    "status" => $key->status,
                ];
                array_push($report_excel, $aux);
            }

            $headers = ["folio", "customer", "person", "asset_attended", "date_attention" , "technical", "location", "status"];
            array_unshift($report_excel, $headers);

            try {
                Excel::create('reporte_ordenes_servicio_cliente', function($excel) use($report_excel) {
                    $excel->sheet('Ordenes_Servicio_Cliente', function($sheet) use ($report_excel) {
                        $sheet->fromArray($report_excel, null, 'A1', false, false);
                    });
                })->export('xls');

            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }
    /**END CUSTOMER_SERVICE_ORDERS REPORT**/


    /**START BINNACLE_SERVICE_ORDERS REPORT**/
    /*Muestra la vista de reporte de tickets*/
    public function showBinnacleServiceOrders()
    {
        if(userHasPermission("generar_consulta_bitacora")) {
            return view('reports.binnacle_service_orders');
        }
        return redirect()->back();
    }

    /*Genera los resultados con los filtros aplicados*/
    public function generateBinnacleServiceOrders(Request $request)
    {
        if(userHasPermission("generar_consulta_bitacora")):
            $response = ['errors' => false];
            $filters = $request->get('service_orders');
            try {
                $results = ServiceOrder::generateBinnacleServiceOrders($filters);
                $response['results'] = $results;
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            if(count($response['results']) == 0) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['message' => 'No results found'])
                    ->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }

    /*Exporta el reporte a excel*/
    public function exportBinnacleServiceOrders(Request $request)
    {
        if(userHasPermission("descargar_consulta_bitacora")):
            $response = ['errors' => false];
            $tickets = $request->get('data');

            $report_excel = [];
            foreach (json_decode($tickets) as $key){
                $aux = [
                    "folio" => $key->folio,
                    "customer" => $key->customer,
                    "person" => $key->person,
                    "asset" => $key->asset,
                    "resolution_date" => $key->resolution_date,
                    "technician" => $key->technician,
                    "location" => $key->location,
                    "status" => $key->status,
                ];
                array_push($report_excel, $aux);
            }

            $headers = ["folio", "customer", "person", "asset_attended", "date_attention" , "user", "location", "operation"];

            array_unshift($report_excel, $headers);

            try {
                Excel::create('reporte_bitácora_servicios', function($excel) use($report_excel) {
                    $excel->sheet('Bitácora_Servicios', function($sheet) use ($report_excel) {
                        $sheet->fromArray($report_excel, null, 'A1', false, false);
                    });
                })->export('xls');

            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return response()->json($response);
            }

            return response()->json($response);
        endif;
    }
    /**END BINNACLE_SERVICE_ORDERS REPORT**/
}
