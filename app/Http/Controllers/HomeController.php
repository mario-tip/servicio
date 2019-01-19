<?php

namespace App\Http\Controllers;

use App\User;
// use Charts;
// use App\Charts\SampleChart2;
use Carbon\Carbon;
use App\Charts\SampleChart;
use Illuminate\Http\Request;
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
        $chart->labels(['2 years ago', '1 year ago', 'today year']);
        $chart->dataset('My dataset', 'line', [$users_2_days_ago_c, $yesterday_users_c, $todat_year_users_c]);

        return view('dashboard.index', compact('chart'));
    }
}
