@extends("layouts.master")
@section("styles")

  {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
  {!! Html::style("/assets/css/asset.css") !!}
  {!!Html::style("/assets/global/plugins/icheck/skins/all.css")!!}


@endsection

@section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/users')!!}">Users</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Edit user</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
          {!! Form::model($user_edit, ['route' => ['users.update', $user_edit->id], 'method' => 'PUT', 'id' => 'user_form']) !!}
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-pencil font-blue-200"></i>
                        <span class="caption-subject bold font-blue-200">Edit user</span>
                    </div>
                </div>
                

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
                                                <i class="fa fa-envelope-o font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Notifications incidents</span>
                                            </div>
                                           
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="tab-content">
                
                                                <div class="tab-pane active" id="portlet_tab_1_1">
                                                    <div class="skin skin-minimal "> 
                                                        <div class="row">
                                                            <div class="col-md-6 form-group-container">  
                                                                <div class="form-group"> 
                                                                    <label for="" class="control-label col-md-3">Notifications incidents</label>
                                                                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification" value="true" {{$user_edit->active_notification == 1 ? 'checked' : '' }} >
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
                                                                                        
                                                                                        <input type="checkbox" name="notifications[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications',[])) ? 'checked' : '' }}  {{$user->active ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">
                
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet light">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="fa fa-envelope-o font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Notifications service order</span>
                                            </div>
                                           
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="tab-content">
                
                                                <div class="tab-pane active" id="portlet_tab_1_1">
                                                    <div class="skin skin-minimal "> 
                                                        <div class="row">
                                                            <div class="col-md-6 form-group-container">  
                                                                <div class="form-group"> 
                                                                    <label for="" class="control-label col-md-3">Notifications service order </label>
                                                                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification_order" value="true" {{$user_edit->active_notification_order == 1 ? 'checked' : '' }} >
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
                                                                                        
                                                                                        <input type="checkbox" name="notifications_order[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications_order',[])) ? 'checked' : '' }}  {{$user->active_order ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">
                
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
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet light">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="fa fa-envelope-o font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Notifications finished service</span>
                                            </div>
                                           
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="tab-content">
                
                                                <div class="tab-pane active" id="portlet_tab_1_1">
                                                    <div class="skin skin-minimal "> 
                                                        <div class="row">
                                                            <div class="col-md-6 form-group-container">  
                                                                <div class="form-group"> 
                                                                    <label for="" class="control-label col-md-3">Notifications finished service </label>
                                                                    <input type="checkbox" class="make-switch" data-on-color="info" data-off-color="success" name="active_notification_end" value="true" {{$user_edit->active_notification_end == 1 ? 'checked' : '' }} >
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
                                                                                        
                                                                                        <input type="checkbox" name="notifications_end[]" value="{{$user->id}}" {{in_array($user->id ,old('notifications_end',[])) ? 'checked' : '' }}  {{$user->active_end ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">
                
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

                    <div class="form-actions col-sm-offset-5">
                        <button type="submit" class="btn green-meadow circle" id="send">Save</button>
                        <a class="btn red circle" href="{{URL::route('users.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            
          {!!Form::close()!!}
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/global/plugins/icheck/icheck.min.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
          $("#liTools").addClass("active");
          $("#liUsers").addClass("active");
        });
    </script>
@endsection
