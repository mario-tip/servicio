@extends('layouts.master')

@section("styles")

    {!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

  <div id="dashboard" class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <div class="portlet-body">
        <div class="tiles">
            <a href="{!!URL::to('/equipments')!!}">
                <div class="tile bg-blue minizoom">

                    <div class="tile-body">
                        <i class="icon-notebook" ></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Equipment  </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/actives')!!}">
                <div class="tile bg-blue-hoki minizoom">
                    <div class="tile-body">
                        <i class="icon-login"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Asset List </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/quotations')!!}">
                <div class="tile bg-blue-steel minizoom">
                    <div class="tile-body">
                      <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Service </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/service-orders')!!}">
              <div class="tile bg-blue-madison minizoom">
                <div class="tile-body">
                  <i class="fa fa-wrench"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4><strong>Service</strong></h4>
                  </div>
                </div>
              </div>
            </a>

        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <div class="portlet-body">
        <div class="tiles">
            <a href="{!!route('reports.binnacle-service-orders')!!}">
                <div class="tile bg-green minizoom">
                    <div class="tile-body">
                      <i class="icon-book-open"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Service </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/reports')!!}">
                <div class="tile bg-green-meadow minizoom">
                    <div class="tile-body">
                        <i class="icon-bar-chart"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong>Analytics </strong> </h4>
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

            <a href="{!!URL::to('/incidents')!!}">
              <div class="tile bg-green-turquoise minizoom">
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


        </div>
      </div>
    </div>

    <div id="three" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <div class="portlet-body">
        <div class="tiles">

            <a href="{!!URL::to('/aid')!!}">
              <div class="tile bg-grey-gallery minizoom">
                <div class="tile-body">
                  <i class="fa fa-pencil-square-o"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Incidents </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('maintenances')!!}">
              <div class="tile bg-grey-cascade minizoom">
                <div class="tile-body">
                  <i class="fa fa-calendar"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Maintenance </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/catalogs')!!}">
              <div class="tile bg-grey-silver minizoom">
                <div class="tile-body">
                  <i class="fa fa-book"></i>

                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Admin panel. </strong> </h4>
                  </div>
                </div>
              </div>
            </a>
        </div>
      </div>
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
