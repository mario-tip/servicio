<?php

namespace App\Http\Controllers;

use App\User;
use App\Incident;
use Carbon\Carbon;
use App\ServiceOrder;
use App\Charts\SampleChart;
use Illuminate\Http\Request;
use App\Charts\SampleChartHig;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $today_users = User::whereDate('created_at', today())->count();

        $date_today0 = Carbon::now();
        $year_today = $date_today0->year;
        $year_today_string = strval($year_today);

        $todat_year_users = DB::table('users')
                ->whereYear('created_at', $year_today_string)
                ->get();
        $todat_year_users_c = $todat_year_users->count();
        // dd($todat_year_users_c);

        $date_today1 = Carbon::now();
        $endDate1 = $date_today1->subYear();
        $endDate1 = $endDate1->toDateString();

        $yesterday_users = DB::table('users')
                ->whereYear('created_at', $endDate1)
                ->get();
        $yesterday_users_c = $yesterday_users->count();
        // dd($yesterday_users);

        $date_today2 = Carbon::now();
        $endDate2 = $date_today2->subYears(2);
        $endDate2 = strval($endDate2);

        $users_2_days_ago = DB::table('users')
                ->whereYear('created_at', $endDate2)
                ->get();
        $users_2_days_ago_c = $users_2_days_ago->count();
        // dd($users_2_days_ago);


        // $chart = new SampleChart;
        // $chart->labels(['One', 'Two', 'Three', 'Four']);
        // $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        // $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);


        $chart = new SampleChart;
        $chart->labels(['2 years ago', '1 year ago', 'Today year']);
        $chart->dataset('My users register', 'bar', [$users_2_days_ago_c, $yesterday_users_c, $todat_year_users_c])->backgroundColor('#80CBC4');

        $chart_line = new SampleChart;
        $chart_line->labels(['2 years ago', '1 year ago', 'Today year']);
        $chart_line->dataset('My users register', 'line', [$users_2_days_ago_c, $yesterday_users_c, $todat_year_users_c])->backgroundColor('#80DEEA');

        $chart_pie = new SampleChart;
        $chart_pie->labels(['Resueltos', 'Abiertos']);
        $chart_pie->dataset('Orders services ', 'pie', [80,20])->backgroundColor(['#80DEEA','#81C784','#F4511E']);

        $chart_pie_hig = new SampleChartHig;
        $chart_pie_hig->labels(['Close', 'Open']);
        $chart_pie_hig->dataset('Incidents', 'pie', [80,20]);

        //
        $name_technicians = array();
        $orders_open = array();
        $orders_close = array();
        $open_dataset = array();
        $close_dataset = array();

        $technicians = User::where('type_user', 2)->get();
        foreach ($technicians as $key => $technician) {
            array_push($name_technicians,$technician->name);
            $orders_open = ServiceOrder::where('user_id', $technician->id)
                                            ->where('status',0)
                                            ->get();
            $orders_count = $orders_open->count();
            // dd($orders_count);
            array_push($open_dataset,$orders_count);

            $orders_close = ServiceOrder::where('user_id', $technician->id)
                                            ->where('status',1)
                                            ->get();
            $orders_count = $orders_close->count();
            // dd($orders_count);
            array_push($close_dataset,$orders_count);
        }

        // dd($close_dataset);

        // dd($name_technicians);

        $chart_technician = new SampleChart;
        $chart_technician->labels($name_technicians);
        $chart_technician->dataset('Open', 'bar',$open_dataset)->backgroundColor('#80DEEA');
        $chart_technician->dataset('Close', 'bar',$close_dataset)->backgroundColor('#78909C');




        $resolution = new SampleChart;
        $resolution->labels(['High','Medium','Low']);
        $resolution->dataset('Open', 'horizontalBar',$open_dataset)->backgroundColor('#80DEEA');

        $prom_low = self::getResolutionProm(0); //prioridad  0 1 2

        return view('dashboard.index', compact('chart','chart_line','chart_pie','chart_pie_hig','chart_technician','resolution'));
    }

    //funcion que retorna el promedio de una prioridad  Baja=0  Media=1  ALta=2
    public function getResolutionProm($type_resolution){
        $orders_service = ServiceOrder::where('status',1)
                                            ->get();
        foreach ($orders_service as $key => $order_service) {
            $incidents = Incident::where('folio',$order_service->folio)
                                        ->get();
        }
        $response = 0;
                                            // dd($orders_service);
        return $response;
    }

}
