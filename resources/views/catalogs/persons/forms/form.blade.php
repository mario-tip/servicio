<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container"></div>
                <div class="col-md-6 form-group-container">
                    <span class="caption-subject bold">Información de empleo:</span>
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
                        <label class="control-label" for="person_name"><span>*</span>Nombre: </label>
                        {!! Form::text('person[name]', $person->name, ['class' => 'form-control no-text-area',
                        'id' => 'person_name']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_company_name"><span></span>Empresa: </label>
                        {!! Form::text('person[company_name]', $person->company_name, ['class' => 'form-control no-text-area',
                        'id' => 'person_company_name']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_father_last_name"><span>*</span>Apellido paterno: </label>
                        {!! Form::text('person[father_last_name]', $person->father_last_name, ['class' => 'form-control no-text-area',
                        'id' => 'person_father_last_name']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_company_address"><span></span>Dirección: </label>
                        {!! Form::text('person[company_address]', $person->company_address, ['class' => 'form-control no-text-area',
                        'id' => 'person_company_address']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_mother_last_name"><span>*</span>Apellido materno: </label>
                        {!! Form::text('person[mother_last_name]', $person->mother_last_name, ['class' => 'form-control no-text-area',
                        'id' => 'person_mother_last_name']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_company_phone"><span></span>Teléfono: </label>
                        {!! Form::text('person[company_phone]', $person->company_phone, ['class' => 'form-control no-text-area',
                        'id' => 'person_company_phone', 'onkeypress' => 'validateInput(event, 2)',
                        'maxlength' => '10']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_department_id"><span>*</span>Departamento: </label>
                        {!!Form::select('person[department_id]', $requirements['departments'], $person->department_id,
                         ['class' => 'bs-select form-control no-text-area', 'id' => 'person_department_id', 'title' => 'Seleccionar...']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_company_position"><span></span>Puesto: </label>
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
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <span class="caption-subject bold">Información de contacto:</span>
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
                        <label class="control-label" for="person_address"><span>*</span>Dirección 1: </label>
                        {!! Form::text('person[address]', $person->address, ['class' => 'form-control no-text-area',
                        'id' => 'person_address']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_phone"><span>*</span>Teléfono 1: </label>
                        {!! Form::text('person[phone]', $person->phone, ['class' => 'form-control no-text-area',
                        'id' => 'person_phone', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '10']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_alt_address"><span></span>Dirección 2: </label>
                        {!! Form::text('person[alt_address]', $person->alt_address, ['class' => 'form-control no-text-area',
                        'id' => 'person_alt_address']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_alt_phone"><span></span>Teléfono 2: </label>
                        {!! Form::text('person[alt_phone]', $person->alt_phone, ['class' => 'form-control no-text-area',
                        'id' => 'person_alt_phone', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '10']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_state_id"><span>*</span>Estado: </label>
                        {!!Form::select('person[state_id]', $requirements['states'], $person->state_id,
                        ['class' => 'bs-select form-control no-text-area', 'id' => 'person_state_id', 'title' => 'Seleccionar...']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_email"><span>*</span>Correo electrónico: </label>
                        {!! Form::text('person[email]', $person->email, ['class' => 'form-control no-text-area',
                        'id' => 'person_email']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_city"><span>*</span>Ciudad: </label>
                        {!! Form::text('person[city]', $person->city, ['class' => 'form-control no-text-area',
                        'id' => 'person_city']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="person_zip_code"><span>*</span>CP: </label>
                        {!! Form::text('person[zip_code]', $person->zip_code, ['class' => 'form-control no-text-area',
                        'id' => 'person_zip_code', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '5']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label textarea-label" for="person_notes"><span></span>Notas: </label>
                        {!! Form::textarea('person[notes]', $person->notes, ['rows' => '10', 'class' => 'form-control text-area',
                        'id' => "person_notes"]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions col-sm-offset-5">
    <button class="btn btn-circle green-meadow" id="save_person">Guardar</button>
    <a class="btn btn-circle red" href="{{route('persons.index')}}">Cancelar</a>
</div>