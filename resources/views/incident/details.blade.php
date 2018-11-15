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
                <a href="{!!URL::to('/aid')!!}">Attention of incidents</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Incident detail</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject bold">Incident detail</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>who registered? :</b></label>
                                        <label class="control-label">{{$incident->full_name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Service type :</b></label>
                                        @if($incident->type == 0)
                                            <label class="control-label">Clean</label>
                                        @else
                                            <label class="control-label">Repair</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Asset ID:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->id:''}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Asset name:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->name:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Location:</b></label>
                                        <label class="control-label">{{$incident->location}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Brand:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->brand:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Preference:</b></label>
                                        @if($incident->priority == 0)
                                            <label class="control-label">High</label>
                                        @elseif($incident->priority == 1)
                                            <label class="control-label">Medium</label>
                                        @else
                                            <label class="control-label">Low</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Serie:</b></label>
                                        <label class="control-label">{{($incident->asset)?$incident->asset->serial:''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Hour :</b></label>
                                        <label class="control-label">{{$incident->time}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Status:</b></label>
                                        <label class="control-label">{{$incident->status}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Date:</b></label>
                                        <label class="control-label">{{$incident->date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label"><b>description of the problem :</b></label>
                                        <label class="control-label textarea-content">{{$incident->description}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Suggested attention date :</b></label>

                                        <label class="control-label">{{$incident->suggested_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Evidence:</b></label>
                                        <a href="#" title="Evidencia" class="thumbnail">
                                            <img src="{{'/'.$incident->evidence_file}}" style="max-width: 300px" alt="Evidence">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Notes:</b></label>
                                        @if ($incident->notes)
                                          <label class="control-label">{{$incident->notes}}</label>
                                        @else
                                          <label class="control-label">There aren't notes</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Detail of attention</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label"><b>Technical:</b></label>
                                        <label class="control-label">{{$incident->technician}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label"><b>commentation :</b></label>
                                        <label class="control-label textarea-content">{{$incident->person_notes}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Affected parties:</b></label>
                                        <ul class="list-group">
                                        @foreach($data as $d)
                                                <li class="list-group-item">{{$d->part_number.' - '.$d->part_name}}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>who registered maintenance? :</b></label>
                                        <label class="control-label">{{$incident->person}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Signature:</b></label>
                                        <div>
                                            <a href="#" title="Firma" class="thumbnail">
                                                <img src="{{$incident->signature}}" style="max-width: 500px" alt="Signature">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            $("#liAnalitycs").addClass("active");
            $("#liAnalyticsIncidents").addClass("active");


            $(".activos").css('border', 'none');
            $(".activos").css('background-color', '#fefeff');
            $(".activos").prop('readonly', true);
        });
    </script>
@endsection
