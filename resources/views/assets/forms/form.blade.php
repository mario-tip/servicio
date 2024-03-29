<!-- BEGIN ASSET'S PARTS PORTLET-->
<div class="portlet light portlet-fit bordered">
  <div class="portlet-title topForm">
  </div>
  <div class="portlet-body horizontal-form">
    <p class="titleForm">Equipment module</p>

    <div class="horizontal-form">
      <div class="form-body bodyForm">
        <div class="row">
          <div class="col-md-12 form-group-container">
            <div class="form-group equipment-select-group ">
              <label class="control-label" id="asset_equipment_label" for="asset_equipment_id">Equipment module: </label>
              {!!Form::select('asset[equipment_id]', $dependencies['equipments'], $asset->equipment_id,
              ['class' => 'bs-select form-control asset-equipment', 'id' => 'asset_equipment_id',
              'title' => 'Select...']) !!}
              <a class="btn green-jungle btn-file btnForm" id="get_equipment_parts">Ok</a>
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
  <div class="portlet-title topForm">
  </div>
  <div class="portlet-body horizontal-form">
    <p class="titleForm">Additional Information</p>

    <div class="horizontal-form">
      <div class="form-body bodyForm">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group datepicker-group">
              <label class="control-label" for="asset_maintenance_container"><span class="required" aria-required="true">* </span>Maintenance: </label>
              <div class="date-picker-container">
                <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" id="asset_maintenance_container">
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
          <div class="col-md-9">
            <div class="form-group">
              <label class="control-label textarea-label" for="asset_notes"><span></span>Notes: </label>
              {!! Form::textarea('asset[notes]', $asset->notes, ['size' => '30x2', 'class' => 'form-control', 'id' => 'asset_notes']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group" style="text-align: center;">
        <button type="submit" class="btn btnFormSave" id="save_asset">Save</button>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group" style="text-align: center;">
        <a class="btn btnFormCancel" href="{!!URL::route('actives.index')!!}">Cancel</a>
      </div>
    </div>
  </div>
</div>
<!-- END ADDITIONAL INFO PORTLET-->
