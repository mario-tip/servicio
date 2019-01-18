<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
// use App\Charts\SampleChart2;
// use App\User;


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
        // $chart = Charts::create('line','highcharts')
        //     ->setTitle("My Website Users")
        //     ->setlabels(["ES","FR", "RU"])
        //     ->setValues([100,50,25])
        //     ->setElementLabel("Total users"); 

        
    
        // $chart = new SampleChart2;
        // $chart->labels(['One', 'Two', 'Three', 'Four']);
        // $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        // $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);

        return view('dashboard.index', compact('chart'));
    }
}
