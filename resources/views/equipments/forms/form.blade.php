<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Name: </label>
            {!! Form::text('equipment[name]', $equipment->name, ['class' => 'form-control',
            'id' => 'equipment_name', 'maxlength' => 45]) !!}
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Price: </label>
            {!! Form::text('equipment[price]', $equipment->price,[
            'class' => 'form-control', 'id' => 'equipment_price','maxlength' => 10,
            'onkeypress' => 'return validateInput(event, 5)', 'placeholder' => '0.00']) !!}
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Catalog number: </label>
            {!! Form::text('equipment[cat_num]', $equipment->cat_num,[
            'class' => 'form-control', 'id' => 'equipment_cat_num','maxlength' => 10,
            'onkeypress' => 'return validateInput(event, 5)']) !!}
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Serial: </label>
            {!! Form::text('equipment[serial]', $equipment->serial,[ 'maxlength' => 30,
            'class' => 'form-control', 'id' => 'equipment_serial']) !!}
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group datepicker-group">
            <label class="control-label" for="equipment_maintenance_container"><span class="required" aria-required="true">* </span>Date purchase:</label>
            <div class="date-picker-container">
              <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" id="equipment_maintenance_container">
                {!! Form::text('equipment[date_purchase]', $equipment->date_purchase,
                ['class' => 'form-control', 'id' => 'equipment_date_purchase', 'readonly']) !!}
                <span class="input-group-btn">
                  <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
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
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Quantity: </label>
            {!! Form::text('equipment[quantity]', $equipment->quantity,[
            'class' => 'form-control', 'id' => 'equipment_quantity', 'maxlength' => 7,
            'onkeypress' => 'return validateInput(event, 5)']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Code: </label>
            {!! Form::text('equipment[code]', $equipment->code,[
            'class' => 'form-control', 'id' => 'equipment_code', 'maxlength' => 18,
            'onkeypress' => 'return validateInput(event, 5)']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Code RFID: </label>
            {!! Form::text('equipment[code_rfid]', $equipment->code_rfid,[
            'class' => 'form-control', 'id' => 'equipment_code_rfid', 'maxlength' => 20,]) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Provider: </label>
            {!! Form::select('equipment[provider_id]',$providers['provide'],null,['class' => 'bs-select form-control', 'id' => 'provider_id', 'title' => 'Select...']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Number part: </label>
            {!! Form::text('equipment[part_num]', $equipment->part_num,[
            'class' => 'form-control', 'id' => 'equipment_part_num',
            'onkeypress' => 'return validateInput(event, 5)']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="equipment_name"><span class="required" aria-required="true">* </span>Description: </label>
            {!! Form::textarea('equipment[description]', $equipment->description,[
            'size'=>'30x2',
            'class' => 'form-control', 'id' => 'equipment_description']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="inputEmail1" class="control-label"><span class="required" aria-required="true">* </span>Image:</label>
          <div class="form-group">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
              <div>
                <span class="btn green-jungle btn-file btnForm">
                  <span class="fileinput-new">
                    Select image </span>
                  <span class="fileinput-exists">
                    Change </span>
                  <input type="file" name="image_eq" id="image_eq" class="form-control product mb-10" data-buttonText="Select archive" data-iconName="fa fa-inbox" accept="image/*" />
                </span>
                <a href="#" class="btn red fileinput-exists btnForm" data-dismiss="fileinput">
                  Remove </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <label class="control-label textarea-label" for="doc_file">File: </label>
          <div class="form-group">

            <div class="fileinput fileinput-new" data-provides="fileinput" id="doc_file">
              <div class="input-group input-large">
                <div class="form-control uneditable-input input-fixed input-group" data-trigger="fileinput">
                  <i class="fa fa-file fileinput-exists"></i>&nbsp;
                  <span class="fileinput-filename"> </span>
                </div>

                <span class="input-group-addon btn green-jungle btn-file btnForm">
                  <span class="fileinput-new"> Add </span>
                  <span class="fileinput-exists"> Change </span>
                  <input type="file" name="doc_file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                </span>

                <a href="javascript:;" class="input-group-addon btn red fileinput-exists btnForm" data-dismiss="fileinput"> Delete </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="select2-group" style="margin-bottom: 1em;">
            <label class="control-label" for="equipment_parts"><span></span>Add part: </label>
            <select id="part_select" class="form-control select2"></select>
            <a class="btn green-jungle btnForm" id="add_part">Add</a>
          </div>
        </div>
      </div>

    </div>

    <div class="portlet light portlet-fit bordered" style="margin: 0.5em 7em 2em;">
      <div class="portlet-title topForm">
      </div>
      <div class="portlet-body horizontal-form">
        <p class="titleForm">Parts</p>
        <div class="horizontal-form">
          <div class="form-body">
            <div class="row" id="equipment_parts_container">
              <div class="col-md-12" id="parts_subcontainer">
                <div class="table-scrollable">
                  <table class="table table-striped table-bordered table-hover" id="datatable_parts">
                    <thead>
                      <tr>
                        <th>Name part</th>
                        <th>Number part</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($equipment->parts) > 0)
                        @foreach($equipment->parts as $part)
                          <tr>

                            <td>{{$part->name}}</td>
                            <td>{{$part->number}}</td>
                            <td><span class="currency-format">{{$part->price}}</span></td>
                            <td>{{$part->description}}</td>
                            <td>
                              <div class="center_items">
                                <a class="btn btn-circle btn-icon-only red icon-delete">
                                  <i class="fa fa-trash-o"></i>
                                </a>
                                <input name="parts[]" type="hidden" value="{{$part->id}}" />
                              </div>
                            </td>
                          </tr>
                          @endforeach
                          @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button class="btn btnFormSave" id="save_equipment">Save </button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{!!URL::route('equipments.index')!!}">Cancel</a>
    </div>
  </div>
</div>
</div>
