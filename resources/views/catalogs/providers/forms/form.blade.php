<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_name"><span class="required" aria-required="true">* </span>Name: </label>
            {!! Form::text('provider[name]', $provider->name, ['class' => 'form-control',
            'id' => 'provider_name']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_phone"><span></span>Telephone: </label>
            {!! Form::text('provider[phone]', $provider->phone, ['class' => 'form-control',
            'id' => 'provider_phone', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '10']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_city"><span></span>City: </label>
            {!! Form::text('provider[city]', $provider->city, ['class' => 'form-control',
            'id' => 'provider_city']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_email"><span class="required" aria-required="true">* </span>E-mail: </label>
            {!! Form::text('provider[email]', $provider->email, ['class' => 'form-control',
            'id' => 'provider_email']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_address"><span></span>Address: </label>
            {!! Form::text('provider[address]', $provider->address, ['class' => 'form-control',
            'id' => 'provider_address']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_zip_code"><span></span>Zip code: </label>
            {!! Form::text('provider[zip_code]', $provider->zip_code, ['class' => 'form-control',
            'id' => 'provider_zip_code', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '5']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        {{-- <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_state_id"><span class="required" aria-required="true">* </span>State: </label>
            {!!Form::select('provider[state_id]', $states, $provider->state_id,
            ['class' => 'bs-select form-control', 'id' => 'provider_state_id', 'title' => 'Select...']) !!}
          </div>
        </div> --}}
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_website"><span></span>Website: </label>
            {!! Form::text('provider[website]', $provider->website, ['class' => 'form-control',
            'id' => 'provider_website']) !!}
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
          <p class="subtitleForm">Contact</p>
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
            <label class="control-label" for="provider_contact"><span></span>Name: </label>
            {!! Form::text('provider[contact]', $provider->contact, ['class' => 'form-control',
            'id' => 'provider_contact']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_contact_phone"><span></span>Telephone: </label>
            {!! Form::text('provider[contact_phone]', $provider->contact_phone, ['class' => 'form-control',
            'id' => 'provider_contact_phone', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '10']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="provider_contact_email"><span></span>E-mail: </label>
            {!! Form::text('provider[contact_email]', $provider->contact_email, ['class' => 'form-control',
            'id' => 'provider_contact_email']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label textarea-label" for="provider_notes"><span></span>Notes: </label>
            {!! Form::textarea('provider[notes]', $provider->notes, ['size' => '30x2', 'class' => 'form-control',
            'id' => "provider_notes"]) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button class="btn btnFormSave" id="save_provider">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{route('providers.index')}}">Cancel</a>
    </div>
  </div>
</div>
