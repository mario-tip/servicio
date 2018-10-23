@extends('layouts.master')

@section("styles")
    {!! Html::style('/assets/css/custom-styles.css') !!}
    {!! Html::style('/assets/css/report.css') !!}
@endsection
@section('page-content')
    <div class="row">
        @if(userHasPermission("generar_reporte_tickets"))
        <div class="col-md-4 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('reports.technician-tickets')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        {{-- <i class="fas fa-ticket-alt"></i> --}}
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Tickets por usuario y estatus
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(userHasPermission("generar_reporte_servicio"))
        <div class="col-md-4 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('reports.customer-service-orders')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Servicio para clientes
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(userHasPermission("generar_reporte_incidencias"))
        <div class="col-md-4 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('reports.incidents')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-bug fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Incidencias
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>
@endsection
@section("scripts")
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liReports").addClass("active");
        });
    </script>
@endsection
