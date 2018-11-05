@extends('layouts.master')

@section("styles")
    {!! Html::style('/assets/css/custom-styles.css') !!}
    {!! Html::style('/assets/css/catalogs_dashboard.css') !!}
@endsection
@section('page-content')
    <div class="row">
        @if(userHasPermission("listar_catalogo_proveedores"))
        <div class="col-md-3 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('providers.index')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-taxi fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Generar cotizacion de servicios
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(userHasPermission("listar_catalogo_personas"))
        <div class="col-md-3 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('persons.index')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Cosulta de servicios
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
            $("#liHelpDesk").addClass("active");
            $("#liServiceOrders").addClass("active");

        });
    </script>
@endsection
