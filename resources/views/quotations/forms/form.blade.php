<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="form-group select2-group">
                <label class="control-label" for="incident_select"><span>*</span>Search incident : </label>
                {!! Form::select('quotation[incident_id]', [], $quotation->incident_id,
                ['class' => 'form-control', 'id' => 'incident_select']) !!}
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span></span>Asset name: </label>
                        <label id="incident_asset_name"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Quotation name: </label>
                        {!!Form::text('quotation[name]', $quotation->name, ['class' => 'form-control', 'id' => 'quotation_name']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label textarea-label" for="quotation_description"><span>*</span>Description: </label>
                        {!!Form::textarea('quotation[description]', $quotation->description, ['rows' => '10', 'class' => 'form-control', 'id' => 'quotation description']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label textarea-label" for="quotation_file"><span id="span_quotation_file_required"></span>Quote file: </label>
                        <div class="fileinput fileinput-new" data-provides="fileinput" id="quotation_file">
                            <div class="input-group input-large">
                                <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new"> Add </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="quotation_file"> </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Delete </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="incident_parts_container"></div>
        </div>
    </div>
</div>


<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn btn-circle green-meadow" id="save_equipment">Save</button>
    <a class="btn btn-circle red" href="{!!URL::route('quotations.index')!!}">Cancel</a>
</div>
