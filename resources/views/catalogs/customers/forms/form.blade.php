<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="customer_idcustomer"><span>*</span>ID : </label>
                        {!! Form::text('customer[idcustomer]', $customer->idcustomer, ['class' => 'form-control',
                        'id' => 'customer_idcustomer', 'onkeypress' => 'return validateInput(event, 2)',
                        'maxlength' => '9']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="customer_name"><span>*</span>Name : </label>
                        {!! Form::text('customer[name]', $customer->name, ['class' => 'form-control',
                        'id' => 'customer_name']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="customer_type"><span>*</span>Type : </label>
                        {!!Form::select('customer[type]', $requirements['types'], $customer->type,
                        ['class' => 'bs-select form-control', 'id' => 'customer_type', 'title' => 'Select...']) !!}
                    </div>
                </div>
            </div>
            <div class="">
              @php
                echo $customer->type;
                echo gettype ($customer->type);
              @endphp
            </div>
        </div>
    </div>
</div>
<div class="form-actions col-sm-offset-5">
    <button class="btn btn-circle green-meadow" id="save_customer">Save</button>
    <a class="btn btn-circle red" href="{{route('customers.index')}}">Cancel</a>
</div>
