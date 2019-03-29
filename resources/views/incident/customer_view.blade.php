@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/quotation.css") !!}
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
                <a href="{!!URL::to('/aid')!!}">Consulta de incidencias</a>
            </li>
        </ul>
    </div> --}}
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Consulta de incidencias</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">

                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th class="center">Prioridad</th>
                            <th class="center">Técnico</th>
                            <th class="center">Estatus</th>
                            <th class="center">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($incidents as $incident)
                            <tr>
                                <td class="center"> {{$incident->folio}} </td>
                                <td class="center"> {{($incident->asset)?$incident->asset->name:''}} </td>
                                <td class="center"> {{$incident->location}} </td>
                                @if($incident->type == 0)
                                    <td class="center"> Limpieza </td>
                                @else
                                    <td class="center"> Reparación </td>
                                @endif
                                <td> {{$incident->description}} </td>
                                <td class="center"> {{$incident->suggested_time}} </td>
                                <td class="center"> {{\Carbon\Carbon::parse($incident->suggested_date)->format('d-m-Y')}} </td>
                                @if($incident->priority == 0)
                                    <td class="center"> Alta </td>
                                @elseif($incident->priority == 1)
                                    <td class="center"> Media </td>
                                @else
                                    <td class="center"> Baja </td>
                                @endif
                                <td class="center"> {{$incident->technician}} </td>
                                <td class="center"> {{$incident->status}} </td>
                                <td>
                                    <a href="#quotation-modal" data-toggle="modal" title="Autorizar cotización" data-id="{{$incident->quotation_id}}"
                                       data-authorization="{{$incident->quotation_authorization}}" class="btn btn-icon-only green-meadow change-quotation-status">
                                        <i class="fa fa-check"></i>
                                    </a>

                                    <a href="{!!URL::to('/customerIncidentsDetails/'.$incident->id)!!}" title="Ver detalle"
                                       class="btn btn-icon-only green-meadow ">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="quotation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Autorizar cotización</h4>
                </div>
                <div id="modal_errors_container"></div>
                {!! Form::open(['id' => 'authorization_form']) !!}
                <div class="modal-body" id="bodyUpdateFirmware">
                    <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}">
                    @include("quotations.forms.authorization_form")
                </div>
                <div class="form-actions col-sm-offset-5">
                    <button type="submit" class="btn green-meadow">Guardar</button>
                    <a class="btn red" href="#" data-dismiss="modal">Cancelar</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    {!! Html::script("/assets/scripts/change-authorization-status.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liCustomerIncidents").addClass("active");
        });
    </script>
@endsection
