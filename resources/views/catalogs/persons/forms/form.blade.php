<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-12">
          <p class="subtitleForm">Employment information</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_name"><span class="required" aria-required="true">* </span>Name: </label>
            {!! Form::text('person[name]', $person->name, ['class' => 'form-control no-text-area',
            'id' => 'person_name']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_company_name"><span></span>Company: </label>
            {!! Form::text('person[company_name]', $person->company_name, ['class' => 'form-control no-text-area',
            'id' => 'person_company_name']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_father_last_name"><span class="required" aria-required="true">* </span>Last name: </label>
            {!! Form::text('person[father_last_name]', $person->father_last_name, ['class' => 'form-control no-text-area',
            'id' => 'person_father_last_name']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_company_address"><span></span>Address: </label>
            {!! Form::text('person[company_address]', $person->company_address, ['class' => 'form-control no-text-area',
            'id' => 'person_company_address']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_mother_last_name"><span class="required" aria-required="true">* </span> Mother's surname : </label>
            {!! Form::text('person[mother_last_name]', $person->mother_last_name, ['class' => 'form-control no-text-area',
            'id' => 'person_mother_last_name']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_company_phone"><span></span>Telephone: </label>
            {!! Form::text('person[company_phone]', $person->company_phone, ['class' => 'form-control no-text-area',
            'id' => 'person_company_phone', 'onkeypress' => 'validateInput(event, 2)',
            'maxlength' => '10']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_department_id"><span class="required" aria-required="true">* </span>Department: </label>
            {!!Form::select('person[department_id]', $requirements['departments'], $person->department_id,
            ['class' => 'bs-select form-control no-text-area', 'id' => 'person_department_id', 'title' => 'Select...']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_company_position"><span></span>Job: </label>
            {!! Form::text('person[company_position]', $person->company_position, ['class' => 'form-control no-text-area',
            'id' => 'person_company_position']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-12">
          <p class="subtitleForm">Contact information</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_address"><span class="required" aria-required="true">* </span>Address 1: </label>
            {!! Form::text('person[address]', $person->address, ['class' => 'form-control no-text-area',
            'id' => 'person_address']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_phone"><span class="required" aria-required="true">* </span>Telephone 1: </label>
            {!! Form::text('person[phone]', $person->phone, ['class' => 'form-control no-text-area',
            'id' => 'person_phone', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '10']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_alt_address"><span></span>Address 2: </label>
            {!! Form::text('person[alt_address]', $person->alt_address, ['class' => 'form-control no-text-area',
            'id' => 'person_alt_address']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_alt_phone"><span></span>Telephone 2: </label>
            {!! Form::text('person[alt_phone]', $person->alt_phone, ['class' => 'form-control no-text-area',
            'id' => 'person_alt_phone', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '10']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_state_id"><span class="required" aria-required="true">* </span>State: </label>
            {!!Form::select('person[state_id]', $requirements['states'], $person->state_id,
            ['class' => 'bs-select form-control no-text-area', 'id' => 'person_state_id', 'title' => 'Select...']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_email"><span class="required" aria-required="true">* </span>E-mail : </label>
            {!! Form::text('person[email]', $person->email, ['class' => 'form-control no-text-area',
            'id' => 'person_email']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_city"><span class="required" aria-required="true">* </span>City : </label>
            {!! Form::text('person[city]', $person->city, ['class' => 'form-control no-text-area',
            'id' => 'person_city']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_zip_code"><span class="required" aria-required="true">* </span>Zip code: </label>
            {!! Form::text('person[zip_code]', $person->zip_code, ['class' => 'form-control no-text-area',
            'id' => 'person_zip_code', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '5']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label textarea-label" for="person_notes"><span></span>Notes: </label>
            {!! Form::textarea('person[notes]', $person->notes, ['size' => '30x2', 'class' => 'form-control text-area',
            'id' => "person_notes"]) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button class="btn btnFormSave" id="save_person">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{route('persons.index')}}">Cancel</a>
    </div>
  </div>
</div>
