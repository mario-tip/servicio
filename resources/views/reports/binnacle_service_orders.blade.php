@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/report.css") !!}
@endsection

@section('breadcrumb')
    <div id="errors_container">
        @include('partials.message')
    </div>
    <div class="page-bar">
        <div id="errors_container"></div>
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
{{--            <li>
                <a href="{!!URL::to('/reports')!!}">Reportes</a>
                <i class="fa fa-circle"></i>
            </li>--}}
            <li>
                <a href="#">Bitácora de servicios</a>
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
                        <span class="caption-subject bold">Bitácora de servicios</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        {!! Form::open(['route' => 'reports.generate-binnacle-service-orders', 'method' => 'POST', 'id' => 'binnacle_service_orders_filters_form']) !!}
                        <div class="row">
                            <div class="col-md-4" id="dates_container">
                                <div class="form-group col-md-8" id="dates_sub_container">
                                    <label class="control-label">Fechas:</label>
                                    <div class="input-group input-medium date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                        <span class="input-group-addon">Desde</span>
                                        {!! Form::text('service_orders[start_date]', null, ['class' => 'form-control date-input', 'id' => 'from_date']) !!}
                                        <span class="input-group-addon">Hasta</span>
                                        {!! Form::text('service_orders[end_date]', null, ['class' => 'form-control date-input', 'id' => 'to_date']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pull-right" id="toolbar_buttons_container">
                                <div class="btn-group col-md-2" id="toolbar_buttons_sub_container">
                                    <button type="submit" class="btn btn-circle blue" id="generate_report">Generar</button>
                                    {!! Form::close() !!}
                                    {!!Form::open(['route'=>'reports.export-binnacle-service-orders'])!!}
                                    <input type="hidden" id="data" name="data">
                                    <button type="submit" class="btn btn-circle green-meadow disabled-button" id="download_report" disabled>Descargar</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Folio</th>
                                <th class="center">Cliente</th>
                                <th class="center">Persona</th>
                                <th class="center">Activo atendido</th>
                                <th class="center">Fecha</th>
                                <th class="center">Usuario</th>
                                <th class="center">Ubicación</th>
                                <th class="center">Operación</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script('assets/global/plugins/moment.min.js') !!}
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js") !!}
    {!! Html::script('/assets/scripts/binnacle_service_orders_report.js') !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liServiceOrdersBinnacle").addClass("active");
            $("#liAnalitycs").addClass("active");
        });

        $('.date-picker').datepicker({
            language: "es",
            autoclose: true,
            orientation: 'bottom auto',
        });
    </script>
@endsection
