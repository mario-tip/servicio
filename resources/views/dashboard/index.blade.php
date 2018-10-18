@extends('layouts.master')

@section('page-content')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span>
                    </div>
                    <div class="desc">Usuarios</div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-list"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span>
                    </div>
                    <div class="desc">Name Catalog</div>
                </div>
            </a>
        </div>
    </div>

@endsection