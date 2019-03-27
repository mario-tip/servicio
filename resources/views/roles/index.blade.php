
@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {!!Html::style("/assets/global/plugins/icheck/skins/all.css")!!}
    {!!Html::style("/assets/css/roles.css")!!}


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
                <a href="{!!URL::to('/roles')!!}">Roles</a>
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
              <p class="titleForm">Roles</p>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_roles"))
                                    <a href="{{URL::route('roles.create')}}" class="btn btnList"><i class="fa fa-plus"></i> New roll </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">ID</th>
                                <th class="center">Name</th>
                                @if(userHasPermission("editar_roles") || userHasPermission("mostrar_roles") || userHasPermission("eliminar_roles"))
                                <th class="center">Actions</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td class="center">{{$role->id}}</td>
                                <td class="center">{{$role->name}}</td>
                                @if(userHasPermission("editar_roles") || userHasPermission("mostrar_roles") || userHasPermission("eliminar_roles"))
                                <td >
                                    <div class="center_items">
                                        @if(userHasPermission("editar_roles"))
                                        <a href="{{URL::route('roles.edit', $role->id) }}" title="Edit" class="btn btnIconList">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endif
                                        @if(userHasPermission("eliminar_roles"))
                                        <a href="#basic" data-toggle="modal" data-name="{{$role->name}}" data-id="{{$role->id}}" title="Delete" class="btn btn-icon-only red circle modalDelete">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        @endif
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
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete role </h4>
                </div>
                <div class="modal-body" id="bodyDelete">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn green-meadow circle" data-dismiss="modal" onclick="deleteRole()">Ok</button>
                    <button type="button" class="btn red circle" data-dismiss="modal"></i>Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="basic2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">The role can NOT be deleted if it is associated with an user.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal">Ok</button>
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
    {!! Html::script("/assets/global/plugins/icheck/icheck.min.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){

            $("#liTools").addClass("active");
            $("#liRoles").addClass("active");

        });

        $(".modalDelete").click(function(){

            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Are you sure delete role?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteRole(){
            var token = $("#token").val();

            $.ajax({
                url: "roles/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function(data) {
                    if(data['success'] == true) {
                        $('#basic').hide();
                        $('#basic2').modal('toggle');
                    }else if(data['success'] == false){
                        window.location = "/roles";
                        $("#message").fadeIn();

                    }
                }
            });
        }

    </script>
@endsection
