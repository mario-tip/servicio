@extends('layouts.master')

@section("styles")

    {!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

  <div id="dashboard" class="row ">

    @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio"))
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
              @if(userHasPermission("listar_consulta_servicio") )  
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
              @if(userHasPermission("crear_mantenimiento_programado") )  
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
              @if(userHasPermission("listar_problemas") )
                <a href="{!!URL::to('/problems')!!}">
                  <div class="tile bg-red-500 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Problems </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
              @endif
            </div>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
    @endif


    @if(userHasPermission('listar_captura_info'))
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
                  <a href="{!!URL::to('/actives')!!}">
                      <div class="tile bg-cian-700 minizoom">

                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong> Asset List </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

                    <a href="{!!URL::to('/actives')!!}">
                        <div class="tile bg-cian-600 minizoom">

                            <div class="tile-object">
                                <div class="text-center">
                                    <h4> <strong> Asset Groups </strong> </h4>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{!!URL::to('/parts')!!}">
                        <div class="tile bg-cian-500 minizoom">

                            <div class="tile-object">
                                <div class="text-center">
                                    <h4> <strong>Parts brochure </strong> </h4>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{!!URL::to('/service-orders')!!}">
                      <div class="tile bg-cian-400 minizoom">

                        <div class="tile-object">
                          <div class="text-center">
                            <h4><strong>Asset Active</strong></h4>
                          </div>
                        </div>
                      </div>
                    </a>

                    <a href="{!!URL::to('/service-orders')!!}">
                      <div class="tile bg-cian-300 minizoom">

                        <div class="tile-object">
                          <div class="text-center">
                            <h4><strong>Asset inactive</strong></h4>
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

    @if(userHasPermission("listar_tipo_equipo"))
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
                  <a href="{!!route('reports.binnacle-service-orders')!!}">
                      <div class="tile bg-green-700 minizoom">

                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong> Services </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

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

    @if(userHasPermission("listar_tipo_equipo"))
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
                  <a href="{{route('providers.index')}}">
                    <div class="tile bg-blue-800 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Suppliers  </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{{route('persons.index')}}" >
                    <div class="tile bg-blue-700 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> People </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{{route('locations.index')}}" >
                    <div class="tile bg-blue-600 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4> <strong> Locations </strong> </h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{{route('customers.index')}}">
                    <div class="tile bg-blue-500 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Customers</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{{route('projects.index')}}">
                    <div class="tile bg-blue-400 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Proyects</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{!!URL::to('/equipments')!!}">
                    <div class="tile bg-blue-300 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Equipments</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{!!URL::to('/users')!!}">
                    <div class="tile bg-blue-200 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Users</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{!!URL::to('/roles')!!}">
                    <div class="tile bg-blue-200 minizoom">
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Roles</strong></h4>
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
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12">
      <!-- BEGIN PORTLET-->
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-red-sunglo hide"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
            <span class="caption-helper">monthly stats...</span>
          </div>
          <div class="actions">
            <div class="btn-group">
              <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              Filter Range&nbsp;<span class="fa fa-angle-down">
              </span>
              </a>
              <ul class="dropdown-menu pull-right">
                <li>
                  <a href="javascript:;">
                  Q1 2014 <span class="label label-sm label-default">
                  past </span>
                  </a>
                </li>
                <li>
                  <a href="javascript:;">
                  Q2 2014 <span class="label label-sm label-default">
                  past </span>
                  </a>
                </li>
                <li class="active">
                  <a href="javascript:;">
                  Q3 2014 <span class="label label-sm label-success">
                  current </span>
                  </a>
                </li>
                <li>
                  <a href="javascript:;">
                  Q4 2014 <span class="label label-sm label-warning">
                  upcoming </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="portlet-body">
          <div id="site_activities_loading">
            <img src="../../assets/admin/layout2/img/loading.gif" alt="loading"/>
          </div>
          <div id="site_activities_content" class="display-none">
            <div id="site_activities" style="height: 228px;">
            </div>
          </div>
          <div style="margin: 20px 0 10px 30px">
            <div class="row">
              <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                <span class="label label-sm label-success">
                Revenue: </span>
                <h3>$13,234</h3>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                <span class="label label-sm label-danger">
                Shipment: </span>
                <h3>$1,134</h3>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                <span class="label label-sm label-primary">
                Orders: </span>
                <h3>235090</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END PORTLET-->
    </div>
  </div>

@endsection

@section("scripts")
<script>

  // document.getElementById("incidents_tile").style.color = "blue";

  document.getElementById("incidents_tile").addEventListener("click", function( event ) {
    // display the current click count inside the clicked div
    // event.target.textContent = "click count: " + event.detail;

    // document.getElementById("rebote").style.color = "blue";
  }, false);

</script>
@endsection
