@extends("layouts.master")

@section("styles")
{!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
{!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
{!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
{!! Html::style("/assets/global/plugins/select2/css/select2.min.css") !!}
{!! Html::style("/assets/global/plugins/select2/css/select2-bootstrap.min.css") !!}
{!! Html::style("/assets/css/asset.css") !!}
@endsection

@section('breadcrumb')
<div class="page-bar">
  @include('partials.request')
  {{-- <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/actives')!!}">Assets</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>New asset</a>
            </li>
        </ul> --}}
</div>
@endsection

@section("page-content")
<div class="row content_container paddingForm">
  <div class="col-md-12" id="asset_form_subcontainer">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    {!! Form::open(['route' => 'actives.store', 'data-method' => 'POST', 'files' => true]) !!}
    <!-- BEGIN NEW ASSET PORTLET-->
    <div class="portlet light portlet-fit bordered">
      <div class="portlet-title topForm">
      </div>
      <div class="portlet-body">
        <p class="titleForm">New equipment</p>
        <div class="horizontal-form">
          <div class="form-body bodyForm">
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_custom_id"><span class="required" aria-required="true">* </span>Equipment ID: </label>
                  {!! Form::text('asset[asset_custom_id]', $asset->asset_custom_id, ['class' => 'form-control', 'id' => 'asset_custom_id']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_adquisition_date_container"><span class="required" aria-required="true">* </span>Purchase date:</label>
                  <div class="date-picker-container">
                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy"> {{--Removed class input-group, and data-date-start-date="+0d"--}}
                      {!! Form::text('asset[adquisition_date]', $asset->adquisition_date, ['class' => 'form-control',
                      'id' => 'asset_adquisition_date', 'readonly']) !!}
                      <span class="input-group-btn">
                        <button id="asset_adquisition_date_container" class="btn default" type="button">
                          <i class="fa fa-calendar"></i>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_name"><span class="required" aria-required="true">* </span>Equipment name: </label>
                  {!! Form::text('asset[name]', $asset->name, ['class' => 'form-control', 'id' => 'asset_name']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_cost"><span class="required" aria-required="true">* </span>Price: </label>
                  {!! Form::text('asset[cost]', $asset->cost, ['class' => 'form-control', 'id' => 'asset_cost',
                  'onkeypress' => 'return validateInput(event, 5)', 'placeholder' => '0.00']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_model"><span class="required" aria-required="true">* </span>Model: </label>
                  {!! Form::text('asset[model]', $asset->model, ['class' => 'form-control', 'id' => 'asset_model']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_condition"><span class="required" aria-required="true">* </span>Condition: </label>
                  {!!Form::select('asset[condition]',['1' => 'New','2' => 'Used'], $asset->condition, ['class' => 'bs-select form-control', 'id' => 'asset_condition', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_serial"><span class="required" aria-required="true">* </span>Serial number: </label>
                  {!! Form::text('asset[serial]', $asset->serial, ['class' => 'form-control', 'id' => 'asset_serial']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_model_status"><span class="required" aria-required="true">* </span>Status: </label>
                  {!!Form::select('asset[status]', ['0' => 'Inactive','1' => 'Active'], $asset->status, ['class' => 'bs-select form-control', 'id' => 'asset_status', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_brand"><span class="required" aria-required="true">* </span>Brand: </label>
                  {!! Form::text('asset[brand]', $asset->brand, ['class' => 'form-control', 'id' => 'asset_brand']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_person_id"><span class="required" aria-required="true">* </span>Owner: </label>
                  {!!Form::select('asset[person_id]', $dependencies['persons'], $asset->person_id, ['class' => 'bs-select form-control', 'id' => 'asset_person_id', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label"><span class="required" aria-required="true">* </span>Location: </label>
                  {!!Form::select('asset[location_id]', $dependencies['locations'], $location_id, ['class' => 'bs-select form-control', 'id' => 'asset_location_id', 'title' => 'Select...']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group datepicker-group">
                  <label class="control-label" for="asset_expires_date"><span></span>Expiration date: </label>
                  <div class="date-picker-container">
                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" id="asset_expires_date">
                      {!! Form::text('asset[expires_date]', $asset->expires_date, ['class' => 'form-control', 'id' => 'asset_expires_date', 'readonly']) !!}
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
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label textarea-label" for="asset_description"><span class="required" aria-required="true">* </span>Description: </label>
                  {!! Form::textarea('asset[description]', $asset->description, ['size' => '30x2', 'class' => 'form-control', 'id' => 'asset_description']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_provider_id"><span></span>Provider: </label>
                  {!!Form::select('asset[provider_id]', $dependencies['providers'], $asset->provider_id, ['class' => 'bs-select form-control', 'id' => 'asset_provider_id', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_customer_id"><span class="required" aria-required="true">* </span>Customer: </label>
                  {!!Form::select('asset[customer_id]', $dependencies['customers'], $asset->customer_id, ['class' => 'bs-select form-control', 'id' => 'asset_customer_id', 'title' => 'Select...']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_purchase_order"><span></span>Payment reference: </label>
                  {!! Form::text('asset[purchase_order]', $asset->purchase_order, ['class' => 'form-control', 'id' => 'asset_purchase_order']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_project_id"><span class="required" aria-required="true">* </span>Project: </label>
                  {!! Form::select('asset[project_id]', $dependencies['projects'], $asset->project_id, ['class' => 'bs-select form-control', 'id' => 'asset_project_id', 'title' => 'Select...']) !!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_barcode"><span class="required" aria-required="true">* </span>Barcode: </label>
                  {!! Form::text('asset[barcode]', $asset->barcode, ['class' => 'form-control', 'id' => 'asset_barcode']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_subcategory_id"><span class="required" aria-required="true">* </span>Quantity: </label>
                  {!! Form::text('asset[quantity]', $asset->quantity,['class' => 'form-control','id' => 'asset_quantity','maxlength' => 8,'onkeypress' => 'return validateInput(event, 5)'])!!}
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_subcategory_id"><span class="required" > </span>RFID Code: </label>
                  {!! Form::text('asset[code_rfid]', $asset->code_rfid,['class' => 'form-control','id' => 'asset_code_rfid','maxlength' => 20 ])!!}
                </div>
              </div>
            </div>

            <div class="row">
              {{-- <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_subcategory_id"><span class="required" aria-required="true">* </span>Subcategory: </label>
                  {!! Form::select('asset[subcategory_id]', $dependencies['subcategories'], $asset->subcategory_id, ['class' => 'bs-select form-control', 'id' => 'asset_subcategory_id', 'title' => 'Select...']) !!}
                </div>
              </div> --}}
              <div class="col-md-6 ">
                <div class="form-group">
                  <label class="control-label" for="asset_subcategory_id"><span class="required" aria-required="true">* </span>Depreciation: </label>
                  {!! Form::text('asset[depreciation]', $asset->depreciation,['class' => 'form-control','id' => 'asset_depreciation','maxlength' => 3,'placeholder' => '%','max' => 100,'onkeypress' => 'return validateInput(event, 5)'])!!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="inputEmail1" class="control-label"><span class="required"></span>Photo:</label>
                <div class="form-group">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new ">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail">
                    </div>
                    <div>
                      <span class="btn green-jungle btn-file btnForm">
                        <span class="fileinput-new">Choose a image </span>
                        <span class="fileinput-exists">Change </span>
                        {!! Form::file('image', $asset->image, [
                          'class'=>'form-control product mb-10',
                          'accept="image/*'
                          ]) !!}
                      </span>
                      <a href="#" class="btn red fileinput-exists btnForm" data-dismiss="fileinput">Remove </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <label class="control-label textarea-label"<span id="span_quotation_file_required"></span>File: </label>
                <div class="form-group">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="input-group input-large">
                      <div class="form-control uneditable-input input-fixed input-group" data-trigger="fileinput">
                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                        <span class="fileinput-filename"> </span>
                      </div>
                      <span class="input-group-addon btn green-jungle btn-file btnForm">
                        <span class="fileinput-new"> Add </span>
                        <span class="fileinput-exists"> Change </span>
                        {!! Form::file('document', $asset->document, [
                          'class'=>'form-control product mb-10',
                          'accept' => 'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf'
                          ]) !!}
                      </span>
                      <a href="javascript:;" class="input-group-addon btn red fileinput-exists btnForm" data-dismiss="fileinput"> Delete </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- END NEW ASSET PORTLET-->
    @include("assets.forms.form")
    {!! Form::close() !!}
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
@endsection
@section("scripts")
{!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
{!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.eu.min.js") !!}
{!! Html::script("/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") !!}
{!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}

{!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
{!! Html::script("/assets/pages/scripts/components-date-time-pickers.min.js") !!}

{!! Html::script("/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") !!}
{!! Html::script("/assets/global/scripts/datatable.js") !!}
{!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
{!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}

{!! Html::script("/assets/scripts/validateFields.js") !!}
{!! Html::script("/assets/global/plugins/select2/js/select2.full.min.js") !!}
{!! Html::script("/assets/global/plugins/select2/js/i18n/en.js") !!}
{!! Html::script("/assets/scripts/asset.js") !!}
<script type="application/javascript">
  $(document).ready(function() {
    $("#liAssets").addClass("active");
    $("#liAssetsList").addClass("active");

    $('#asset_cost').number(true, 2);
  });
</script>
@endsection
