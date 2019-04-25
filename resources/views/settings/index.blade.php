@extends("layouts.master")

@section("styles")
{!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
{!! Html::style("/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") !!}
@endsection

@section('breadcrumb')
@include('partials.message')
{{-- <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
              <a href="{!!URL::to('/incidents')!!}">Event log </a>
            </li>
        </ul>
    </div> --}}
@endsection

@section("page-content")
<div class="row content_container paddingForm">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit bordered">
      <div class="portlet-title topForm">
      </div>
      <p class="titleForm">Settings</p>
      <div class="portlet-body">
        <div class="form-body bodyForm">
          <div class="row">
            <form class="" action="" method="post">
              <div class="col-md-6">
                <div class="form-group profile">
                  <label class="subtitleFormProfile">Email</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Incoming Server:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Outgoing Server:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Password:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btnFormSaveProfile">OK</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <form class="" action="" method="post">
              <div class="col-md-6">
                <div class="form-group profile">
                  <label class="subtitleFormProfile">Alerts</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="suggested_date" class="control-label">Day:</label>
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                          {!! Form::text('suggested_date', null, ['class' => 'form-control', 'style' => 'pointer-events: none;','id' => 'suggested_date', 'readonly']) !!}
                          <span class="input-group-btn">
                            <button class="btn default btnIconForm" type="button">
                              <i class="fa fa-calendar"></i>
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="suggested_time" class="control-label">Hour:</label>
                        <div class="input-group">
                          {!! Form::text('suggested_time', null, ['class' => 'form-control timepicker timepicker-24','style' => 'pointer-events: none;', 'id' => 'suggested_time', 'readonly']) !!}
                          <span class="input-group-btn">
                            <button class="btn default btnIconForm" type="button">
                              <i class="fa fa-clock-o"></i>
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Description:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btnFormSaveProfile" id="">Schedule</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
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
{!! Html::script("/assets/pages/scripts/components-date-time-pickers.min.js") !!}

<script type="text/javascript">
  $('.date-picker').datepicker({
    language: "en",
    autoclose: true
  });

  $('.timepicker').timepicker({
    minuteStep: 1,
    defaultTime: false,
    showMeridian: false
  });
</script>


@endsection
