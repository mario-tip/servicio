<div class="horizontal-form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label modal-label" for="asset_custom_id"><span>*</span>Autorizar cotización: </label>
                    <select name="quotation[authorization]" id="quotation_status_select" class="form-control">
                        <option value="0">Pendiente</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="asset_custom_id"><span></span>Comentarios: </label>
                    {!! Form::textarea('quotation[comments]', null, ['rows' => '10', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group-container">
                <div class="form-group">
                    <label class="control-label textarea-label" for="authorization_file "><span></span>Archivo de autorización: </label>
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="authorization_file">
                        <div class="input-group input-large">
                            <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new"> Adjuntar </span>
                                                            <span class="fileinput-exists"> Cambiar </span>
                                                            <input type="file" name="authorization_file"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>