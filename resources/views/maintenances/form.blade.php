<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Search asset :</label>
                <div class="col-sm-7">
                    <select name="asset" id="asset" class="form-control asset"></select>
                    <input type="hidden" name="asset_id" id="asset_id">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Asset ID :</label>
                <div class="col-sm-7">
                    {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Asset name:</label>
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
                <label for="maintenance_date" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Day:</label>
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
                <label for="maintenance_time" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Hour:</label>
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
                <label for="technician" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Technician:</label>
                <div class="col-sm-7">
                    <select name="technician" id="technician" class="form-control technician"></select>
                    <input type="hidden" name="user_id" id="user_id">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description" class="col-md-3 control-label"><span class="required" aria-required="true"> * </span> Description:</label>
                <div class="col-sm-7">
                    {!!Form::textarea('description',null,['class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'description'])!!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn btn-circle green-meadow" id="send">Save</button>
    <a class="btn btn-circle red" href="{{URL::route('maintenances.index')}}">Cancel</a>
</div>
