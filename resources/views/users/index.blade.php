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
                <a href="{!!URL::to('/users')!!}">Usuarios</a>
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
                        <span class="caption-subject bold">Usuarios</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{URL::route('users.create')}}" class="btn green"><i class="fa fa-plus"></i> Nuevo Usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Nombre</th>
                            <th class="center">Correo electrónico</th>
                            <th class="center">Nobre de usuario</th>
                            <th class="center">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="center"> {{$user->name}} </td>
                                <td class="center"> {{$user->email}} </td>
                                <td class="center"> {{$user->username}} </td>
                                <td>
                                    <a href="{{  URL::route('users.edit', $user->id) }}" title="Editar" class="btn btn-icon-only green-meadow ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#basic" data-toggle="modal" data-name="{{$user->name}}" data-id="{{$user->id}}" title="Eliminar" class="btn btn-icon-only red delete-equipment">
                                        <i class="fa fa-times"></i>
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
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar usuario</h4>
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
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liUsr").addClass("active");
        });

        $(".modalDelete").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("¿Seguro que desea eliminar el usuario?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteUser(){
            var token = $("#token").val();

            $.ajax({
                url: "users/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function() {
                    window.location = "/users";
                    $("#message").fadeIn();
                }
            });
        }
    </script>
@endsection
