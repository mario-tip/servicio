@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/asset.css") !!}
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
                <a href="{!!URL::to('/actives')!!}">Activos</a>
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
                        <span class="caption-subject bold">Captura de información de activos</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission('crear_captura_info'))
                                    <a href="{{URL::route('actives.create')}}" class="btn green btn-circle"><i class="fa fa-plus"></i> Nuevo Activo</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Id de activo</th>
                                <th class="center">Nombre de activo</th>
                                <th class="center">Modelo</th>
                                <th class="center">No. de serie</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $asset)
                            <tr>
                                <td class="center"> {{$asset->asset_custom_id}} </td>
                                <td class="center"> {{$asset->name}} </td>
                                <td class="center"> {{$asset->model}} </td>
                                <td class="center"> {{$asset->serial}} </td>
                                <td>
                                    @if(userHasPermission('editar_captura_info'))
                                    <a href="{{ URL::route('actives.edit', $asset->id) }}" title="Editar" class="btn btn-circle btn-icon-only green-jungle">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission('mostrar_captura_info'))
                                    <a href="{{ URL::route('actives.show', $asset->id) }}" title="Mostrar" class="btn btn-circle btn-icon-only green">
                                        <i class="icon-eye"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission('actualizar_firmware'))
                                    <a href="#large" data-toggle="modal"  title="Actualizar firmware" class="btn btn-circle btn-icon-only purple update-firmware"
                                       data-current_firmware="{{count($asset->firmwares) > 0 ? $asset->firmwares->last()->firmware : ''}}"
                                       data-asset_id="{{$asset->id}}">
                                        <i class="fa fa-undo"></i>
                                    </a>
                                    @endif
                                    @if(userHasPermission('historial_firmware'))
                                    <a id="firmware_history" href="{{url('/firmwares/' . $asset->id)}}" title="Historial de firmware" class="btn btn-circle btn-icon-only purple-medium">
                                        <i class="fa fa-history"></i>
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
    @if(userHasPermission('actualizar_firmware'))
    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Historial de Firmware</h4>
                </div>
                <div id="modal_errors_container"></div>
                {!! Form::open(['route' => 'firmwares.store', 'method' => 'POST', 'id' => 'firmware_form']) !!}
                {!! Form::hidden('firmware[assets_id]', null, ['id' => 'modal_asset_id']) !!}
                <div class="modal-body" id="bodyUpdateFirmware">
                    @include("assets.forms.update_firmware_form")
                </div>
                <div class="form-actions col-sm-offset-5">
                    <button type="submit" class="btn green-meadow" id="save_asset">Guardar</button>
                    <a class="btn red" href="#" data-dismiss="modal">Cancelar</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif
@endsection

@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    {!! Html::script("/assets/scripts/asset.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAssets").addClass("active");
        });
        $(".update-firmware").click(function(){
            var asset_id = $(this).data('asset_id');
            var current_firmware = $(this).data('current_firmware');
            $('#modal_asset_id').val(asset_id);
            $('#modal_current_firmware_label').text(current_firmware);
            $('#modal_current_firmware_input').val(current_firmware);
        });
    </script>
@endsection
