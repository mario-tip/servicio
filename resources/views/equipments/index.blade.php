@extends("layouts.master")

@section("styles")
{!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
{!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
{!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
{{--{!! Html::style("/assets/css/main.css") !!}--}}
{!! Html::style("/assets/css/asset.css") !!}
@endsection

@section('breadcrumb')
<div id="notification_container">
  @include('partials.message')
</div>
<div class="page-bar">
        {{-- <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/equipments')!!}">Equipments</a>
            </li>
        </ul> --}}
    </div>
@endsection

@section("page-content")
<div class="row content_container paddingForm">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit bordered">
      <div class="portlet-title topForm">
      </div>
      <p class="titleForm">Equipments brochure</p>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-group pull-right">
                @if(userHasPermission("crear_tipo_equipo"))
                <a href="{{URL::route('equipments.create')}}" class="btn btnList"><i class="fa fa-plus"></i> New Equipment</a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
          <thead>
            <tr>
              <th class="center">Name equipment</th>
              @if(userHasPermission("editar_tipo_equipo") || userHasPermission("editar_tipo_equipo") )
              <th class="center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($equipments as $equipment)
            <tr>
              <td class="center"> {{$equipment->name}} </td>

              @if(userHasPermission("editar_tipo_equipo") || userHasPermission("editar_tipo_equipo") )
              <td>
                <div class="center_items">
                  @if(userHasPermission("editar_tipo_equipo"))
                  <a href="{{ URL::route('equipments.edit', $equipment->id)}}" title="Edit" class="btn btnIconList">
                    <i class="fa fa-edit"></i>
                  </a>
                  @endif
                  @if(userHasPermission("eliminar_tipo_equipo"))
                  <a href="#basic" data-toggle="modal" data-name="{{$equipment->name}}" data-id="{{$equipment->id}}" title="Delete" class="btn btn-circle btn-icon-only red delete-equipment">
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
@if(userHasPermission("eliminar_tipo_equipo"))
{{-- Delete modal --}}
<div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete equipment</h4>
      </div>
      <div class="modal-body" id="bodyDelete">
        {{-- <div id="modal_message"></div> --}}
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-6">
            <div style="text-align: center;">
              <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
              <button type="button" class="btn btnFormSave" data-dismiss="modal" onclick="deleteEquipment()">Ok</button>
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

<div class="modal fade" id="unable_delete_equipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">The equipment CAN NOT be deleted if it is associated with an asset.</div>
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
{!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
{!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.eu.min.js") !!}
{!! Html::script("/assets/global/scripts/datatable.js") !!}
{!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
{!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
{!! Html::script("/assets/scripts/simplified_datatable.js") !!}
{!! Html::script("/assets/scripts/equipment.js") !!}
<script type="application/javascript">
  $(document).ready(function() {
    $("#liTools").addClass("active");
    $("#liEquipments").addClass("active");
  });
</script>
@endsection
