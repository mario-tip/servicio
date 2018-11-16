@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
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
          
            <li>
                <a>User tickets and status</a>
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
                      <i class="icon-tag font-green-500"></i>
                        <span class="caption-subject bold font-green-500">User tickets and status</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        {!! Form::open(['route' => 'reports.generate-technician-tickets', 'method' => 'POST', 'id' => 'tickets_filters_form']) !!}
                        <div class="row">
                            <div class="col-md-4" id="dates_container">
                                <div class="form-group col-md-8" id="dates_sub_container">
                                    <label class="control-label">Date :</label>
                                    <div class="input-group input-medium date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                        <span class="input-group-addon" style="position: relative; z-index: 9999999999999999999999">From </span>
                                        <!--'position' => 'relative', 'z-index' => '99999999999999'-->
                                        {!! Form::text('tickets[start_date]', null, ['class' => 'form-control date-input', 'id' => 'from_date']) !!}
                                        <span class="input-group-addon">To </span>
                                        {!! Form::text('tickets[end_date]', null, ['class' => 'form-control date-input', 'id' => 'to_date']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label form-label" for="service_order_user_id"><span></span>Tickets status: </label>
                                    {!!Form::select('tickets[status]', ['2' => 'All', '0' => 'Pending', '1' => 'Serve'], null,
                                    ['class' => 'bs-select form-control', 'id' => 'service_order_user_id', 'title' => 'Select...']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label form-label" for="service_order_user_id"><span></span>Operator: </label>
                                    {!!Form::select('tickets[user_id]', $technicians, null,
                                    ['class' => 'bs-select form-control', 'id' => 'service_order_user_id', 'title' => 'Select...']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label form-label" for="service_order_user_id"><span></span>Project: </label>
                                    {!!Form::select('tickets[project_id]', $projects, null,
                                    ['class' => 'bs-select form-control', 'id' => 'service_order_user_id', 'title' => 'Select...']) !!}
                                </div>
                            </div>
                        </div>
                        @if(userHasPermission("generar_reporte_tickets"))
                        <div class="row">
                            <div class="pull-right" id="toolbar_buttons_container">
                                <div class="btn-group col-md-2" id="toolbar_buttons_sub_container">

                                    <button type="submit" class="btn btn-circle blue" id="generate_report">Generate</button>

                                    {!! Form::close() !!}
                                    {!!Form::open(['route'=>'reports.export-technician-tickets'])!!}
                                        <input type="hidden" id="data" name="data">
                                        <button type="submit" class="btn btn-circle green-meadow disabled-button" id="download_report" disabled>Download</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Folio</th>
                                <th class="center">Customer</th>
                                <th class="center">Person</th>
                                <th class="center">Asset attended</th>
                                <th class="center">Date of attention</th>
                                <th class="center">Technical</th>
                                <th class="center">Location</th>
                                <th class="center">Status</th>
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
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.eu.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script('/assets/scripts/tickets_report.js') !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAnalitycs").addClass("active");
            $("#liReportTiket").addClass("active");

        });

        $('.date-picker').datepicker({
            language: "es",
            autoclose: true,
            orientation: 'bottom auto',
        });
    </script>
@endsection
