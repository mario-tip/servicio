@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/provider.css") !!}
@endsection

@section('breadcrumb')
    <div id="notification_container">
        @include('partials.message')
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <a>Suppliers</a>
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
                        <i class="glyphicon glyphicon-briefcase font-blue-800"></i>
                        <span class="caption-subject bold font-blue-800">Suppliers brochure</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_catalogo_proveedores"))
                                    <a href="{{URL::route('providers.create')}}" class="btn btn-circle green"><i class="fa fa-plus"></i> Add supplier</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Name</th>
                                <th class="center">Address</th>
                                <th class="center">Telephono</th>
                                @if(userHasPermission("editar_catalogo_proveedores") ||userHasPermission("eliminar_catalogo_proveedores") )
                                <th class="center">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($providers as $provider)
                            <tr>
                                <td class="center">{{$provider->name}}</td>
                                <td class="center">{{$provider->address}}</td>
                                <td class="center">{{$provider->phone}}</td>
                                @if(userHasPermission("editar_catalogo_proveedores") ||userHasPermission("eliminar_catalogo_proveedores") )
                                <td>
                                    @if(userHasPermission("editar_catalogo_proveedores"))
                                    <a href="{{route('providers.edit', $provider->id) }}" title="Edit" class="btn btn-circle btn-icon-only btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission("eliminar_catalogo_proveedores"))
                                    <a href="#basic" data-toggle="modal" data-name="{{$provider->name}}" data-id="{{$provider->id}}" title="Delete" class="btn btn-circle btn-icon-only red delete-provider">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endif
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
    @if(userHasPermission("eliminar_catalogo_proveedores"))
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Delete provider </h4>
                </div>
                <div class="modal-body" id="bodyDelete"></div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal" onclick="deleteProvider()">Ok</button>
                    <button type="button" class="btn btn-circle red " data-dismiss="modal"></i>Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif

    <div class="modal fade" id="unable_delete_provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">The provider can not be deleted, if it is associated with other records.</div>
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
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liTools").addClass("active");
            $("#liSuppliers").addClass("active");

        });

        $(".delete-provider").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Are you sure you want to delete the provider?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteProvider(){
            var token = $("#token").val();

            $.ajax({
                url: "/catalogs/providers/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function(response) {
                    if(response.errors === true) {
                        if(response.type_error === 'unable') {
                            $('#basic').hide();
                            $('#unable_delete_provider').modal('toggle');
                        } else {
                            $('#notification_container').html(response.errors_fragment);
                        }
                    } else {
                        window.location = "/catalogs/providers";
                        $("#message").fadeIn();
                    }
                }
            });
        }
    </script>
@endsection
