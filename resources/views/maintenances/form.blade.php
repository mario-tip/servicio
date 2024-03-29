<div class="form-body bodyForm">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true"> * </span> Search asset:</label>
        <select name="asset" id="asset" class="form-control asset"></select>
        <input type="hidden" name="asset_id" id="asset_id">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label">Asset ID:</label>
        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="name" class="control-label">Asset name:</label>
        {!!Form::text('asset_name',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_name'])!!}
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label">Serie:</label>
        {!!Form::text('serial',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'serial'])!!}

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="maintenance_date" class="control-label"><span class="required" aria-required="true"> * </span> Day:</label>

        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
          {!! Form::text('maintenance_date', null, ['class' => 'form-control', 'style' => 'pointer-events: none;','id' => 'maintenance_date', 'readonly']) !!}
          <span class="input-group-btn">
            <button class="btn default" type="button">
              <i class="fa fa-calendar"></i>
            </button>
          </span>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="maintenance_time" class="control-label"><span class="required" aria-required="true"> * </span> Hour:</label>
        <div class="input-group">
          {!! Form::text('maintenance_time', null, ['class' => 'form-control timepicker timepicker-24','style' => 'pointer-events: none;', 'id' => 'maintenance_time', 'readonly']) !!}
          <span class="input-group-btn">
            <button class="btn default" type="button">
              <i class="fa fa-clock-o"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="technician" class="control-label"><span class="required" aria-required="true"> * </span> Technician:</label>
        <select name="technician" id="technician" class="form-control technician"></select>
        <input type="hidden" name="user_id" id="user_id">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name" class="control-label">Provider:</label>
        {!!Form::select('provider_id',  $provider->pluck('name'), null, ['class' => 'form-control bs-select', 'id' => 'asset_provider_id', 'title' => 'Select...']) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="name" class="control-label">Status:</label>
        {!!Form::text('status',null,['class'=>'form-control activos', 'autocomplete'=>"off", 'id' => 'status','readonly','style' => 'pointer-events: none;'])!!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="notes" class="control-label"><span class="required" aria-required="true"> * </span> Notes:</label>
        {!!Form::textarea('notes',null,['size' => '30x2','class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'notes'])!!}
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 2em;">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btnFormSave" id="send">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{URL::route('maintenances.index')}}">Cancel</a>
    </div>
  </div>
</div>
