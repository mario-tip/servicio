@extends('layouts.master')

@section('page-content')

  <div id="dashboard" class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <div class="portlet-body">
        <div class="tiles">
            <a href="{!!URL::to('/equipments')!!}">
                <div class="tile bg-blue-madison minizoom">

                    <div class="tile-body">
                        <i class="icon-notebook" ></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Cat.Equipos  </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/actives')!!}">
                <div class="tile bg-yellow-casablanca minizoom">
                    <div class="tile-body">
                        <i class="icon-login"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Cap. de info. </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/quotations')!!}">
                <div class="tile bg-red minizoom">
                    <div class="tile-body">
                      <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Cotización </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/service-orders')!!}">
              <div class="tile bg-green-haze minizoom">
                <div class="tile-body">
                  <i class="fa fa-wrench"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4><strong>Consulta Serv.</strong></h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!route('reports.binnacle-service-orders')!!}">
                <div class="tile bg-grey-gallery minizoom">
                    <div class="tile-body">
                      <i class="icon-book-open"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Consulta Bit. </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/reports')!!}">
                <div class="tile bg-yellow-gold minizoom">
                    <div class="tile-body">
                        <i class="icon-bar-chart"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong>Reportes </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/parts')!!}">
                <div class="tile bg-purple-wisteria minizoom">
                    <div class="tile-body">
                      <i class="icon-grid"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong>Correlativos </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{!!URL::to('/incidents')!!}">
              <div class="tile bg-yellow-casablanca minizoom">
                <div class="tile-body">
                  <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Reg. incidencias </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/aid')!!}">
              <div class="tile bg-green-seagreen minizoom">
                <div class="tile-body">
                  <i class="fa fa-pencil-square-o"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Cons. incidencias </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('maintenances')!!}">
              <div class="tile bg-blue-madison minizoom">
                <div class="tile-body">
                  <i class="fa fa-calendar"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Admon. mtos. </strong> </h4>
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
                    <h4> <strong> Catalogos. </strong> </h4>
                  </div>
                </div>
              </div>
            </a>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
    </div>
  </div>

@endsection
