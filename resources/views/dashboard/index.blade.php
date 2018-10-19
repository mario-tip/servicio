@extends('layouts.master')

@section('page-content')

    <div class="row">
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet-body">

        <div class="tiles">

        <a href="#!/dashboard/usuario">
            <div class="tile bg-blue-madison minizoom">

                <div class="tile-body">
                    <i class="icon-user" ></i>
                </div>
                <div class="tile-object">
                    <div class="text-center">
                        <h4> <strong> Usuarios </strong> </h4>
                    </div>
                    <!-- <div class="number">
                         6
                    </div> -->
                </div>
            </div>
        </a>

        <a href="#!/dashboard/cliente">
            <div class="tile bg-yellow-casablanca minizoom">
                <div class="tile-body">
                    <i class="icon-users"></i>
                </div>
                <div class="tile-object">
                    <div class="text-center">
                        <h4> <strong> Clientes </strong> </h4>
                    </div>
                </div>
            </div>
        </a>

        <a href="#!/dashboard/producto">
            <div class="tile bg-red minizoom">
                <div class="corner">
                </div>
                <div class="check">
                </div>
                <div class="tile-body">
                    <i class="icon-basket"></i>
                </div>
                <div class="tile-object">
                    <div class="text-center">
                        <h4> <strong> Productos </strong> </h4>
                    </div>
                </div>
            </div>
        </a>

        <a href="#!/dashboard/almacen">
            <div class="tile bg-green-haze minizoom">
                <!-- <div class="corner">
                </div> -->
                <div class="tile-body">
                    <i class="icon-list"></i>
                </div>
                <div class="tile-object">
                    <div class="text-center">
                        <h4><strong>Almacenes</strong></h4>
                    </div>
                </div>
            </div>
            </a>

        </div>

        <div class="tiles">

                <a href="#!/dashboard/vehiculo">
                <div class="tile bg-grey-gallery minizoom">
                    <div class="tile-body">
                        <i class="icon-support"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Vehiculos </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/ruta">
                <div class="tile bg-yellow-gold minizoom">
                    <div class="tile-body">
                        <i class="icon-pointer"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Rutas </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#!/dashboard/venta">
                <div class="tile bg-purple-wisteria minizoom">
                    <div class="tile-body">
                        <i class="icon-wallet"></i>
                    </div>
                    <div class="tile-object">
                        <div class="text-center">
                            <h4> <strong> Ventas </strong> </h4>
                        </div>
                    </div>
                </div>
            </a>

        </div>

    </div>
        </div>
    </div>

@endsection