@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/incident.css") !!}
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
                <a href="{!!URL::to('/incidents')!!}">Event log </a>
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
                        <i class="icon-fire font-red-800"></i>
                        <span class="caption-subject bold font-red-800">Event log </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_registro_incidencias"))
                                    <a href="{{URL::route('incidents.create')}}" class="btn btn-circle green"><i class="fa fa-plus"></i> Add incident</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">who registered?</th>
                            <th class="center">Asset</th>
                            <th class="center">Folio</th>
                            <th class="center">Location</th>
                            <th class="center">Preference</th>
                            <th class="center">Type</th>
                            <th class="center">Hour</th>
                            <th class="center">Date</th>
                            {{--<th class="center">Estatus</th>--}}
                            <th class="center">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($incidents as $incident)
                            <tr>
                                <td class="center"> {{($incident->person)?$incident->person->name:''}} </td>
                                <td class="center"> {{($incident->asset)?$incident->asset->name:''}} </td>
                                <td class="center"> {{($incident->folio)?$incident->folio:''}} </td>
                                <td class="center">
                                    @foreach($incident->asset->locations as $location)
                                        {{$location->address.', '.$location->building.', '.$location->floor}}
                                    @endforeach
                                </td>
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
                                {{--<td class="center">  </td>--}}
                                <td>
                                  <div>
                                    @if(userHasPermission("editar_registro_incidencias"))
                                    <a href="{{URL::route('incidents.edit', $incident->id)}}" title="Edit"
                                       class="btn btn-circle btn-icon-only btn-info ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission("eliminar_registro_incidencias"))
                                    <a href="#basic" data-toggle="modal" data-name="{{$incident->name}}"
                                       data-id="{{$incident->id}}" title="Delete"
                                       class="btn btn-circle btn-icon-only red modalDelete">
                                        <i class="fa  fa-trash-o"></i>
                                    </a>
                                    @endif

                                    @if(userHasPermission("generar_orden_servicio"))
                                    <a href="{{url('service-orders/create/' . $incident->id)}}" title="Generate service order"
                                       class="btn btn-circle btn-icon-only green-meadow ">
                                        <i class="fa fa-file-text-o"></i>
                                    </a>
                                    @endif
                                  </div>
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
    @if(userHasPermission("eliminar_registro_incidencias"))
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete incident</h4>
                </div>
                <div class="modal-body" id="bodyDelete">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal" onclick="deleteUser()">Acept</button>
                    <button type="button" class="btn btn-circle red " data-dismiss="modal"></i>Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif

    <div class="modal fade" id="basic2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">The incidence can NOT be eliminated if it is in process.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal">Acept</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liIncidents").addClass("active");
            $("#liHelpDesk").addClass("active");
        });

        $(".modalDelete").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Are you sure to eliminate the incidence?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteUser(){
            var token = $("#token").val();

            $.ajax({
                url: "incidents/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function(data) {
                    if(data['success'] == true) {
                        $('#basic').hide();
                        $('#basic2').modal('toggle');
                    }else if(data['success'] == false){
                        window.location = "/incidents";
                        $("#message").fadeIn();
                    }
                }
            });
        }
    </script>
@endsection
