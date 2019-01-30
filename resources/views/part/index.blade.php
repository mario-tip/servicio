@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/parts.css") !!}
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
                <a href="{!!URL::to('/parts')!!}">Parts brochure</a>
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
                        <i class="icon-frame font-cian-500"></i>
                        <span class="caption-subject bold font-cian-500">Parts brochure</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_catalogo_correlativos"))
                                    <a href="{{URL::route('parts.create')}}" class="btn btn-circle green"><i class="fa fa-plus"></i> New part</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Part name</th>
                            <th class="center">Part number </th>
                            <th class="center">Price</th>
                            <th class="center">Description</th>
                            @if(userHasPermission("editar_catalogo_correlativos") || userHasPermission("eliminar_catalogo_correlativos"))
                            <th class="center">Actions</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($parts as $part)
                            <tr>
                                <td class="center"> {{$part->name}} </td>
                                <td class="center"> {{$part->number}} </td>
                                <td class="center"> {{$part->price}} </td>
                                <td class="center"> {{$part->description}} </td>
                                @if(userHasPermission("editar_catalogo_correlativos") || userHasPermission("eliminar_catalogo_correlativos"))
                                <td>
                                  <div class="">
                                    @if(userHasPermission("editar_catalogo_correlativos"))
                                    <a href="{{  URL::route('parts.edit', $part->id) }}" title="Edit"
                                       class="btn btn-circle btn-icon-only btn-info ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission("eliminar_catalogo_correlativos"))
                                    <a href="#basic" data-toggle="modal" data-name="{{$part->name}}"
                                       data-id="{{$part->id}}" title="Delete"
                                       class="btn btn-circle btn-icon-only red modalDelete">
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

    @if(userHasPermission("eliminar_catalogo_correlativos"))
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete part</h4>
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

    <div class="modal fade" id="basic2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">The correlative can NOT be deleted if it is associated with an asset or equipment.</div>
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
          $("#liAssets").addClass("active");
          $("#liParts").addClass("active");

        });

        $(".modalDelete").click(function(){
            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Do you want to delete the selected correlative?");
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
