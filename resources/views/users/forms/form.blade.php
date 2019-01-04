<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="name"> <span class="required" aria-required="true"> * </span>Name: </label>
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Insert name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)', 'id'=>'name'])!!}
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="" for="username"><span>*</span>User: </label>
                        {!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Insert user name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)'])!!}
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group-container">
                  <div class="form-group">
                      <label class="" for="inputEmail1"><span class="required" aria-required="true"> * </span>Email: </label>
                      {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Insert email', 'autocomplete'=>"off", 'id'=>'email'])!!}
                      <p class="color" id="alertEmail" style="color: red;"></p>
                  </div>
              </div>
              <div class="col-md-6 form-group-container">
                  <div class="form-group">
                      <label class="" for="password"><span>*</span>Password: </label>
                      {{Form::password('password', ['class' => 'form-control', 'id' => 'user_password', 'autocomplete' => 'off'])}}
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group-container">
                  <div class="form-group">
                      <label class="" for="address">Address : </label>
                      {!!Form::text('address',null,['class'=>'form-control', 'placeholder'=>'Insert address', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)'])!!}
                  </div>
              </div>
              <div class="col-md-6 form-group-container">
                <div class="form-group">
                    <div>
                        @php
                            // print_r($roles);
                        @endphp
                    </div>
                    <label class="" for="type_user"><span>*</span>Type user : </label>
                      {{-- {!! Form::select('type_user', array('1'=>'Administrator', '5'=>'Supervisor','2'=>'Technical','3'=>'Customer','4'=>'Person'), null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!} --}}

                      {!! Form::select('type_user',$roles_aux , null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn green-meadow circle" id="send">Save</button>
    <a class="btn red circle" href="{{URL::route('users.index')}}">Cancel</a>
</div>
