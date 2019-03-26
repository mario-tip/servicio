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

{{-- @section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/maintenances')!!}">Administration of scheduled maintenance</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Edit maintenance</a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <div>@php
                    // dd($maintenance);
                @endphp</div>
                <div class="portlet-body">
                  <p class="titleForm">Edit maintenance</p>

                    {!! Form::model($maintenance,['route' => ['maintenances.update', $maintenance->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        @include("maintenances.form")
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js") !!}
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
    {!! Html::script("/assets/global/plugins/select2/js/i18n/es.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liMaintenances").addClass("active");

            $.ajax({
                type: 'get',
                url: '/assetData/{{$maintenance->id}}',
                success: (function(response) {
                    $(response).each(function (key, value) {
                        console.log(value.id);
                        $('#asset').append("" +
                            "<option value='"+value.id+"' selected>"+value.text+"</option>"
                        ).change();

                        $('#asset_id').val(value.id);

                        $.ajax({
                            type: 'GET',
                            url: '/getDataAsset/'+value.id,
                            dataType: 'json',
                            async: false,
                            success: function(asset) {
                                console.log(asset);
                                $('#asset_custom_id').val(asset[0].asset_custom_id);
                                $('#asset_name').val(asset[0].name);
                                $('#serial').val(asset[0].serial);
                            }
                        });

                        if('{{$maintenance->user_id}}'!=''){
                            $.ajax({
                                type: 'GET',
                                url: '/getDataTechnician/{{$maintenance->user_id}}',
                                dataType: 'json',
                                async: false,
                                success: function(user) {
                                    console.log(user);
                                    $('#technician').append("" +
                                        "<option value='"+user[0].id+"' selected>"+user[0].name+"</option>"
                                    ).change();
                                    console.log('Técnico: ' + $('#user_id').val());
                                    $('#user_id').val(user[0].id);
                                    console.log('Técnico: ' + $('#user_id').val());
                                }
                            });
                        }
                    });
                })
            });

            $(".asset" ).select2({ //Funcion para buscar el id de la persona que lo invito
                placeholder: 'Introduce el nombre',
                ajax: {
                    url: "/findAsset",
                    dataType: 'json',
                    delay: 250,
                    headers : {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    processResults: function (data) {
                        var id = data[0].id;

                        $('#asset_id').val(id);

                        $.ajax({
                            type: 'GET',
                            url: '/getDataAsset/'+id,
                            dataType: 'json',
                            async: false,
                            success: function(asset) {
                                console.log(asset);
                                $('#asset_custom_id').val(asset[0].asset_custom_id);
                                $('#asset_name').val(asset[0].name);
                                $('#serial').val(asset[0].serial);
                            }
                        });

                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                language: 'es',
                minimumInputLength: 3,
            });

            $(".technician" ).select2({
                placeholder: 'Introduce el nombre',
                ajax: {
                    url: "/findTechnician",
                    dataType: 'json',
                    delay: 250,
                    headers : {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    processResults: function (data) {
                        var id = data[0].id;

                        $('#user_id').val(id);

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
            $(".activos").css('cursor', 'not-allowed');
            $(".activos").css('background-color', '#f2f6f9');
            $(".activos").prop('readonly', true);
        });

        $('.date-picker').datepicker({
            language: "es",
            autoclose: true
        });

        $('.timepicker').timepicker({
            minuteStep: 1,
            defaultTime: false,
            showMeridian:false
        });
    </script>
@endsection
