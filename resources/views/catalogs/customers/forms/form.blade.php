<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" for="customer_idcustomer"><span class="required" aria-required="true">* </span>ID: </label>
            {!! Form::text('customer[idcustomer]', $customer->idcustomer, ['class' => 'form-control',
            'id' => 'customer_idcustomer', 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '9']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" for="customer_name"><span class="required" aria-required="true">* </span>Name: </label>
            {!! Form::text('customer[name]', $customer->name, ['class' => 'form-control',
            'id' => 'customer_name']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" for="customer_type"><span class="required" aria-required="true">* </span>Type: </label>
            {!!Form::select('customer[type]', $requirements['types'], $customer->type,
            ['class' => 'bs-select form-control', 'id' => 'customer_type', 'title' => 'Select...']) !!}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button class="btn btnFormSave" id="save_customer">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{route('customers.index')}}">Cancel</a>
    </div>
  </div>
</div>
