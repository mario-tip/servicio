@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/location.css") !!}
@endsection

@section('breadcrumb')
    <div id="notification_container">
        @include('partials.message')
    </div>
    {{-- <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <a>Location</a>
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
              <p class="titleForm">Locations</p>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_catalogo_ubicaciones"))
                                    <a href="{{URL::route('locations.create')}}" class="btn btnList"><i class="fa fa-plus"></i> New location</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Description</th>
                            <th class="center">Building</th>
                            <th class="center">Area</th>
                            @if(userHasPermission("editar_catalogo_ubicaciones") || userHasPermission("eliminar_catalogo_ubicaciones"))
                            <th class="center">Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td class="center"> {{$location->description}}</td>
                                <td class="center"> {{$location->building}}</td>
                                <td class="center"> {{$location->area}}</td>
                                @if(userHasPermission("editar_catalogo_ubicaciones") || userHasPermission("eliminar_catalogo_ubicaciones"))
                                <td>
                                  <div>
                                    @if(userHasPermission("editar_catalogo_ubicaciones"))
                                    <a href="{{route('locations.edit', $location->id) }}" title="Edit" class="btn btnIconList">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission("eliminar_catalogo_ubicaciones"))
                                    <a href="#basic" data-toggle="modal" data-name="{{$location->name}}" data-id="{{$location->id}}" title="Delete" class="btn btn-circle btn-icon-only red delete-location">
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
    @if(userHasPermission("eliminar_catalogo_ubicaciones"))
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete location</h4>
                </div>
                <div class="modal-body" id="bodyDelete">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal" onclick="deleteUser()">Ok</button>
                    <button type="button" class="btn btn-circle red " data-dismiss="modal"></i>Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif

    <div class="modal fade" id="unable_delete_location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">The location CAN NOT be deleted if it is associated with an asset.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal">Aceptar</button>
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
            $("#liLocations").addClass("active");
        });

        $(".delete-location").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Are you sure delete the location ?");
            nodeName.appendChild(nameNode);
            $("#bodyDelete").empty();
            document.getElementById("bodyDelete").appendChild(nodeName);
        });

        function deleteUser(){
            var token = $("#token").val();

            $.ajax({
                url: "/catalogs/locations/"+id+"",
                headers: {'X-CSRF-TOKEN': token},
                type: "DELETE",
                success: function(response) {
                    if(response.errors === true) {
                        if(response.type_error === 'unable') {
                            $('#basic').hide();
                            $('#unable_delete_location').modal('toggle');
                        } else {
                            $('#notification_container').html(response.errors_fragment);
                        }
                    } else {
                        window.location = "/catalogs/locations";
                        $("#message").fadeIn();
                    }
                }
            });
        }
    </script>
@endsection
