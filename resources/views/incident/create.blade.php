@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}

    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/asset.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/incidents')!!}">Event log</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/incidents/create')!!}">Add incident</a>
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
                        <i class="fa fa-plus font-red-800"></i>
                        <span class="caption-subject bold font-red-800">Add incident</span>
                    </div>
                </div>
                <div class="portlet-body">
                    {!! Form::open(['route' => 'incidents.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                        <input type="hidden" id="folio" name="folio" value="EEO-">

                        @include("incident.form")
                    {!!Form::close()!!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.eu.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}

    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-date-time-pickers.min.js") !!}

    {!! Html::script("/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") !!}
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}

    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/select2.full.min.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/i18n/en.js") !!}

    {!! Html::script("/assets/scripts/incident.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liHelpDesk").addClass("active");
            $("#liIncidents").addClass("active");


            $(".asset" ).select2({ //Funcion para buscar el id de la persona que lo invito
                placeholder: 'Insert name',
                ajax: {
                    url: "/findAsset",
                    dataType: 'json',
                    delay: 250,
                    headers : {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    processResults: function (data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                language: "es",
                minimumInputLength: 3,
            });

            $(".activos").css('border', 'none');
            $(".activos").css('background-color', '#fefeff');
            $(".activos").prop('readonly', true);
        });

        $('.date-picker').datepicker({
            language: "en",
            autoclose: true
        });

        $('.timepicker').timepicker({
            minuteStep: 1,
            defaultTime: false,
            showMeridian:false
        });
    </script>
@endsection
