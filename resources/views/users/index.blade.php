@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {!! Html::style("/assets/css/users.css") !!}
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
                <a href="{!!URL::to('/users')!!}">Users</a>
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
                        <i class="glyphicon glyphicon-sunglasses font-blue-200"></i>
                        <span class="caption-subject bold font-blue-200">Users</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{URL::route('users.create')}}" class="btn green circle"><i class="fa fa-plus"></i> New user </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">Name </th>
                            <th class="center">Email</th>
                            <th class="center">Name user</th>
                            <th class="center">User type </th>
                            <th class="center">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="center"> {{$user->name}} </td>
                                <td class="center"> {{$user->email}} </td>
                                <td class="center"> {{$user->username}} </td>
                                
                                <td class="center"><span class="btn default green-seagreen-stripe">{{$user->name_role}}</span></td>
                        

                                <td >
                                  <div class="center_items">
                                      <a href="{{URL::route('users.edit', $user->id) }}" title="Edit" class="btn btn-icon-only blue circle">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="#basic" data-toggle="modal" data-name="{{$user->name}}" data-id="{{$user->id}}" title="Delete" class="btn btn-icon-only red circle modalDelete">
                                          <i class="fa fa-trash-o"></i>
                                      </a>
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
    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete user </h4>
                </div>
                <div class="modal-body" id="bodyDelete">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn green-meadow circle" data-dismiss="modal" onclick="deleteUser()">Ok</button>
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
            $("#liTools").addClass("active");
            $("#liUsers").addClass("active");

        });

        $(".modalDelete").click(function(){

            id = $(this).data("id");
            var name = $(this).data("name");
            var nodeName=document.createElement("p");
            var nameNode=document.createTextNode("Are you sure delete user?");
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
