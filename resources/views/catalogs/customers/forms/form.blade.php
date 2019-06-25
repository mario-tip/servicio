<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label class="control-label" for="customer_idcustomer">Id: </label>
            {!! Form::text(null, $customer->id, [
            'class' => 'form-control',
            'id' => 'customer_idcustomer',
            'disabled' => 'disabled',
            // 'onkeypress' => 'return validateInput(event, 2)',
            'maxlength' => '12'
            ]) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="customer_name"><span class="required" aria-required="true">* </span>Name: </label>
            {!! Form::text('customer[name]', $customer->name, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_type"><span class="required" aria-required="true">* </span>Type: </label>
            {!!Form::select('customer[type]', $requirements['types'], $customer->type,
            ['class' => 'bs-select form-control', 'id' => 'customer_type', 'title' => 'Select...']) !!}
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="customer_name">RFC: </label>
            {!! Form::text('customer[rfc]', $customer->rfc, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="customer_name">Phone: </label>
            {!! Form::text('customer[phone]', $customer->phone, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="customer_idcustomer">Address: </label>
            {!! Form::textarea('customer[address]', $customer->address, [
            'class' => 'form-control',
            'rows'=>"3"
            ]) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="person_id"><span class="required" aria-required="true">* </span>Person: </label>
            {!!Form::select('customer[person_id]', $requirements['persons'], $customer->person_id,
            ['class' => 'bs-select form-control no-text-area', 'id' => 'person_id', 'title' => 'Select...']) !!}
          </div>
        </div>
      </div>

      <div class="row text-center">
        <h4 class="subtitle">Administrative Employee</h4>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Name: </label>
            {!! Form::text('customer[adm_name]', $customer->adm_name, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Phone: </label>
            {!! Form::text('customer[adm_phone]', $customer->adm_phone, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Email: </label>
            {!! Form::text('customer[adm_email]', $customer->adm_email, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
      </div>

      <div class="row text-center">
        <h4>Support Employee</h4>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Name: </label>
            {!! Form::text('customer[sup_name]', $customer->sup_name, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Phone: </label>
            {!! Form::text('customer[sup_phone]', $customer->sup_phone, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="control-label" for="customer_name">Email: </label>
            {!! Form::text('customer[sup_email]', $customer->sup_email, [
            'class' => 'form-control',
            'id' => 'customer_name'
            ]) !!}
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
