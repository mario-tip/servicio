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
                        <i class="fa fa-list-alt fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Proveedores
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
                        Personas
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(userHasPermission("listar_catalogo_ubicaciones"))
        <div class="col-md-3 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('locations.index')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="icon-target fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Ubicaciones
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(userHasPermission("listar_catalogo_clientes"))
        <div class="col-md-3 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('customers.index')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Clientes
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>
    <div class="row">
        @if(userHasPermission("listar_catalogo_proyectos"))
        <div class="col-md-3 col-sm-12 col-xs-12 dashboard-item-container">
            <a href="{{route('projects.index')}}">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-gears fa-5x"></i>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Proyectos
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
            $("#liCatalogs").addClass("active");
        });
    </script>
@endsection