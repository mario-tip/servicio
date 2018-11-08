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
						<a class="dashboard-stat red-thunderbird" href="{!!URL::to('/quotations')!!}">
  						<div class="visual">
  							<i class="fa fa-dollar"></i>
  						</div>
  						<div class="details">
  							<div class="number">

  							</div>
  							<div class="desc">
  								 Generar cotización de servicios
  							</div>
  						</div>
						</a>
					</div>



        @endif

        @if(userHasPermission("listar_catalogo_personas"))
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat red-thunderbird" href="{!!URL::to('/service-orders')!!}">
              <div class="visual">
                <i class="fa fa-dollar"></i>
              </div>
              <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                   Consulta de servicios
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
