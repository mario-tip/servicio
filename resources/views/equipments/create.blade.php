@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/equipment.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <div id="errors_container"></div>
        <ul class="page-breadcrumb">
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
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
        {!! Form::open(['id' => 'equipment_form', 'data-method' => 'POST']) !!}
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-blue-300"> </i>
                        <span class="caption-subject bold font-blue-300"> New equipment </span>
                    </div>
                </div>
                @include("equipments.forms.form")
            </div>
        {!! Form::close() !!}
        <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section("scripts")
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
            $("#liTools").addClass("active");

        });
        /*Deshabilitamos todas las teclas de refresh*/
/*        document.onkeydown = function(ev) {
            var key;
            ev = ev || event;
            key = ev.keyCode;
            if (key == 116 || ev.ctrlKey) {
                return false;  // disable refresh keys and key combinations
            }
        }*/
    </script>
@endsection
