@extends('layouts.master')

@section("styles")
    {{-- {!! Html::style('/assets/css/custom-styles.css') !!} --}}
    {!! Html::style('/assets/css/help_desk.css') !!}
    {{-- {!! Html::style('/assets/global/css/components-rounded.css') !!} --}}
@endsection
@section('page-content')
    <div class="row">
        @if(userHasPermission("listar_consulta_atencion_incidencias"))
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat bg-green-600 red-thunderbird" href="{!!URL::to('/aid')!!}">
  						<div class="visual">
  							<i class="icon-speedometer"></i>
  						</div>
  						<div class="details">
  							<div class="number">

  							</div>
  							<div class="desc">
  								 Attention of incidents
  							</div>
  						</div>
						</a>
					</div>
        @endif

        @if(userHasPermission("generar_reporte_incidencias"))
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat red-thunderbird bg-green-600" href="{{route('reports.incidents')}}">
              <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
              </div>
              <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                   Incident report
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
            $("#liAnalitycs").addClass("active");
            $("#liAnalyticsIncidents").addClass("active");

        });
    </script>
@endsection
