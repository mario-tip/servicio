@extends('layouts.master')

@section('page-content')

  <div id="dashboard" class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
      <div class="portlet-body">
        <div class="tiles">
            <a href="#!/dashboard/usuario">
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

            <a href="#!/dashboard/cliente">
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

            <a href="#!/dashboard/producto">
                <div class="tile bg-red minizoom">
                    <div class="tile-body">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Cotización </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/almacen">
              <div class="tile bg-green-haze minizoom">
                <div class="tile-body">
                  <i class="fas fa-concierge-bell"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4><strong>Consulta Serv.</strong></h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="#!/dashboard/vehiculo">
                <div class="tile bg-grey-gallery minizoom">
                    <div class="tile-body">
                      <i class="fas fa-book-open"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Consulta Bit. </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/ruta">
                <div class="tile bg-yellow-gold minizoom">
                    <div class="tile-body">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong>Reportes </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/venta">
                <div class="tile bg-purple-wisteria minizoom">
                    <div class="tile-body">
                      <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Cat. Correlativos </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/venta">
              <div class="tile bg-yellow-casablanca minizoom">
                <div class="tile-body">
                  <i class="fas fa-cogs"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Reg. incidencias </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="#!/dashboard/venta">
              <div class="tile bg-green-seagreen minizoom">
                <div class="tile-body">
                  <i class="fas fa-chart-area"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Cons. incidencias </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="#!/dashboard/venta">
              <div class="tile bg-blue-madison minizoom">
                <div class="tile-body">
                  <i class="fas fa-business-time"></i>
                </div>
                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Admon. mtos. </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="#!/dashboard/venta">
              <div class="tile bg-grey-silver minizoom">
                <div class="tile-body">
                  <i class="fas fa-journal-whills"></i>

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
