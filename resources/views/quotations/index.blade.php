@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/quotation.css") !!}
@endsection

@section('breadcrumb')
    <div id="errors_container">
        @include('partials.message')
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/help_service')!!}">Service</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/quotations')!!}">Service Quotation
                </a>
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
                      <i class="icon-call-in font-red-700"></i>
                        <span class="caption-subject bold font-red-700">Service quotations</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    @if(userHasPermission("crear_cotizacion_servicios"))
                                    <a href="{{URL::route('quotations.create')}}" class="btn btn-circle green"><i class="fa fa-plus"></i> Add quotation</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Asset</th>
                                <th class="center">Name quotation</th>
                                <th class="center">Price</th>
                                <th class="center">Description</th>
                                <th class="center">Status</th>
                                <th class="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotations as $quotation)
                            <tr>
                                <td class="center">{{$quotation->incident->asset->name}}</td>
                                <td class="center">{{$quotation->name}}</td>
                                <td class="center currency-format">{{$quotation->getTotalPrice()}}</td>
                                <td class="center" id="quotation_description_td">{{$quotation->description}}</td>
                                <td class="center">
                                  <span class="label label-sm {{
                                     (($quotation->getAuthorizationWord()=='Pending') ? 'label-info' : ($quotation->getAuthorizationWord()=='Authorized') ? 'label-success' : 'label-info')}}">
                                    {{$quotation->getAuthorizationWord()}}
                                  </span>
                                  </td>
                                <td>
                                  <div>
                                    @if(userHasPermission("editar_cotizacion_servicios"))
                                    <a href="{{URL::route('quotations.edit', $quotation->id)}}" title="Edit" class="btn btn-circle btn-icon-only btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif

                                    @if(userHasPermission("mostrar_cotizacion_servicios"))
                                    <a href="{{URL::route('quotations.show', $quotation->id)}}" title="Show" class="btn btn-circle btn-icon-only grey-silver">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif

                                    @if(userHasPermission("cancelar_cotizacion_servicios"))
                                    <a href="#cancel_modal" data-toggle="modal" data-name="{{$quotation->name}}" data-id="{{$quotation->id}}" title="Cancel" class="btn btn-circle btn-icon-only red cancel_quotation">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    @endif

                                    @if(userHasPermission("cambiar_estatus_cotizacion_servicios"))
                                    <a href="#authorization_modal" data-toggle="modal" title="Change status" data-id="{{$quotation->id}}" data-authorization="{{$quotation->authorization}}" class="btn btn-circle btn-icon-only green-meadow change-quotation-status">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @endif
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
    @if(userHasPermission("cancelar_cotizacion_servicios"))
    <!--Modal cancelación-->
    <div class="modal fade" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Quotation cancel</h4>
                </div>
                <div class="modal-body" id="bodyDelete">
                    <div id="modal_message"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn btn-circle green-meadow" data-dismiss="modal" onclick="cancelQuotation()">Ok</button>
                    <button type="button" class="btn btn-circle red " data-dismiss="modal"></i>Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--End Modal cancelación-->
    @endif

    @if(userHasPermission("cambiar_estatus_cotizacion_servicios"))
    <!--Modal autorización-->
    <div class="modal fade bs-modal-lg" id="authorization_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Authorize quotation</h4>
                </div>
                <div id="modal_errors_container"></div>
                {!! Form::open(['id' => 'authorization_form']) !!}
                <div class="modal-body" id="bodyUpdateFirmware">
                    @include("quotations.forms.authorization_form")
                </div>
                <div class="form-actions col-sm-offset-5">
                    <button type="submit" class="btn btn-circle green-meadow">Save</button>
                    <a class="btn btn-circle red" href="#" data-dismiss="modal">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--End Modal autorización-->
    @endif
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    {!! Html::script("/assets/scripts/jquery.number.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/scripts/quotation.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liHelpDesk").addClass("active");
            $("#liServiceOrders").addClass("active");
        });
    </script>
@endsection
