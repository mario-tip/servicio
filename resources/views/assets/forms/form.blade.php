

<!-- BEGIN ASSET'S PARTS PORTLET-->
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold">Partes de activos</span>
        </div>
    </div>
    <div class="portlet-body horizontal-form">
        <div class="horizontal-form">
            <div class="form-body">

                <div class="row">
                    <div class="col-md-12 form-group-container">
                        <div class="form-group equipment-select-group">
                            <label class="control-label" id="asset_equipment_label" for="asset_equipment_id">Tipo de activo: </label>
                            {!!Form::select('asset[equipment_id]', $dependencies['equipments'], $asset->equipment_id,
                            ['class' => 'bs-select form-control asset-equipment', 'id' => 'asset_equipment_id',
                            'title' => 'Seleccionar...']) !!}
                            <a class="btn green-meadow" id="get_equipment_parts">Aceptar</a>
                        </div>
                    </div>
                </div>
                <div class="row" id="equipment_parts_container"></div>
            </div>
        </div>
    </div>
</div>
<!-- END ASSET'S PARTS PORTLET-->

<!-- BEGIN ADDITIONAL INFO PORTLET-->
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold">Información adicional</span>
        </div>
    </div>
    <div class="portlet-body horizontal-form">
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group datepicker-group">
                            <label class="control-label" for="asset_maintenance_container"><span>*</span>Mantenimiento: </label>
                            <div class="date-picker-container">
                                <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="asset_maintenance_container">
                                    {!! Form::text('asset[maintenance_date]', $asset->maintenance_date,
                                    ['class' => 'form-control', 'id' => 'asset_maintenance_date', 'readonly']) !!}
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label textarea-label" for="asset_notes"><span></span>Notas: </label>
                            {!! Form::textarea('asset[notes]', $asset->notes, ['rows' => '10', 'class' => 'form-control', 'id' => 'asset_notes']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions col-sm-offset-5">
        <button type="submit" class="btn green-meadow" id="save_asset">Guardar</button>
        <a class="btn red" href="{!!URL::route('actives.index')!!}">Cancelar</a>
    </div>
</div>
<!-- END ADDITIONAL INFO PORTLET-->
