<div class="horizontal-form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label modal-label" for="asset_custom_id"><span>*</span>Authorize quotation : </label>
                    <select name="quotation[authorization]" id="quotation_status_select" class="form-control">
                        <option value="0">On hold</option>
                        <option value="1">Yes</option>
                        <option value="2">Not</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="asset_custom_id"><span></span>Comments : </label>
                    {!! Form::textarea('quotation[comments]', null, ['rows' => '10', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="authorization_file "><span></span>File authorization : </label>
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="authorization_file">
                        <div class="input-group input-large">
                            <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new"> Add </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="authorization_file"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Delete </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
