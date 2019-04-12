@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/equipment.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <div id="errors_container"></div>
        <!-- <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/equipments')!!}">Equipments</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">New equipment</a>
            </li>
        </ul> -->
    </div>
@endsection

@section("page-content")
    <div class="row paddingForm">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
        {!! Form::open(['id' => 'equipment_form', 'data-method' => 'POST', 'files' => true]) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <p class="titleForm">New equipment module</p>
                @include("equipments.forms.form")
            </div>
        {!! Form::close() !!}
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

    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/jquery.number.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/select2.full.min.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/i18n/eu.js") !!}
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/scripts/equipment_form.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liEquipments").addClass("active");
            $("#liAssets").addClass("active");

        });
        /*Deshabilitamos todas las teclas de refresh*/
        /*document.onkeydown = function(ev) {
            var key;
            ev = ev || event;
            key = ev.keyCode;
            if (key == 116 || ev.ctrlKey) {
                return false;  // disable refresh keys and key combinations
            }
        }*/
    </script>
@endsection
