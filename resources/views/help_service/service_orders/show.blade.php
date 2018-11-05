@extends("layouts.master")

@section("styles")
{{--{!! Html::style("/assets/css/main.css") !!}--}}
{!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
{!! Html::style("/assets/css/service_order.css") !!}
@endsection

@section('breadcrumb')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{!!URL::to('/')!!}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{!!URL::to('/service-orders')!!}">Consulta de servicios</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a>Detalle de servicio</a>
        </li>
    </ul>
</div>
@endsection

@section("page-content")
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SHOW SERVICE ORDER PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Detalle de incidencia</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Levantó incidencia: </label>
                                        <label class="control-label">{{$service_order->incident->person->name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Tipo de servicio: </label>
                                        <label class="control-label">{{App\Incident::getTypeWord($service_order->incident->type)}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Id de activo: </label>
                                        <label class="control-label">{{$service_order->incident->asset->asset_custom_id}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Nombre de activo: </label>
                                        <label class="control-label">{{$service_order->incident->asset->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label  show-label">Ubicación: </label>
                                        <label class="control-label">{{$service_order->incident->asset->locations[0]->address}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Marca: </label>
                                        <label class="control-label">{{$service_order->incident->asset->brand}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Prioridad: </label>
                                        <label class="control-label">{{\App\Incident::getPriorityWord($service_order->incident->priority)}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Serie: </label>
                                        <label class="control-label">{{$service_order->incident->asset->serial}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Hora: </label>
                                        <label class="control-label">{{$service_order->time}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Estatus: </label>
                                        <label class="control-label">{{$service_order->getStatusWord()}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Fecha: </label>
                                        <label class="control-label">{{$service_order->date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label textarea-label">Descripción del problema: </label>
                                        <div class="incident-description">
                                            {{$service_order->incident->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Fecha de atención sugerida: </label>
                                        <label class="control-label">
                                            {{$service_order->incident->suggested_date}}
                                            {{$service_order->incident->suggested_time}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Evidencia: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <?php
                                        $mime_array = App\Quotation::getFileMime(public_path($service_order->incident->evidence_file));
                                        ?>
                                        @if($mime_array == null)
                                            <h2 class="file-not-found">Archivo no encontrado</h2>
                                        @else
                                            <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                            @if($file_type == 'image')
                                                <img src="{{'/' . $service_order->incident->evidence_file}}" class="incident-image" alt="">
                                            @else
                                                <div id="icon_file_container">
                                                    <a href="{{'/' . $service_order->incident->evidence_file}}" download>
                                                        <img class="file-type-icon"
                                                             src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}"/>
                                                        </br>Descargar
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label textarea-label">Notas adicionales: </label>
                                        <div class="incident-description">
                                            {{$service_order->notes}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SHOW SERVICE ORDER PORTLET-->

            <!-- BEGIN ATENTION DETAILS PORTLET-->
           <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Detalle de atención</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                               <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Técnico: </label>
                                        <label class="control-label">{{$service_order->technician->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label textarea-label">Comentarios: </label>
                                        <div class="incident-description">
                                            {{$service_order->comments}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Autorizó {{$service_order->getIncidentTypeWord()}}: </label>
                                        <label class="control-label">
                                            {{!is_null($service_order->authorizer) ? $service_order->authorizer->name : null}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Firma: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        @if(is_null($service_order->signature))
                                            <h2 class="file-not-found">Orden de servicio sin firma</h2>
                                        @else
                                            <img src="{{'/' . $service_order->signature}}" class="incident-image" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ATENTION DETAILS PORTLET-->

            <!-- BEGIN ATENTION DETAILS PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Detalle de cotización de servicio</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <!-- La orden de servicio tiene una cotización asociada -->
                            @if(!is_null($service_order->quotation))
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Nombre de cotización: </label>
                                        <label class="control-label">
                                            {{$service_order->quotation->name}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label textarea-label">Descripción: </label>
                                        <div class="incident-description">
                                            {{$service_order->quotation->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label">Estatus: </label>
                                        <label class="control-label">
                                            {{$service_order->quotation->getAuthorizationWord()}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Archivo de cotización: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <?php
                                        $mime_array = App\Quotation::getFileMime(public_path($service_order->quotation->quotation_file));
                                        ?>
                                        @if($mime_array == null)
                                            <h2 class="file-not-found">Archivo no encontrado</h2>
                                        @else
                                            <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                            @if($file_type == 'image')
                                                <img src="{{$service_order->quotation->quotation_file}}" class="incident-image" alt="">
                                            @else
                                                <div id="icon_file_container">
                                                    <a href="{{$service_order->quotation->quotation_file}}" download>
                                                        <img class="file-type-icon"
                                                             src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}"/>
                                                        </br>Descargar
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label show-label textarea-label">Comentarios de autorización: </label>
                                        <div class="incident-description">
                                            {{$service_order->quotation->comments}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- La orden de servicio no tiene una cotización asociada -->
                            @else
                                <h2 class="quotation-not-found">El servicio no tiene cotización</h2>
                            @endif
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Partes de incidencia: </label>
                                    </div>
                                </div>
                                <!-- Table parts -->
                                <div class="col-md-12" id="incident_parts_subcontainer">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover order-column datatable-parts">
                                            <thead>
                                                <tr>
                                                    <th>Nombre de parte</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($service_order->incident->parts as $part)
                                                <tr>
                                                    <td>{{$part->name}}</td>
                                                    <td>{{$part->price}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Table parts -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ATENTION DETAILS PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/jquery.number.js")!!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/service_order_show.js")!!}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#liServiceOrders").addClass("active");
           /* $('#asset_cost').number(true, 2);*/
        });
    </script>
@endsection
