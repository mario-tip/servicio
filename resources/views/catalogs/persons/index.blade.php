@extends("layouts.master")

@section("styles")
{!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
{{--{!! Html::style("/assets/css/main.css") !!}--}}
{!! Html::style("/assets/css/person.css") !!}

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
                <a>People</a>
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
      <p class="titleForm">Owners</p>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="btn-group pull-right">
                @if(userHasPermission("crear_catalogo_personas"))
                <a href="{{URL::route('persons.create')}}" class="btn btnList"><i class="fa fa-plus"></i> New owner</a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
          <thead>
            <tr>
              <th class="center">Name</th>
              <th class="center">Last name</th>
              <th class="center">E-mail</th>
              @if(userHasPermission("editar_catalogo_personas") || userHasPermission("eliminar_catalogo_personas"))
              <th class="center">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($persons as $person)
            <tr>
              <td class="center">{{$person->name}}</td>
              <td class="center">{{$person->father_last_name}}</td>
              <td class="center">{{$person->email}}</td>
              @if(userHasPermission("editar_catalogo_personas") || userHasPermission("eliminar_catalogo_personas"))
              <td>
                <div>
                  @if(userHasPermission("editar_catalogo_personas"))
                  <a href="{{route('persons.edit', $person->id) }}" title="Edit" class="btn btnIconList">
                    <i class="fa fa-edit"></i>
                  </a>
                  @endif
                  @if(userHasPermission("eliminar_catalogo_personas"))
                  <a href="#basic" data-toggle="modal" data-name="{{$person->name}}" data-id="{{$person->id}}" title="Delete" class="btn btn-circle btn-icon-only red delete-person">
                    <i class="fa fa-trash"></i>
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
@if(userHasPermission("eliminar_catalogo_personas"))
<div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete owner</h4>
      </div>
      <div class="modal-body" id="bodyDelete"></div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-6">
            <div style="text-align: center;">
              <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
              <button type="button" class="btn btnFormSave" data-dismiss="modal" onclick="deletePerson()">Ok</button>
            </div>
          </div>
          <div class="col-md-6">
            <div style="text-align: center;">
              <button type="button" class="btn btnFormCancel" data-dismiss="modal"></i>Cancel</button>
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

<div class="modal fade" id="unable_delete_person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">The owner can not be eliminated, if it is associated with an asset.</div>
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
    $("#liPeople").addClass("active");

  });

  $(".delete-person").click(function() {
    id = $(this).data("id");
    var name = $(this).data("name");
    var nodeName = document.createElement("p");
    var nameNode = document.createTextNode("Are you sure delete the owner ?");
    nodeName.appendChild(nameNode);
    $("#bodyDelete").empty();
    document.getElementById("bodyDelete").appendChild(nodeName);
  });

  function deletePerson() {
    var token = $("#token").val();

    $.ajax({
      url: "/catalogs/persons/" + id + "",
      headers: {
        'X-CSRF-TOKEN': token
      },
      type: "DELETE",
      success: function(response) {
        if (response.errors === true) {
          if (response.type_error === 'unable') {
            $('#basic').hide();
            $('#unable_delete_person').modal('toggle');
          } else {
            $('#notification_container').html(response.errors_fragment);
          }
        } else {
          window.location = "/catalogs/persons";
          $("#message").fadeIn();
        }
      }
    });
  }
</script>
@endsection
