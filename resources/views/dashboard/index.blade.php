@extends('layouts.master')

@section("styles")
    
    {!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

  <div id="dashboard" class="row ">

    @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio"  ) || userHasPermission("listar_mantenimientos") ||userHasPermission("listar_cotizacion_servicios") )
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet">
          <div id="flex_icon" class="portlet-title">
            <div class="caption tools">
              <div id="incidents_tile" class="tiles expand" >
                <a href="" >
                  <div  class="tile bg-red-900 minizoom">
                    <div class="tile-body">
                      <i class="icon-earphones-alt"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Help Desk</strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="portlet-body" style="display:none" >
            <div class="tiles">
              @if(userHasPermission("listar_registro_incidencias") )
              <a href="{!!URL::to('/incidents')!!}">
                <div id="rebote" class="tile bg-red-800 minizoom ">
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong> Incidents </strong> </h4>
                    </div>
                  </div>
                </div>
              </a>
              @endif
              @if(userHasPermission("listar_consulta_servicio") || userHasPermission("listar_cotizacion_servicios"))  
                <a href="{!!URL::to('/help_service')!!}">
                  <div class="tile bg-red-700 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Service</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>
              @endif
              @if(userHasPermission("listar_mantenimientos"))  
                <a href="{!!URL::to('maintenances')!!}">
                  <div class="tile bg-red-600 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Maintenance </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
              @endif

              {{-- @if(userHasPermission("listar_problemas") )
                <a href="{!!URL::to('/problems')!!}">
                  <div class="tile bg-red-500 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Problems </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
              @endif --}}
            </div>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
    @endif


    @if(userHasPermission('listar_captura_info') || userHasPermission('listar_catalogo_correlativos'))
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet ">
          <div id="flex_icon" class="portlet-title">
            <div class="caption tools">
              <div class="tiles expand">
                <a href="" >
                  <div class="tile bg-cian-800 minizoom">
                    <div class="tile-body">
                      <i class="icon-screen-desktop"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Assets</strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="portlet-body" style="display:none">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="portlet-body">
                <div class="tiles">
                  @if(userHasPermission("listar_captura_info") )
                  <a href="{!!URL::to('/actives')!!}">
                    <div class="tile bg-cian-700 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Asset List </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif

                  {{-- @if(userHasPermission("listar_captura_info") )
                  <a href="{!!URL::to('/actives')!!}">
                    <div class="tile bg-cian-600 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Asset Groups </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif --}}

                  @if(userHasPermission("listar_catalogo_correlativos") )
                  <a href="{!!URL::to('/parts')!!}">
                    <div class="tile bg-cian-600 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong>Parts brochure </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif

                  {{-- <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-cian-400 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Asset Active</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a> --}}

                  {{-- <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-cian-300 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Asset inactive</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a> --}}

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
    @endif

    @if(userHasPermission("generar_consulta_bitacora") || userHasPermission("descargar_consulta_bitacora") || userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("mostrar_consulta_atencion_incidencias") || userHasPermission("generar_reporte_incidencias") || userHasPermission("exportar_reporte_incidencias") || userHasPermission("generar_reporte_tickets") ||userHasPermission("exportar_reporte_tickets") || userHasPermission("generar_reporte_servicio") || userHasPermission("exportar_reporte_servicio")) 
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
      <!-- BEGIN Portlet PORTLET-->
      <div class="portlet ">
        <div id="flex_icon" class="portlet-title">
          <div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-green-900 minizoom">
                  <div class="tile-body">
                    <i class="icon-graph"></i>
                  </div>
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong>Analytics</strong> </h4>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="portlet-body" style="display:none">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="portlet-body">
              <div class="tiles">

                @if(userHasPermission("listar_captura_info") )
                <a href="{!!route('reports.binnacle-service-orders')!!}">
                  <div class="tile bg-green-700 minizoom">
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Services </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
                @endif
                <a href="{!!URL::to('/analytics_incident')!!}">
                  <div class="tile bg-green-600  minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Incidents </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.technician-tickets')}}">
                  <div class="tile bg-green-500 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>User Tikets</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.customer-service-orders')}}">
                    <div class="tile bg-green-400  minizoom">

                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong>Customer Serv. </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Portlet PORTLET-->
    </div>
    @endif

    @if(userHasPermission("listar_catalogo_proveedores") || userHasPermission("listar_catalogo_personas") || userHasPermission("listar_catalogo_ubicaciones") || userHasPermission("listar_catalogo_clientes") || userHasPermission("listar_catalogo_proyectos") || userHasPermission("listar_usuarios") || userHasPermission("listar_tipo_equipo") || userHasPermission("listar_roles")) 
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet ">
          <div id="flex_icon" class="portlet-title">
            <div class="caption tools">
              <div class="tiles expand" >
                <a href="" >
                  <div class="tile bg-blue-900 minizoom">
                    <div class="tile-body">
                      <i class="icon-settings"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Admin Panel</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="portlet-body" style="display:none">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="portlet-body">
                <div class="tiles">
                  @if(userHasPermission("listar_catalogo_proveedores"))
                  <a href="{{route('providers.index')}}">
                    <div class="tile bg-blue-800 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Suppliers  </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_catalogo_personas"))
                  <a href="{{route('persons.index')}}" >
                    <div class="tile bg-blue-700 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> People </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_catalogo_ubicaciones"))
                  <a href="{{route('locations.index')}}" >
                    <div class="tile bg-blue-600 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Locations </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_catalogo_clientes"))
                  <a href="{{route('customers.index')}}">
                    <div class="tile bg-blue-500 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Customers</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_catalogo_proyectos"))
                  <a href="{{route('projects.index')}}">
                    <div class="tile bg-blue-400 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Projects</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_tipo_equipo"))
                  <a href="{!!URL::to('/equipments')!!}">
                    <div class="tile bg-blue-300 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Equipments</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_usuarios"))
                  <a href="{!!URL::to('/users')!!}">
                    <div class="tile bg-blue-200 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Users</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @if(userHasPermission("listar_roles"))
                  <a href="{!!URL::to('/roles')!!}">
                    <div class="tile bg-blue-200 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Roles</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
    @endif
  </div>
  @if(userHasPermission("listar_roles"))
  <div class="row content_container">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $chart_technician->container() !!}
        </div>
    </div>
  </div>
  @endif

  <div class="row">
    {{-- {!! $chart->container() !!} --}}
  </div>

  <div class="row">
      {{-- {!! $chart_line->container() !!} --}}
  </div>

  <div class="row">
      {{-- {!! $chart_pie->container() !!} --}}
  </div>


  <div class="row">
      {{-- {!! $chart_technician->container() !!}  --}}
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
<script>
  
  // document.getElementById("incidents_tile").style.color = "blue";

  document.getElementById("incidents_tile").addEventListener("click", function( event ) {
    // display the current click count inside the clicked div
    // event.target.textContent = "click count: " + event.detail;

    // document.getElementById("rebote").style.color = "blue";
  }, false);

  
</script>
@endsection
