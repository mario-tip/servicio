<div class="portlet-body bodyForm">
  <div class="horizontal-form">
    <div class="form-body">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="incident_select"><span class="required" aria-required="true">* </span>Search incident: </label>
            {!! Form::select('quotation[incident_id]', [], $quotation->incident_id,
            ['class' => 'form-control', 'id' => 'incident_select']) !!}
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span></span>Asset name: </label>
            <label class="form-control" id="incident_asset_name"></label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Quotation name: </label>
            {!!Form::text('quotation[name]', $quotation->name, ['class' => 'form-control', 'id' => 'quotation_name']) !!}
          </div>
        </div>
      </div>
      <div class="row">

      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label textarea-label" for="quotation_description"><span class="required" aria-required="true">* </span>Description: </label>
            {!!Form::textarea('quotation[description]', $quotation->description, ['size' => '30x5', 'class' => 'form-control', 'id' => 'quotation description']) !!}
          </div>
        </div>
      </div>
      {{-- <div class="row">
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
                                    <input type="file" name="quotation_file">
                                </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Delete </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
      <div>
        @php
        // dd($quotation);
        @endphp</div>
        @if ($quotation->quotation_file)
        <div class="row">
          <div class="col-md-6 form-group-container">
            <div class="form-group thumbnail">
              <?php
                        $mime_array = App\Quotation::getFileMime(public_path($quotation->quotation_file));
                        ?>
              @if($mime_array == null)
              <h2 class="file-not-found" style="margin-top: 10px;">Not found file </h2>
              @else
              <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
              @if($file_type == 'image')
              <img src="{{$quotation->quotation_file}}" class="incident-image  img-responsive" alt="">
              @else
              <div id="icon_file_container">
                <a href="{{$quotation->quotation_file}}" download>
                  <img class="file-type-icon" src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}" />
                  </br>Download
                </a>
              </div>
              @endif
              @endif
            </div>
          </div>
        </div>
        @endif

        <div class="row">
          <div class="col-md-6">
            <label class="control-label textarea-label" for="quotation_file"><span class="required" aria-required="true" id="span_quotation_file_required">* </span>Quote file: </label>

            <div class="form-group">
              <div class="fileinput fileinput-new" data-provides="fileinput" id="quotation_file">
                <div class="input-group input-large">
                  <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                    <span class="fileinput-filename"> </span>
                  </div>
                  <span class="input-group-addon btn green-jungle btn-file">
                    <span class="fileinput-new"> Add </span>
                    <span class="fileinput-exists"> Change </span>
                    <input type="file" name="quotation_file">

                  </span>

                  <a href="javascript:;" class="input-group-addon btn red fileinput-exists btnForm" data-dismiss="fileinput"> Delete </a>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="incident_parts_container"></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group" style="text-align: center;">
        <button type="submit" class="btn btnFormSave" id="save_equipment">Save</button>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group" style="text-align: center;">
        <a class="btn btnFormCancel" href="{!!URL::route('quotations.index')!!}">Cancel</a>
      </div>
    </div>
  </div>
