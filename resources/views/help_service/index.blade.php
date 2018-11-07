@extends('layouts.master')

@section("styles")
    {{-- {!! Html::style('/assets/css/custom-styles.css') !!} --}}
    {{-- {!! Html::style('/assets/css/catalogs_dashboard.css') !!} --}}
    {!! Html::style('/assets/global/css/components-rounded.css') !!}
@endsection
@section('page-content')
    <div class="row">
        @if(userHasPermission("listar_catalogo_proveedores"))
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light blue-soft" href="#">
  						<div class="visual">
  							<i class="fa fa-comments"></i>
  						</div>
  						<div class="details">
  							<div class="number">
  								 1349
  							</div>
  							<div class="desc">
  								 New Feedbacks
  							</div>
  						</div>
						</a>
					</div>



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
