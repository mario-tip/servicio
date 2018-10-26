@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
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
                <a href="{!!URL::to('/aid')!!}">Consulta y atención de incidencias</a>
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
                        <span class="caption-subject bold">Consulta y atención de incidencias</span>
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
                            <th class="center">Persona quien levanto la incidencia</th>
                            <th class="center">Activo</th>
                            <th class="center">Ubicación</th>
                            <th class="center">Prioridad</th>
                            <th class="center">Tipo de incidencia</th>
                            <th class="center">Hora</th>
                            <th class="center">Fecha</th>
                            <th class="center">Técnico</th>
                            <th class="center">Estatus</th>
                            <th class="center">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($incidents as $incident)
                            <tr>
                                <td class="center"> {{($incident->person)?$incident->person->name:''}} {{($incident->person)?$incident->person->father_last_name:''}}
                                    {{($incident->person)?$incident->person->mother_last_name:''}} </td>
                                <td class="center"> {{($incident->asset)?$incident->asset->name:''}} </td>
                                <td class="center"> {{$incident->location}} </td>
                                @if($incident->priority == 0)
                                    <td class="center"> Alta </td>
                                @elseif($incident->priority == 1)
                                    <td class="center"> Media </td>
                                @else
                                    <td class="center"> Baja </td>
                                @endif
                                @if($incident->type == 0)
                                    <td class="center"> Limpieza </td>
                                @else
                                    <td class="center"> Reparación </td>
                                @endif
                                <td class="center"> {{$incident->suggested_time}}  </td>
                                <td class="center"> {{\Carbon\Carbon::parse($incident->suggested_date)->format('d-m-Y')}} </td>
                                <td class="center"> {{$incident->technician}} </td>
                                <td class="center"> {{$incident->status}} </td>
                                <td>
                                    @if(userHasPermission("mostrar_consulta_atencion_incidencias"))
                                    <a href="{!!URL::to('/incidents_datails/'.$incident->id)!!}" title="Ver detalle"
                                       class="btn btn-circle btn-icon-only green-meadow ">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
            $("#liAid").addClass("active");
        });
    </script>
@endsection
