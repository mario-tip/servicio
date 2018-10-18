<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Buscar activo:</label>
                <div class="col-sm-7">
                    <select name="asset_id" id="asset_id" class="form-control asset"></select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Tipo de servicio:</label>
                <div class="col-sm-7">
                    {!! Form::select('type', array('0'=>'Limpieza','1'=>'Reparación'), null, ['class' => 'bs-select form-control', 'id' => 'type', 'title' => 'Seleccionar...']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Id de activo:</label>
                <div class="col-sm-7">
                    {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Nombre de activo:</label>
                <div class="col-sm-7">
                    {!!Form::text('asset_name',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_name'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Marca:</label>
                <div class="col-sm-7">
                    {!!Form::text('brand',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'brand'])!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Ubicación:</label>
                <div class="col-sm-7">
                    {!!Form::text('location',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'location'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Serie:</label>
                <div class="col-sm-7">
                    {!!Form::text('serial',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'serial'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Descripción del problema:</label>
        <div class="col-sm-7">
            {!!Form::textarea('description',null,['class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'description'])!!}
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Persona que reporta el problema:</label>
        <div class="col-sm-7">
            <select class="bs-select form-control person" name="person_id" id="person_id">
                <option value="0" disabled selected>Selecciona una opción...</option>
                @foreach($persons as $person)
                    <option value="{{$person->id}}"
                            {{isset($incident) ? ($incident->person_id == $person->id)?'selected':'' : ''}}
                    >{{$person->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Fecha de atención sugerida:</label>
        <div class="col-sm-7">
            <div class="col-sm-4">
                <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                    {!! Form::text('suggested_date', null, ['class' => 'form-control', 'style' => 'pointer-events: none;','id' => 'suggested_date', 'readonly']) !!}
                    <span class="input-group-btn">
                        <button class="btn default" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    {!! Form::text('suggested_time', null, ['class' => 'form-control timepicker timepicker-24','style' => 'pointer-events: none;', 'id' => 'suggested_time', 'readonly']) !!}
                    <span class="input-group-btn">
                        <button class="btn default" type="button">
                            <i class="fa fa-clock-o"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Prioridad:</label>
        <div class="col-sm-7">
            {!! Form::select('priority', array('0'=>'Alta', '1'=>'Media', '2'=>'Baja'), null, ['class' => 'bs-select form-control', 'id' => 'priority', 'title' => 'Seleccionar...']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> Adjuntar evidencia:</label>
        <div class="col-sm-7">
            <input type="file" name="evidence_file" id="evidence_file" class="form-control product mb-10" data-buttonText="Seleccionar archivo" data-iconName="fa fa-inbox"/>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">Notas adicionales:</label>
        <div class="col-sm-7">
            {!!Form::textarea('notes',null,['class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'notes'])!!}
        </div>
    </div>
</div>

<!-- BEGIN ASSET'S PARTS PORTLET-->
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold">Seleccionar partes afectadas (Opcional)</span>
        </div>
    </div>
    <div class="portlet-body horizontal-form">
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row" id="equipment_parts_container"></div>
            </div>
        </div>
    </div>
</div>
<!-- END ASSET'S PARTS PORTLET-->

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn green-meadow" id="send">Guardar</button>
    <a class="btn red" href="{{URL::route('incidents.index')}}">Cancelar</a>
</div>
