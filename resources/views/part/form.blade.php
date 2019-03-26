<div class="form-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span> Part name:</label>
        {!!Form::text('name',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'name'])!!}
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span> Part number:</label>
        {!!Form::text('number',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'number'])!!}
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span> Price:</label>
        {!!Form::text('price',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'price'])!!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="name" class="control-label"><span class="required" aria-required="true">* </span> Description:</label>
        {!!Form::textarea('description',null,['size'=>'30x2','class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'description'])!!}
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 2em;">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btnFormSave" id="send">Save </button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{URL::route('parts.index')}}">Cancel</a>
    </div>
  </div>
</div>
