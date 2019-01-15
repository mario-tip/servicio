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
                    <label class="" for="type_user"><span>*</span>Type user : </label>
                      {{-- {!! Form::select('type_user', array('1'=>'Administrator', '5'=>'Supervisor','2'=>'Technical','3'=>'Customer','4'=>'Person'), null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!} --}}
                      {!! Form::select('type_user', $roles , null, ['class' => 'bs-select form-control', 'id' => 'type_user', 'title' => 'Select...']) !!}
                </div>
              </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="" for="admin_incident"><span>*</span>Incidents administrator : </label>
                        {!! Form::select('admin_incident', $users , null, ['class' => 'bs-select form-control', 'id' => 'admin_incident', 'title' => 'Select...']) !!}
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="fa fa-unlock-alt font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Notifications</span>
                            </div>
                           
                        </div>
                        <div class="portlet-body form">
                            <div class="tab-content">

                                <div class="tab-pane active" id="portlet_tab_1_1">
                                    <div class="skin skin-minimal "> 
                                        <div class="row">
                                            <div class="col-md-6 form-group-container">  
                                                <div class="form-group"> 
                                                    <label for="" class="control-label col-md-3">Notifications</label>
                                                    <input type="checkbox" class="make-switch" checked data-on-color="info" data-off-color="success" name="notific" value="true">
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group-container">  
                                                <div class="form-group"> 
                                                    <label class="control-label col-md-3">With copy to: </label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            @foreach ($users as $user)
                                                                <label>
                                                                    <div class="icheckbox_flat-grey " style="position: relative;">
                                                                        
                                                                        <input type="checkbox" name="userAdmin[]" value="{{$user->id}}" {{in_array($user->id ,old('userAdmin',[])) ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

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
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn green-meadow circle" id="send">Save</button>
    <a class="btn red circle" href="{{URL::route('users.index')}}">Cancel</a>
</div>
