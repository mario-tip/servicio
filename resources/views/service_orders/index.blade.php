@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
@endsection

@section('breadcrumb')
    @include('partials.message')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Consulta de servicios</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Consulta de servicios</span>
                    </div>
                </div>
                <div class="portlet-body">
{{--                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{URL::route('service-orders.create')}}" class="btn green"><i class="fa fa-plus"></i> Nuevo Usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Folio</th>
                            <th class="center">Activo</th>
                            <th class="center">Ubicación</th>
                            <th class="center">Tipo de incidencia</th>
                            <th class="center">Problema reportado</th>
                            <th class="center">Hora</th>
                            <th class="center">Fecha</th>
                            <th class="center">Estatus</th>
                            <th class="center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($service_orders as $service_order)
                            <tr>
                                <td class="center"> {{$service_order->folio}} </td>
                                <td class="center"> {{!empty($service_order->incident) ? $service_order->incident->asset->name : null}} </td>
                                <td class="center"> {{!empty($service_order->incident) ? $service_order->incident->asset->locations[0]->address : null}} </td>
                                <td class="center"> {{$service_order->getIncidentTypeWord()}} </td>
                                <td class="center"> {{!empty($service_order->incident) ? \App\Incident::getTypeWord($service_order->incident->type) : null}} </td>
                                <td class="center"> {{$service_order->time}} </td>
                                <td class="center"> {{$service_order->date}} </td>
                                <td class="center"> {{$service_order->getStatusWord()}} </td>
                                <td>
                                    <a href="{{URL::route('service-orders.show', $service_order->id)}}" title="Mostrar" class="btn btn-icon-only green">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liServiceOrders").addClass("active");
        });
    </script>
@endsection
