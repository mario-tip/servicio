@extends("layouts.master")
@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}

    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/asset.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Consulta de incidencias</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Detalle de incidencia</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
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
                                        <label class="control-label"><b>Persona quien levantó la incidencia:</b></label>
                                        <label class="control-label">{{$incident->full_name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Tipo de servicio:</b></label>
                                        @if($incident->type == 0)
                                            <label class="control-label">Limpieza</label>
                                        @else
                                            <label class="control-label">Reparación</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Id de activo:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->id:''}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Nombre de activo:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->name:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Ubicación:</b></label>
                                        <label class="control-label">{{$incident->location}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Marca:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->brand:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Prioridad:</b></label>
                                        @if($incident->priority == 0)
                                            <label class="control-label">Alta</label>
                                        @elseif($incident->priority == 1)
                                            <label class="control-label">Media</label>
                                        @else
                                            <label class="control-label">Baja</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Serie:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->serial:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Hora:</b></label>
                                        <label class="control-label">{{$incident->time}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Estatus:</b></label>
                                        <label class="control-label">{{$incident->status}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Fecha:</b></label>
                                        <label class="control-label">{{$incident->date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label"><b>Descripción del problema:</b></label>
                                        <label class="control-label textarea-content">{{$incident->description}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Fecha de atención sugerida:</b></label>
                                        <label class="control-label">{{$incident->suggested_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Evidencia:</b></label>
                                        <a href="#" title="Evidencia" class="thumbnail">
                                            <img src="{{'/'.$incident->evidence_file}}" style="max-width: 300px" alt="Evidence">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Notas adicionales:</b></label>
                                        <label class="control-label">{{$incident->notes}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                        <label class="control-label"><b>Técnico:</b></label>
                                        <label class="control-label">{{$incident->technician}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label"><b>Comentarios:</b></label>
                                        <label class="control-label textarea-content">{{$incident->person_notes}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Partes afectadas:</b></label>
                                        <ul class="list-group">
                                            @foreach($data as $d)
                                                <li class="list-group-item">{{$d->part_number.' - '.$d->part_name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Persona que autorizó el mantenimiento:</b></label>
                                        <label class="control-label">{{$incident->person}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Firma:</b></label>
                                        <div>
                                            <a href="#" title="Firma" class="thumbnail">
                                                <img src="{{$incident->signature}}" style="max-width: 500px" alt="Signature">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Detalle de cotización de servicio</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Nombre de cotización:</b></label>
                                        <label class="control-label">{{$quotation->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label"><b>Descrición:</b></label>
                                        <label class="control-label textarea-content">{{$quotation->description}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Estatus:</b></label>
                                        @if($quotation->authorization==0)
                                            <label class="control-label">Pendiente</label>
                                        @elseif($quotation->authorization==1)
                                            <label class="control-label">Autorizado</label>
                                        @else
                                            <label class="control-label">No autorizado</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Adjuntar archivo de cotización:</b></label>
                                        <div>
                                            <a href="#" title="Firma" class="thumbnail">
                                                <img src="{{$quotation->quotation_file}}" style="max-width: 500px" alt="Signature">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Comentarios de cotización:</b></label>
                                        <label class="control-label">{{$quotation->comments}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Partes de incidencia:</b></label>
                                        <table class="table table-striped table-bordered table-hover order-column" id="datatable_parts">
                                            <thead>
                                            <tr>
                                                <th>Nombre de parte</th>
                                                <th>Precio</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotation->parts as $part)
                                                <tr>
                                                    <td>{{$part->name}}</td>
                                                    <td class="currency-format">{{$part->price}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}

    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-date-time-pickers.min.js") !!}

    {!! Html::script("/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") !!}
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}

    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/select2.full.min.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/i18n/es.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAid").addClass("active");

            $(".activos").css('border', 'none');
            $(".activos").css('background-color', '#fefeff');
            $(".activos").prop('readonly', true);
        });
    </script>
@endsection