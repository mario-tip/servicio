@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
    {!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/quotation.css") !!}
@endsection

{{-- @section('breadcrumb')
    <div class="page-bar">
        <div id="errors_container"></div>
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/quotations')!!}">Quotations</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Add quotation service</a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")
    <div class="row paddingForm">
        <div class="col-md-12" id="quotation_form_subcontainer">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            {!! Form::open(['id' => 'quotation_form', 'data-method' => 'POST']) !!}
            <input type="hidden" id="quotation" data-id="{{$quotation->id}}"/>
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <p class="titleForm">Add quotation service</p>

                @include("quotations.forms.form")
            </div>
        {!! Form::close() !!}
        <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/jquery.number.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/select2.full.min.js") !!}
    {!! Html::script("/assets/global/plugins/select2/js/i18n/es.js") !!}
    {!! Html::script("/assets/scripts/quotation.js") !!}
    <script type="application/javascript">
        var token = null;
        $(document).ready(function(){
            $("#liHelpDesk").addClass("active");
            $("#liServiceOrders").addClass("active");


            $('#span_quotation_file_required').html('*');
            token = $("input[name='_token']").val();

            $("#incident_select" ).select2({
                ajax: {
                    url: '/get-select2-incidents',
                    dataType: 'JSON',
                    headers: {'X-CSRF-TOKEN': token},
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results,
                        };
                    },
                    cache: true
                },
                language: "es",
                placeholder: "Insert folio incident",
                minimumInputLength: 3,
            });
            $('.currency-format').number(true, 2);

        });
        /*Deshabilitamos todas las teclas de refresh*/
        /*        document.onkeydown = function(ev) {
                    var key;
                    ev = ev || event;
                    key = ev.keyCode;
                    if (key == 116 || ev.ctrlKey) {
                        return false;
                    }
                }*/
    </script>
@endsection
