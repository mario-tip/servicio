<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label" for="equipment_name"><span>*</span>Nombre de equipo: </label>
                        {!! Form::text('equipment[name]', $equipment->name, ['class' => 'form-control',
                        'id' => 'equipment_name']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="select2-group">
                        <label class="control-label" for="equipment_parts"><span></span>Agregar partes: </label>
                        <select id="part_select" class="form-control select2"></select>
                        <a class="btn green-meadow" id="add_part">Agregar</a>
                    </div>
                </div>
            </div>
            <div class="row" id="equipment_parts_container">
                <div class="col-md-12" id="parts_subcontainer">
                    <table class="table table-striped table-bordered table-hover" id="datatable_parts">
                        <thead>
                            <tr>
                                <th>Nombre de parte</th>
                                <th>Número de parte</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($equipment->parts) > 0)
                            @foreach($equipment->parts as $part)
                            <tr>
                                <td>{{$part->name}}</td>
                                <td>{{$part->number}}</td>
                                <td><span class="currency-format">{{$part->price}}</span></td>
                                <td>{{$part->description}}</td>
                                <td>
                                  <a class="btn btn-icon-only red icon-delete">
                                      <i class="fa fa-trash-o"></i>
                                  </a>
                                  <input name="parts[]" type="hidden" value="{{$part->id}}"/>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button class="btn green-meadow" id="save_equipment">Guardar</button>
    <a class="btn red" href="{!!URL::route('equipments.index')!!}">Cancelar</a>
</div>
