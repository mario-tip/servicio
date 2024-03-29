@extends("layouts.master")
@section("styles")

  {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
  {!! Html::style("/assets/css/roles.css") !!}
  {!!Html::style("/assets/global/plugins/icheck/skins/all.css")!!}

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
                <a href="{!!URL::to('/users')!!}">Roles</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Edit Roll</a>
            </li>
        </ul> --}}
    </div>
@endsection

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
              <div class="portlet-body">
                <p class="titleForm">Edit roll</p>
                    {!! Form::open(['route' => ['roles.update', $role->id], 'method' => 'PUT', 'class' => '', 'files' => true]) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <div class="portlet-body">
                            <div class="horizontal-form">
                                <div class="form-body bodyForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="name"> <span class="required" aria-required="true">* </span>Name: </label>
                                                {!!Form::text('name',$role->name,['class'=>'form-control', 'placeholder'=>'Insert name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)', 'id'=>'name'])!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe font-green-sharp"></i>
                                                        <span class="caption-subject font-green-sharp bold uppercase">Permissions</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">

                                                        <li class="active">
                                                            <a href="#portlet_tab_1_0" data-toggle="tab" aria-expanded="true">
                                                            Dashboard</a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#portlet_tab_1_1" data-toggle="tab" aria-expanded="true">
                                                            Help desk </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#portlet_tab_1_2" data-toggle="tab" aria-expanded="false">
                                                            Assets </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#portlet_tab_1_3" data-toggle="tab" aria-expanded="false">
                                                            Analytics  </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#portlet_tab_1_4" data-toggle="tab" aria-expanded="false">
                                                            Admin panel  </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body form">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="portlet_tab_1_0">
                                                            <div class="skin skin-minimal">
                                                                @foreach ($categories as $category)
                                                                    @if ( $category->module_category == 5 )
                                                                        <div class="form-body col-md-3">
                                                                            <div class="form-group">
                                                                                <label class=" col-md-4 control-label">{{ $category->display_name}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="icheck-list">
                                                                                        @foreach ($permissions as $permission)
                                                                                            @if ($permission->category_permission_id == $category->id )
                                                                                                <label>
                                                                                                    <div class="icheckbox_flat-grey " style="position: relative;">
                                                                                                        <input type="checkbox" name="permissions_arr[]" value="{{$permission->id}}" {{in_array($permission->id ,old('permissions_arr',[])) ? 'checked' : '' }} class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                                                        </ins>
                                                                                                    </div> {{$permission->name_english}}
                                                                                                </label>
                                                                                            @endif
                                                                                        @endforeach

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="portlet_tab_1_1">
                                                            <div class="skin skin-minimal ">
                                                            {{-- <form class="form-horizontal" role="form" > estas lineas fueron comentadas para el formulario llegara al controlador  --}}
                                                                @foreach ($categories as $category)
                                                                    @if ( $category->module_category == 1 )

                                                                        @if( $category->id == 4 ) <div class="row"> @endif
                                                                            <div class="form-body col-md-3">
                                                                                <div class="form-group">
                                                                                    <label class=" col-md-4 control-label">{{ $category->display_name}}</label>
                                                                                    <div class="input-group">
                                                                                        <div class="icheck-list">
                                                                                            @foreach ($permissions as $permission)
                                                                                                @if ($permission->category_permission_id == $category->id)
                                                                                                    {{-- <div>{{$permission->name}}</div> --}}
                                                                                                    <label>
                                                                                                        <div class="icheckbox_flat-grey " style="position: relative;">
                                                                                                            <input type="checkbox" name="permissions_arr[]" value="{{$permission->id}}" {{in_array($permission->id , old('permissions_arr',[])) ? 'checked' : '' }} {{$permission->active ? 'checked' : '' }}
                                                                                                            class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"> <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> </ins>
                                                                                                        </div> {{$permission->name_english}}
                                                                                                    </label>
                                                                                                @endif
                                                                                             @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @if( $category->id == 4  ) </div>  @endif
                                                                    @endif
                                                                @endforeach
                                                            {{-- </form> --}}
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="portlet_tab_1_2">
                                                            <div class="skin skin-minimal">
                                                            {{-- <form role="form" class="form-horizontal"> --}}
                                                                @foreach ($categories as $category)
                                                                    @if ( $category->module_category == 2 )
                                                                        <div class="form-body col-md-3">
                                                                            <div class="form-group">
                                                                                <label class=" col-md-4 control-label">{{ $category->display_name}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="icheck-list">
                                                                                        @foreach ($permissions as $permission)
                                                                                            @if ($permission->category_permission_id == $category->id)
                                                                                                {{-- <div>{{$permission->name}}</div> --}}
                                                                                                <label>
                                                                                                    <div class="icheckbox_flat-grey " style="position: relative;">
                                                                                                        <input type="checkbox" name="permissions_arr[]" value="{{$permission->id}}" {{in_array($permission->id , old('permissions_arr',[])) ? 'checked' : '' }} {{$permission->active ? 'checked' : '' }}
                                                                                                        class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"> <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> </ins>
                                                                                                    </div> {{$permission->name_english}}
                                                                                                </label>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            {{-- </form> --}}

                                                        </div>

                                                        <div class="tab-pane" id="portlet_tab_1_3">
                                                            <div class="skin skin-minimal">
                                                                {{-- <form role="form " > --}}
                                                                @foreach ($categories as $category)
                                                                    @if ( $category->module_category == 3 )
                                                                        <div class="form-body col-md-3">
                                                                            <div class="form-group">
                                                                                <label class=" col-md-4 control-label">{{ $category->display_name}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="icheck-list">
                                                                                        @foreach ($permissions as $permission)
                                                                                            @if ($permission->category_permission_id == $category->id)
                                                                                                {{-- <div>{{$permission->name}}</div> --}}
                                                                                                <label>
                                                                                                    <div class="icheckbox_flat-grey " style="position: relative;">
                                                                                                        <input type="checkbox" name="permissions_arr[]" value="{{$permission->id}}" {{in_array($permission->id , old('permissions_arr',[])) ? 'checked' : '' }} {{$permission->active ? 'checked' : '' }}
                                                                                                        class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"> <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> </ins>
                                                                                                    </div> {{$permission->name_english}}
                                                                                                </label>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                {{-- </form> --}}
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="portlet_tab_1_4">
                                                            <div class="skin skin-minimal">
                                                            {{-- <form role="form"> --}}
                                                            @foreach ($categories as $category)
                                                                @if ( $category->module_category == 4 )
                                                                    <div class="form-body col-md-3">
                                                                        <div class="form-group">
                                                                            <label class=" col-md-4 control-label">{{ $category->display_name}}</label>
                                                                            <div class="input-group">
                                                                                <div class="icheck-list">
                                                                                    @foreach ($permissions as $permission)
                                                                                        @if ($permission->category_permission_id == $category->id)
                                                                                            {{-- <div>{{$permission->name}}</div> --}}
                                                                                            <label>
                                                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                                                    <input type="checkbox" name="permissions_arr[]" value="{{$permission->id}}" {{in_array($permission->id , old('permissions_arr',[])) ? 'checked' : '' }} {{$permission->active ? 'checked' : '' }}
                                                                                                    class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"> <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> </ins>
                                                                                                </div> {{$permission->name_english}}
                                                                                            </label>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            {{-- </form> --}}
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
                          <div class="col-md-6">
                            <div class="form-group" style="text-align: center;">
                              <button type="submit" class="btn btnFormSave" id="send">Save</button>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group" style="text-align: center;">
                              <a class="btn btnFormCancel" href="{{URL::route('roles.index')}}">Cancel</a>
                            </div>
                          </div>
                        </div>

                    {!!Form::close()!!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

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
          $("#liRoles").addClass("active");
        });
    </script>
@endsection
