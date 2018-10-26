<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Buscar activo:</label>
                <div class="col-sm-7">
                    <select name="filter" id="filter" class="form-control asset"></select>
                    <input type="hidden" name="asset_id" id="asset_id">
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
                <label for="name" class="col-md-3 control-label">Serie:</label>
                <div class="col-sm-7">
                    {!!Form::text('serial',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'serial'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="maintenance_date" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Día:</label>
                <div class="col-sm-7">
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
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="maintenance_time" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Hora:</label>
                <div class="col-sm-7">
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="search" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Técnico:</label>
                <div class="col-sm-7">
                    <select name="search" id="search" class="form-control technician"></select>
                    <input type="hidden" name="user_id" id="user_id">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="notes" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Descripción:</label>
                <div class="col-sm-7">
                    {!!Form::textarea('notes',null,['class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'notes'])!!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn btn-circle green-meadow" id="send">Guardar</button>
    <a class="btn btn-circle red" href="{{URL::route('maintenances.index')}}">Cancelar</a>
</div>
