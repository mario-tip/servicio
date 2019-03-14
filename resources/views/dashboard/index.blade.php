@extends('layouts.master')

@section("styles")

{!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

<div id="dashboard" class="row flex_icon">
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Dashboard</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div id="dashboards_tile" class="tiles">
            <a href="">
              <div class="tile bgDesktop">
                <div class="tile-body">
                  <i class="iconos-Dashboard-azul"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>



  @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio" ) || userHasPermission("listar_mantenimientos") ||userHasPermission("listar_cotizacion_servicios") )
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Help Desk</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div id="incidents_tile" class="tiles">
              <li class="dropdown dropdown-user">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-Help-DeskAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_registro_incidencias") )
                  <li>
                    <a href="{!!URL::to('/incidents')!!}">
                      <i class="icon-fire"></i>
                      <span>Incidents</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_consulta_servicio") || userHasPermission("listar_cotizacion_servicios"))
                  <li>
                    <a href="{!!URL::to('/help_service')!!}">
                      <i class="icon-call-in"></i>
                      <span>Service</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_mantenimientos"))
                  <li>
                    <a href="{!!URL::to('maintenances')!!}">
                      <i class="icon-wrench"></i>
                      <span>Maintenance</span>
                    </a>
                  </li>
                  @endif
                </ul>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif


  @if(userHasPermission('listar_captura_info') || userHasPermission('listar_catalogo_correlativos'))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Assets</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-AssetsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_captura_info") )
                  <li>
                    <a href="{!!URL::to('/actives')!!}">
                      <i class="icon-list"></i>
                      <span>Asset List</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_correlativos") )
                  <li>
                    <a href="{!!URL::to('/parts')!!}">
                      <i class="icon-frame"></i>
                      <span>Parts Brochure</span>
                    </a>
                  </li>
                  @endif
                </ul>
            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif

  @if(userHasPermission("generar_consulta_bitacora") || userHasPermission("descargar_consulta_bitacora") || userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("mostrar_consulta_atencion_incidencias") ||
  userHasPermission("generar_reporte_incidencias") || userHasPermission("exportar_reporte_incidencias") || userHasPermission("generar_reporte_tickets") ||userHasPermission("exportar_reporte_tickets") || userHasPermission("generar_reporte_servicio")
  || userHasPermission("exportar_reporte_servicio"))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Analytics</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-AnalyticsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_captura_info") )
                  <li>
                    <a href="{!!route('reports.binnacle-service-orders')!!}">
                      <i class="icon-earphones-alt"></i>
                      <span>Services</span>
                    </a>
                  </li>
                  @endif
                  <li>
                    <a href="{!!URL::to('/analytics_incident')!!}">
                      <i class="icon-bubble "></i>
                      <span>Incidents</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('reports.technician-tickets')}}">
                      <i class="icon-tag"></i>
                      <span>User Tikets</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('reports.customer-service-orders')}}">
                      <i class="icon-user-follow"></i>
                      <span>Customer Service</span>
                    </a>
                  </li>
                </ul>
            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif

  @if(userHasPermission("listar_catalogo_proveedores") || userHasPermission("listar_catalogo_personas") || userHasPermission("listar_catalogo_ubicaciones") || userHasPermission("listar_catalogo_clientes") ||
  userHasPermission("listar_catalogo_proyectos") || userHasPermission("listar_usuarios") || userHasPermission("listar_tipo_equipo") || userHasPermission("listar_roles"))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Settings</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-SettingsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_catalogo_proveedores"))
                  <li>
                    <a href="{{route('providers.index')}}">
                      <i class="glyphicon glyphicon-briefcase"></i>
                      <span>Suppliers</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_personas"))
                  <li>
                    <a href="{{route('persons.index')}}">
                      <i class="glyphicon glyphicon-user"></i>
                      <span>People</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_ubicaciones"))
                  <li>
                    <a href="{{route('locations.index')}}">
                      <i class="glyphicon glyphicon-map-marker"></i>
                      <span>Locations</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_clientes"))
                  <li>
                    <a href="{{route('customers.index')}}">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                      <span>Customers</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_proyectos"))
                  <li>
                    <a href="{{route('projects.index')}}">
                      <i class="glyphicon glyphicon-blackboard"></i>
                      <span>Projects</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_tipo_equipo"))
                  <li>
                    <a href="{!!URL::to('/equipments')!!}">
                      <i class="glyphicon glyphicon-barcode"></i>
                      <span>Equipments</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_usuarios"))
                  <li>
                    <a href="{!!URL::to('/users')!!}">
                      <i class="glyphicon glyphicon-sunglasses"></i>
                      <span>Users</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_roles"))
                  <li>
                    <a href="{!!URL::to('/roles')!!}">
                      <i class="icon-users"></i>
                      <span>Roles</span>
                    </a>
                  </li>
                  @endif
                </ul>

            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif
</div>

{{-- @if(userHasPermission("listar_roles"))
  <div class="row content_container">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $chart_technician->container() !!}
        </div>
    </div>
  </div>
  @endif

<div class="row">
    {!! $chart->container() !!}
  </div>

<div class="row">
      {!! $chart_line->container() !!}
  </div>

<div class="row">
      {!! $chart_pie->container() !!}
  </div>


<div class="row">
      {!! $chart_technician->container() !!}
  </div>

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
  </div> --}}

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
<script>
  // document.getElementById("incidents_tile").style.color = "blue";

  document.getElementById("incidents_tile").addEventListener("click", function(event) {
    // display the current click count inside the clicked div
    // event.target.textContent = "click count: " + event.detail;

    // document.getElementById("rebote").style.color = "blue";
  }, false);
</script>
@endsection
