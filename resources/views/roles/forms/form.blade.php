<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="name"> <span class="required" aria-required="true"> * </span>Name: </label>
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Insert name', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)', 'id'=>'name'])!!}
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
                                    <a href="#portlet_tab_1_1" data-toggle="tab" aria-expanded="true">
                                    help desk </a>
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
                                <div class="tab-pane active" id="portlet_tab_1_1">
                                    <div class="skin skin-minimal ">        
                                        {{-- <form class="form-horizontal" role="form" > estas lineas fueron comentadas para el formulario llegara al controlador  --}} 
                                            <div class="form-body col-md-3">
                                                <div class="form-group">
                                                    <label class=" col-md-4 control-label">Incidents</label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="listar_registro_incidencias" 
                                                                    @if(is_array(old('permissions')) && in_array('listar_registro_incidencias', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Show list 
                                                            </label>

                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="crear_registro_incidencias" 
                                                                    @if(is_array(old('permissions')) && in_array('crear_registro_incidencias', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Create 
                                                            </label>

                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="editar_registro_incidencias" 
                                                                    @if(is_array(old('permissions')) && in_array('editar_registro_incidencias', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Edit 
                                                            </label>

                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="eliminar_registro_incidencias" 
                                                                    @if(is_array(old('permissions')) && in_array('eliminar_registro_incidencias', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Delete 
                                                            </label>

                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="generar_orden_servicios" 
                                                                    @if(is_array(old('permissions')) && in_array('generar_orden_servicios', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div>Order service
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body col-md-3">
                                                <div class="form-group">
                                                    <label class=" col-md-4 control-label">Quotation Service</label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="listar_cotizacion_servicios" 
                                                                    @if(is_array(old('permissions')) && in_array('listar_cotizacion_servicios', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div>Show list 
                                                            </label>
                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="crear_cotizacion_servicios" 
                                                                    @if(is_array(old('permissions')) && in_array('crear_cotizacion_servicios', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Show list 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                                <div class="tab-pane" id="portlet_tab_1_2">
                                    <div class="skin skin-minimal">
                                        {{-- <form role="form" class="form-horizontal"> --}}
                                            <div class="form-body col-md-3">
                                                <div class="form-group">
                                                    <label class=" col-md-4 control-label">Asset list </label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Show list  </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey checked" style="position: relative;"><input type="checkbox" checked="" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Create </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Edit  </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Show  </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Update Firmware  </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> History Firmware  </label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="form-body col-md-3">
                                                    <div class="form-group">
                                                        <label class=" col-md-4 control-label">Asset list </label>
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Show list  </label>
                                                                <label>
                                                                <div class="icheckbox_flat-grey checked" style="position: relative;"><input type="checkbox" checked="" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Create </label>
                                                                <label>
                                                                <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Edit  </label>
                                                                <label>
                                                                <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Show  </label>
                                                                <label>
                                                                <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Update Firmware  </label>
                                                                <label>
                                                                <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> History Firmware  </label>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                                <div class="tab-pane" id="portlet_tab_1_3">
                                    <div class="skin skin-flat">
                                        {{-- <form role="form " > --}}
                                            <div class="form-body">
                                                <div class="form-group ">
                                                    <label>Checkbox List</label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Checkbox 1 </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey checked" style="position: relative;"><input type="checkbox" checked="" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Checkbox 2 </label>
                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Checkbox 3 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                                <div class="tab-pane" id="portlet_tab_1_4">
                                    <div class="skin skin-line">
                                        {{-- <form role="form"> --}}
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Checkbox List</label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">

                                                            <label>
                                                                <div class="icheckbox_flat-grey " style="position: relative;">
                                                                    <input name="permissions[]" value="Permiso4" 
                                                                    @if(is_array(old('permissions')) && in_array('Permiso4', old('permissions'))) checked @endif 
                                                                    type="checkbox"  class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;">

                                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                    </ins>
                                                                </div> Checkbox 2 
                                                            </label>


                                                            <label>
                                                            <div class="icheckbox_flat-grey" style="position: relative;"><input type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Checkbox 3 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn green-meadow circle" id="send">Save</button>
    <a class="btn red circle" href="{{URL::route('roles.index')}}">Cancel</a>
</div>
