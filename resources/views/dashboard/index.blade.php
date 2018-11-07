@extends('layouts.master')

@section("styles")

    {!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

  <div id="dashboard" class="row">

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet gren">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-blue-hoki minizoom">
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
            <a href="{!!URL::to('/incidents')!!}">
              <div class="tile bg-blue minizoom">
                <div class="tile-body">
                  <i class="icon-fire"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Incidents </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/help_service')!!}">
              <div class="tile bg-blue-hoki minizoom">
                <div class="tile-body">
                  <i class="icon-call-in"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4><strong>Service</strong></h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('maintenances')!!}">
              <div class="tile bg-blue-steel minizoom">
                <div class="tile-body">
                  <i class="icon-wrench"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Maintenance </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/problems')!!}">
              <div class="tile bg-blue-madison minizoom">
                <div class="tile-body">
                  <i class="icon-bell"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Problems </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

          </div>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet gren">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand">
              <a href="" >
                <div class="tile bg-green-seagreen minizoom">
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
                    <div class="tile bg-green minizoom">
                        <div class="tile-body">
                            <i class="icon-list"></i>
                        </div>
                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong> Asset List </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

                  <a href="{!!URL::to('/actives')!!}">
                      <div class="tile bg-green-meadow minizoom">
                          <div class="tile-body">
                              <i class="icon-layers"></i>
                          </div>
                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong> Asset Groups </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

                  <a href="{!!URL::to('/parts')!!}">
                      <div class="tile bg-green-seagreen minizoom">
                          <div class="tile-body">
                            <i class="icon-grid"></i>
                          </div>
                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong>Parts brochure </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

                  <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-green-turquoise minizoom">
                      <div class="tile-body">
                        <i class="icon-check"></i>
                      </div>
                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Asset Active</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-green-jungle minizoom">
                      <div class="tile-body">
                        <i class="icon-close"></i>
                      </div>
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

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet gren">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-grey-silver minizoom">
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
                    <div class="tile bg-grey-gallery minizoom">
                        <div class="tile-body">
                          <i class="icon-earphones-alt"></i>
                        </div>
                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong> Services </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{!!URL::to('/aid')!!}">
                  <div class="tile bg-grey-cascade minizoom">
                    <div class="tile-body">
                      <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Incidents </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.incidents')}}">
                  <div class="tile bg-grey-silver minizoom">
                    <div class="tile-body">
                      <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Incidents </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.technician-tickets')}}">
                  <div class="tile bg-blue-chambray minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>User Tikets</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.customer-service-orders')}}">
                    <div class="tile bg-grey-gallery minizoom">
                        <div class="tile-body">
                          <i class="icon-user-follow"></i>
                        </div>
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

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet gren">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-purple-plum minizoom">
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
                  <div class="tile bg-purple-medium minizoom">
                    <div class="tile-body">
                        <i class="glyphicon glyphicon-briefcase" ></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Suppliers  </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('persons.index')}}" >
                  <div class="tile bg-purple-studio minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> People </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('locations.index')}}" >
                  <div class="tile  bg-purple-seance minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-map-marker"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Locations </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('customers.index')}}">
                  <div class="tile bg-purple minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Customers</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('projects.index')}}">
                  <div class="tile bg-purple-plum minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-blackboard"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Proyects</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{!!URL::to('/equipments')!!}">
                  <div class="tile bg-purple-wisteria minizoom">
                    <div class="tile-body">
                      <i class="glyphicon glyphicon-barcode"></i>
                    </div>
                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Equipments</strong></h4>
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
      {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
          <div class="visual">
              <i class="fa fa-users"></i>
          </div>
          <div class="details">
              <div class="number">
                  <span data-counter="counterup" data-value="0">0</span>
              </div>
              <div class="desc">Usuarios</div>
          </div>
      </a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 red" href="#">
          <div class="visual">
              <i class="fa fa-list"></i>
          </div>
          <div class="details">
              <div class="number">
                  <span data-counter="counterup" data-value="0">0</span>
              </div>
              <div class="desc">Nombre de catálogo</div>
          </div>
      </a>
    </div> --}}

  </div>

@endsection
