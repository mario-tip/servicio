<div class="form-body bodyForm">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name"><span class="required" aria-required="true">* </span>Search asset:</label>
        <select name="asset_id" id="asset_id" class="form-control asset"></select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="name"><span class="required" aria-required="true">* </span>Service type:</label>
        {!! Form::select('type', array('0'=>'Cleaning','1'=>'Repair'), null, ['class' => 'bs-select form-control', 'id' => 'type', 'title' => 'Select...']) !!}
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
        <label for="name" class="control-label">Name Asset:</label>
        {!!Form::text('asset_name',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_name'])!!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="name" class="control-label">Brand:</label>
        {!!Form::text('brand',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'brand'])!!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label">Serie:</label>
        {!!Form::text('serial',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'serial'])!!}
      </div>
    </div>
    <div class="col-md-9">
      <div class="form-group">
        <label for="name" class="control-label">Location:</label>
        {!!Form::text('location',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'location'])!!}
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputEmail1" class="control-label"><span class="required" aria-required="true">* </span>Problem description:</label>
        {!!Form::textarea('description',null,['size' => '30x2','class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'description'])!!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span>Requested by:</label>
        <select class="bs-select form-control person" name="person_id" id="person_id">
          <option value="0" disabled selected>Select...</option>
          @foreach($persons as $person)
          <option value="{{$person->id}}" {{isset($incident) ? ($incident->person_id == $person->id)?'selected':'' : ''}}>{{$person->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="inputEmail1" class="control-label"><span class="required" aria-required="true">* </span> Suggested date:</label>
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
    <div class="col-md-3">
      <div class="form-group">
        <label class="control-label"><span class="required" aria-required="true">* </span> Suggested hour:</label>
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
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span> Preference :</label>
        {!! Form::select('priority', array('0'=>'Low', '1'=>'Medium', '2'=>'Hig'), null, ['class' => 'bs-select form-control', 'id' => 'priority', 'title' => 'Select...']) !!}
      </div>
    </div>
  </div>

  {{-- <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Add evidence :</label>
        <div class="col-sm-7">
            <input type="file" name="evidence_file" id="evidence_file" class="form-control product mb-10" data-buttonText="Select archive" data-iconName="fa fa-inbox"/>
        </div>
    </div> --}}

  <div class="row">
    <div class="col-md-6">
      <label for="inputEmail1" class="control-label"><span class="required" aria-required="true">* </span> Add evidence:</label>

      <div class="form-group">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div style="margin: 5px 0px 15px 0px;">
            <span class="btn green-jungle btn-file btnForm">
              <span class="fileinput-new">
                Select image </span>
              <span class="fileinput-exists">
                Change </span>
              <input type="file" name="evidence_file" id="evidence_file" class="form-control product mb-10" data-buttonText="Select archive" data-iconName="fa fa-inbox" />
            </span>
            <a href="#" class="btn red fileinput-exists btnForm" data-dismiss="fileinput">
              Remove </a>
          </div>
          <div class="fileinput-new thumbnail">

            @if(isset($incident))
            <img src="http://service.altatec.com.mx/{{$incident->evidence_file}}" alt="" />
            @else
            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
            @endif

          </div>
          <div class="fileinput-preview fileinput-exists thumbnail">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputEmail1" class="control-label">Notes:</label>
        {!!Form::textarea('notes',null,['size' => '30x2','class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'notes'])!!}
      </div>
    </div>
  </div>
</div>

<!-- BEGIN ASSET'S PARTS PORTLET-->
<div class="portlet light portlet-fit bordered" style="margin: 0.5em 7em 2em;">
  <div class="portlet-title topForm">
  </div>
  <div class="portlet-body horizontal-form">
    <p class="titleForm">Affected parties (Optional)</p>
    <div class="horizontal-form">
      <div class="form-body">
        <div class="row" id="equipment_parts_container"></div>
      </div>
    </div>
  </div>
</div>
<!-- END ASSET'S PARTS PORTLET-->
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btnFormSave" id="send">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{URL::route('incidents.index')}}">Cancel</a>
    </div>
  </div>
</div>
