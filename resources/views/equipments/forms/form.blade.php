<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Name: </label>
                        {!! Form::text('equipment[name]', $equipment->name, ['class' => 'form-control',
                        'id' => 'equipment_name', 'maxlength' => 45]) !!}
                    </div>
                </div>
                <div class="col-md-3 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Price: </label>
                        {!! Form::text('equipment[price]', $equipment->price,[
                        'class' => 'form-control', 'id' => 'equipment_price','maxlength' => 10,
                        'onkeypress' => 'return validateInput(event, 5)', 'placeholder' => '0.00']) !!}
                    </div>
                </div>
                <div class="col-md-3 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Catalog number: </label>
                        {!! Form::text('equipment[cat_num]', $equipment->cat_num,[
                        'class' => 'form-control', 'id' => 'equipment_cat_num','maxlength' => 10,
                        'onkeypress' => 'return validateInput(event, 5)']) !!}
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Serial: </label>
                        {!! Form::text('equipment[serial]', $equipment->serial,[ 'maxlength' => 30,
                        'class' => 'form-control', 'id' => 'equipment_serial']) !!}
                    </div>
                </div>
                <div class="col-md-5 form-group-container">
                <div class="form-group datepicker-group">
                            <label class="control-label" for="equipment_maintenance_container"><span>*</span>Date purchase:</label>
                            <div class="date-picker-container">
                                <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="equipment_maintenance_container">
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
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Quantity: </label>
                        {!! Form::text('equipment[quantity]', $equipment->quantity,[
                        'class' => 'form-control', 'id' => 'equipment_quantity', 'maxlength' => 7,
                        'onkeypress' => 'return validateInput(event, 5)']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Code: </label>
                        {!! Form::text('equipment[code]', $equipment->code,[
                        'class' => 'form-control', 'id' => 'equipment_code', 'maxlength' => 18,
                        'onkeypress' => 'return validateInput(event, 5)']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Code RFID: </label>
                        {!! Form::text('equipment[code_rfid]', $equipment->code_rfid,[
                        'class' => 'form-control', 'id' => 'equipment_code_rfid', 'maxlength' => 20,]) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Provider: </label>
                        {!! Form::select( 'equipment[provider_id]',$providers['provide'],['class' => 'form-control', 'id' => 'provider_id', 'title' => 'Select...']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Number part: </label>
                        {!! Form::text('equipment[part_num]', $equipment->part_num,[
                        'class' => 'form-control', 'id' => 'equipment_part_num',
                        'onkeypress' => 'return validateInput(event, 5)']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Description: </label>
                        {!! Form::textarea('equipment[description]', $equipment->description,[
                        'size'=>'30x2',
                        'class' => 'form-control', 'id' => 'equipment_description']) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group last">
                  <label for="inputEmail1" class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>Image:</label>
                  <div class="col-sm-7">
                    <div class="fileinput fileinput-new" data-provides="fileinput">

                        @if(isset($incident))
                        <img src="http://service.altatec.com.mx/{{$incident->image}}" alt="" />
                        @endif

                      <div class="fileinput-preview fileinput-exists thumbnail">
                      </div>
                      <div>
                        <span class="btn default btn-file">
                          <span class="fileinput-new">
                            Select image </span>
                          <span class="fileinput-exists">
                            Change </span>
                          <input type="file" name="image_eq" id="image_eq" class="form-control product mb-10" data-buttonText="Select archive" data-iconName="fa fa-inbox" accept="image/*" />
                        </span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                          Remove </a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                    <label class="control-label textarea-label" for="doc_file">File: </label>
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="doc_file">
                    <div class="input-group input-large">
                      <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                        <span class="fileinput-filename"> </span>
                      </div>

                      <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> Add </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="doc_file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                      </span>

                      <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Delete </a>
                    </div>
                  </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="select2-group">
                        <label class="control-label" for="equipment_parts"><span></span>Add part: </label>
                        <select id="part_select" class="form-control select2"></select>
                        <a class="btn btn-circle green-meadow" id="add_part">Add</a>
                    </div>
                </div>
            </div>

            </div>

            <div class="row" id="equipment_parts_container">
                <div class="col-md-12" id="parts_subcontainer">
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
                                    <input name="parts[]" type="hidden" value="{{$part->id}}"/>
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

<div class="form-actions col-sm-offset-5">
    <button class="btn btn-circle green-meadow" id="save_equipment">Save </button>
    <a class="btn btn-circle red" href="{!!URL::route('equipments.index')!!}">Cancel</a>
</div>
