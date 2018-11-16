<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_name"><span>*</span>Name: </label>
                        {!! Form::text('provider[name]', $provider->name, ['class' => 'form-control',
                        'id' => 'provider_name']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_phone"><span></span>Telephone: </label>
                        {!! Form::text('provider[phone]', $provider->phone, ['class' => 'form-control',
                        'id' => 'provider_phone', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '10']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_city"><span></span>City: </label>
                        {!! Form::text('provider[city]', $provider->city, ['class' => 'form-control',
                        'id' => 'provider_city']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_email"><span>*</span>E-mail: </label>
                        {!! Form::text('provider[email]', $provider->email, ['class' => 'form-control',
                        'id' => 'provider_email']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_state_id"><span>*</span>State: </label>
                        {!!Form::select('provider[state_id]', $states, $provider->state_id,
                        ['class' => 'bs-select form-control', 'id' => 'provider_state_id', 'title' => 'Select...']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_website"><span></span>Website: </label>
                        {!! Form::text('provider[website]', $provider->website, ['class' => 'form-control',
                        'id' => 'provider_website']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_address"><span></span>Address: </label>
                        {!! Form::text('provider[address]', $provider->address, ['class' => 'form-control',
                        'id' => 'provider_address']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_zip_code"><span></span>Zip code: </label>
                        {!! Form::text('provider[zip_code]', $provider->zip_code, ['class' => 'form-control',
                        'id' => 'provider_zip_code', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '5']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <span class="caption-subject bold">Contact:</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_contact"><span></span>Name: </label>
                        {!! Form::text('provider[contact]', $provider->contact, ['class' => 'form-control',
                        'id' => 'provider_contact']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_contact_phone"><span></span>Telephone : </label>
                        {!! Form::text('provider[contact_phone]', $provider->contact_phone, ['class' => 'form-control',
                        'id' => 'provider_contact_phone', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '10']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="provider_contact_email"><span></span>E-mail : </label>
                        {!! Form::text('provider[contact_email]', $provider->contact_email, ['class' => 'form-control',
                        'id' => 'provider_contact_email']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label textarea-label" for="provider_notes"><span></span>Notes: </label>
                        {!! Form::textarea('provider[notes]', $provider->notes, ['rows' => '10', 'class' => 'form-control',
                        'id' => "provider_notes"]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions col-sm-offset-5">
    <button class="btn btn-circle green-meadow" id="save_provider">Save</button>
    <a class="btn btn-circle red" href="{{route('providers.index')}}">Cancel</a>
</div>
