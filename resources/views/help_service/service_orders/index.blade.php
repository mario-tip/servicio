@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}

    {!! Html::style("/assets/css/service_order.css") !!}
@endsection

@section('breadcrumb')
    @include('partials.message')
    {{-- <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/help_service')!!}">Service</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>View services</a>
            </li>
        </ul>
    </div> --}}
@endsection

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
              <p class="titleForm">View services</p>
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
                    <div>
                            {{-- {{$service_orders->technician}} --}}
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Sheet number</th>
                            <th class="center">Asset</th>
                            <th class="center">Location</th>
                            <th class="center">Incident type</th>
                            <th class="center">Sheet number</th>
                            <th class="center">Hour</th>
                            <th class="center">Date </th>
                            <th class="center">Technical </th>
                            <th class="center">Status</th>
                            @if(userHasPermission("mostrar_consulta_servicio") )
                                <th class="center">Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($service_orders as $service_order)

                            <tr>
                                <td class="center"> {{$service_order->folio}} </td>
                                @if($service_order->type == 0)
                                <td class="center"> {{!empty($service_order->incident) ? $service_order->incident->asset->name : null}} </td>
                                @else
                                <td class="center"> {{!empty($service_order->maintenance) ? $service_order->maintenance->asset->name : null}} </td>
                                @endif

                                @if($service_order->type == 0)
                                <td class="center"> {{!empty($service_order->incident) ? $service_order->incident->asset->locations[0]->address : null}} </td>
                                @else
                                <td class="center"> {{!empty($service_order->maintenance) ? $service_order->maintenance->asset->locations[0]->address : null}} </td>
                                @endif

                                <td class="center"> {{$service_order->getIncidentTypeWord()}} </td>
                                @if($service_order->type == 0)
                                <td class="center"> {{!empty($service_order->incident) ? \App\Incident::getTypeWord($service_order->incident->type) : null}} </td>
                                @else
                                <td class="center"> {{!empty($service_order->maintenance) ? \App\Maintenance::getTypeWord($service_order->maintenance->type) : null}} </td>
                                @endif
                                <td class="center"> {{$service_order->time}} </td>
                                <td class="center"> {{$service_order->date}} </td>
                                <td class="center"> {{$service_order->technician->name }}</td>

                                <td class="center">
                                  @if ($service_order->getStatusWord() == "Pending")
                                    <span class="label label-sm label-info">
                                      {{$service_order->getStatusWord()}}
                                    </span>
                                  @else
                                    <span class="label label-sm label-success">
                                      {{$service_order->getStatusWord()}}
                                    </span>
                                  @endif
                                </td>

                                @if(userHasPermission("mostrar_consulta_servicio") )
                                <td>
                                  <div>
                                    <a href="{{URL::route('service-orders.show', $service_order->id)}}" title="Mostrar" class="btn btnIconList">
                                      <i class="fa fa-eye"></i>
                                    </a>
                                  </div>
                                </td>
                                @endif
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
            $("#liHelpDesk").addClass("active");
        });
    </script>
@endsection
