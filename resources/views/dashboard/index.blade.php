@extends('layouts.master')

@section("styles")

@endsection

@section('page-content')

<div class="row content_container paddingForm">
  <div class="col-md-12">
    @if(userHasPermission("listar_roles"))

    <div class="row content_container">
      <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $chart_technician->container() !!}
        </div>
      </div>
    </div>
    @endif

    {{-- <div class="row">
      {!! $chart->container() !!}
    </div> --}}

    <div class="row">
      {!! $chart_line->container() !!}
    </div>

    <div class="row">
      {!! $chart_pie->container() !!}
    </div>


    {{-- <div class="row">
        {!! $chart_technician->container() !!}
    </div> --}}

    <div class="row content_container">
      <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $resolution->container() !!}
        </div>
      </div>
    </div>

    <div class="row content_container">
      <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $tickets->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section("scripts")

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>


{{-- {!! $chart->script() !!} --}}

{!! $chart_line->script() !!}

{!! $chart_pie->script() !!}

{!! $chart_pie_hig->script() !!}

{!! $chart_technician->script() !!}

{!! $resolution->script() !!}

{!! $tickets->script() !!}

@endsection
