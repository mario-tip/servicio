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
                <a href="{!!URL::to('/parts')!!}">Catálogo de correlativos</a>
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
                        <span class="caption-subject bold">Catálogo de correlativos</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_catalogo_correlativos"))
                                    <a href="{{URL::route('parts.create')}}" class="btn green"><i class="fa fa-plus"></i> Nueva parte</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Nombre de parte</th>
                            <th class="center">Número de parte</th>
                            <th class="center">Precio</th>
                            <th class="center">Descripción</th>
                            <th class="center">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($parts as $part)
                            <tr>
                                <td class="center"> {{$part->name}} </td>
                                <td class="center"> {{$part->number}} </td>
                                <td class="center"> {{$part->price}} </td>
                                <td class="center"> {{$part->description}} </td>
                                <td>
                                    @if(userHasPermission("editar_catalogo_correlativos"))
                                    <a href="{{  URL::route('parts.edit', $part->id) }}" title="Editar"
                                       class="btn btn-icon-only green-meadow ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission("eliminar_catalogo_correlativos"))
                                    <a href="#basic" data-toggle="modal" data-name="{{$part->name}}"
                                       data-id="{{$part->id}}" title="Eliminar"
                                       class="btn btn-icon-only red modalDelete">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endif
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

    @if(userHasPermission("eliminar_catalogo_correlativos"))
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar correlativo</h4>
                </div>
                <div class="modal-body" id="bodyDelete">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn green-meadow" data-dismiss="modal" onclick="deleteUser()">Aceptar</button>
                    <button type="button" class="btn red " data-dismiss="modal"></i>Cancelar</button>
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
                <div class="modal-body">El correlativo NO se puede eliminar si esta asociado a un activo o equipo.</div>
                <div class="modal-footer">
                    <button type="button" class="btn green-meadow" data-dismiss="modal">Aceptar</button>
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
            $("#liParts").addClass("active");
        });

        $(".modalDelete").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("¿Desea eliminar el correlativo seleccionado?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteUser(){
            var token = $("#token").val();

            $.ajax({
                url: "/parts/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function(data) {
                    if(data['success'] == true) {
                        $('#basic').hide();
                        $('#basic2').modal('toggle');
                    }else if(data['success'] == false){
                        window.location = "/parts";
                        $("#message").fadeIn();
                    }
                }
            });
        }
    </script>
@endsection
