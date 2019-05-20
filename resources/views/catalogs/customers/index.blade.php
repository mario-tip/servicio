@extends("layouts.master")

@section("styles")
{!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
{{--{!! Html::style("/assets/css/main.css") !!}--}}
{!! Html::style("/assets/css/customer.css") !!}
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
                <a>Customers</a>
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
      <p class="titleForm">Customers</p>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="btn-group pull-right">
                @if(userHasPermission("crear_catalogo_clientes"))
                <a href="{{URL::route('customers.create')}}" class="btn btnList"><i class="fa fa-plus"></i> New Customer</a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
          <thead>
            <tr>
              <th class="center">Customer ID </th>
              <th class="center">Name</th>
              <th class="center">Type</th>
              @if(userHasPermission("editar_catalogo_clientes") || userHasPermission("eliminar_catalogo_clientes"))
              <th class="center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
            <tr>
              <td class="center"> {{$customer->id}}</td>
              <td class="center"> {{$customer->name}}</td>
              <td class="center"> {{$customer->getTypeWord()}}</td>
              @if(userHasPermission("editar_catalogo_clientes") || userHasPermission("eliminar_catalogo_clientes"))
              <td>
                <div>
                  @if(userHasPermission("editar_catalogo_clientes"))
                  <a href="{{route('customers.edit', $customer->id) }}" title="Edit" class="btn btnIconList">
                    <i class="fa fa-edit"></i>
                  </a>
                  @endif
                  @if(userHasPermission("eliminar_catalogo_clientes"))
                  <a href="#basic" data-toggle="modal" data-name="{{$customer->name}}" data-id="{{$customer->id}}" title="Delete" class="btn btn-circle btn-icon-only red delete-customer">
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
@if(userHasPermission("eliminar_catalogo_clientes"))
<div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete customer</h4>
      </div>
      <div class="modal-body" id="bodyDelete">

      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-6">
            <div style="text-align: center;">
              <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
              <button type="button" class="btn btnFormSave" data-dismiss="modal" onclick="deleteCustomer()">Ok</button>
            </div>
          </div>
          <div class="col-md-6">
            <div style="text-align: center;">
              <button type="button" class="btn btnFormCancel " data-dismiss="modal"></i>Cancel</button>
            </div>
          </div>
        </div>
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
      <div class="modal-body">The customer CAN NOT be deleted if it is associated with an asset.</div>
      <div class="modal-footer">
        <button type="button" class="btn btnFormSave" data-dismiss="modal">Ok</button>
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
  $(document).ready(function() {
    $("#liTools").addClass("active");
    $("#liCustomer").addClass("active");
  });

  $(".delete-customer").click(function() {
    id = $(this).data("id");
    var name = $(this).data("name");
    var nodeName = document.createElement("p");
    var nameNode = document.createTextNode("Are you sure the delete customer?");
    nodeName.appendChild(nameNode);
    $("#bodyDelete").empty();
    document.getElementById("bodyDelete").appendChild(nodeName);
  });

  function deleteCustomer() {
    var token = $("#token").val();

    $.ajax({
      url: "/catalogs/customers/" + id + "",
      headers: {
        'X-CSRF-TOKEN': token
      },
      type: "DELETE",
      success: function(response) {
        if (response.errors === true) {
          if (response.type_error === 'unable') {
            $('#basic').hide();
            $('#unable_delete_location').modal('toggle');
          } else {
            $('#notification_container').html(response.errors_fragment);
          }
        } else {
          window.location = "/catalogs/customers";
          $("#message").fadeIn();
        }
      }
    });
  }
</script>
@endsection
