<div class="horizontal-form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_custom_id"><span></span>Firmware actual: </label>
                    <label class="control-label" id="modal_current_firmware_label"></label> {{--$asset->firmwares->last()->firmware--}}
                    {!! Form::hidden('firmware[previous_firmware]', null, ['id' => 'modal_current_firmware_input']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_adquisition_date_container"><span>*</span>Fecha: </label>
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
                    <label class="control-label" for="asset_custom_id"><span>*</span>Nueva versión: </label>
                    {!! Form::text('firmware[firmware]', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label" for="asset_custom_id"><span>*</span>Riesgo: </label>
                    {!!Form::select('firmware[risk]', ['0' => 'Bajo','1' => 'Medio', '2' => 'Alto'], '', ['class' => 'bs-select form-control', 'title' => 'Seleccionar...']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="asset_custom_id"><span></span>Observaciones: </label>
                    {!! Form::textarea('firmware[observations]', null, ['rows' => '10', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>