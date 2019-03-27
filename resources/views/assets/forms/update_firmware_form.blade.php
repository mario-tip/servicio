<div class="horizontal-form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_custom_id"><span></span>Current firmware: </label>
                    <label class="control-label" id="modal_current_firmware_label"></label> {{--$asset->firmwares->last()->firmware--}}
                    {!! Form::hidden('firmware[previous_firmware]', null, ['id' => 'modal_current_firmware_input']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_adquisition_date_container"><span>*</span>Date: </label>
                    <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="asset_adquisition_date_container">  {{--Removed class input-group, and data-date-start-date="+0d"--}}
                        {!! Form::text('firmware[date]', null, ['class' => 'form-control', 'readonly']) !!}
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_custom_id"><span>*</span>New version: </label>
                    {!! Form::text('firmware[firmware]', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_custom_id"><span>*</span>Risk: </label>
                    {!!Form::select('firmware[risk]', ['0' => 'Low','1' => 'Medium', '2' => 'High'], '', ['class' => 'bs-select form-control', 'title' => 'Select...']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="asset_custom_id"><span></span>Observations: </label>
                    {!! Form::textarea('firmware[observations]', null, ['rows' => '10', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
