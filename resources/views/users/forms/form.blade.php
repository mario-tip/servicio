<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="name"> <span class="required" aria-required="true">* </span>Fullname: </label>
            {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Insert name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)', 'id'=>'name'])!!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="username"><span>*</span>User: </label>
            {!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Insert user name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)'])!!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="inputEmail1"><span class="required" aria-required="true">* </span>Email: </label>
            {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Insert email', 'autocomplete'=>"off", 'id'=>'email'])!!}
            <p class="color" id="alertEmail" style="color: red;"></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="password"><span class="required" aria-required="true">* </span>Password: </label>
            {{Form::password('password', ['class' => 'form-control', 'id' => 'user_password', 'autocomplete' => 'off'])}}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="address">Address: </label>
            {!!Form::text('address',null,['class'=>'form-control', 'placeholder'=>'Insert address', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)'])!!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="type_user"><span class="required" aria-required="true">* </span>Type user: </label>
            {{-- {!! Form::select('type_user', array('1'=>'Administrator', '5'=>'Supervisor','2'=>'Technical','3'=>'Customer','4'=>'Person'), null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!} --}}
            {!! Form::select('type_user', $dependencies['roles'] , null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!}
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="customer_id"><span class="required" aria-required="true"> *</span>Customer: </label>
            {!!Form::select('customer_id', $dependencies['customers'], null, ['class' => 'bs-select form-control', 'id' => 'customer_id', 'title' => 'Select...']) !!}
          </div>
        </div>
      </div>

      <div class="portlet-body">
        <div class="horizontal-form">
          <div class="form-body bodyForm">
            <div class="row">
              <div class="col-md-12">
                <p class="subtitleForm">Notifications incidents </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="portlet-body form">
        <div class="tab-content">
          <div class="tab-pane active" id="portlet_tab_1_1">
            <div class="skin skin-minimal ">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label col-md-3">Notifications incidents</label>
                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification" value="true">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3">With copy to: </label>
                    <div class="input-group">
                      <div class="icheck-list">
                        @foreach ($users as $user)
                        <label>
                          <div class="icheckbox_flat-grey " style="position: relative;">

                            <input type="checkbox" name="notifications[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications',[])) ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                            </ins>
                          </div> {{$user->name}}
                        </label>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="portlet-body">
        <div class="horizontal-form">
          <div class="form-body bodyForm">
            <div class="row">
              <div class="col-md-12">
                <p class="subtitleForm">Notifications Service order</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="portlet-body form">
        <div class="tab-content">

          <div class="tab-pane active" id="portlet_tab_1_1">
            <div class="skin skin-minimal ">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label col-md-3">Notifications service order</label>
                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification_order" value="true">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3">With copy to: </label>
                    <div class="input-group">
                      <div class="icheck-list">
                        @foreach ($users as $user)
                        <label>
                          <div class="icheckbox_flat-grey " style="position: relative;">

                            <input type="checkbox" name="notifications_order[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications_order',[])) ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                            </ins>
                          </div> {{$user->name}}
                        </label>
                        @endforeach

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="portlet-body">
        <div class="horizontal-form">
          <div class="form-body bodyForm">
            <div class="row">
              <div class="col-md-12">
                <p class="subtitleForm">Notifications finished service</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="tab-content">

          <div class="tab-pane active" id="portlet_tab_1_1">
            <div class="skin skin-minimal ">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label col-md-3">Notifications finished service</label>
                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification_end" value="true">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3">With copy to: </label>
                    <div class="input-group">
                      <div class="icheck-list">
                        @foreach ($users as $user)
                        <label>
                          <div class="icheckbox_flat-grey " style="position: relative;">

                            <input type="checkbox" name="notifications_end[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications_end',[])) ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                            </ins>
                          </div> {{$user->name}}
                        </label>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 2em;">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btnFormSave" id="send">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{URL::route('users.index')}}">Cancel</a>
    </div>
  </div>
</div>
