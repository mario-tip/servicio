<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Nombre de parte:</label>
                <div class="col-sm-7">
                    {!!Form::text('name',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'name'])!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Número de parte:</label>
                <div class="col-sm-7">
                    {!!Form::text('number',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'number'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Precio:</label>
                <div class="col-sm-7">
                    {!!Form::text('price',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'price'])!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Descripción:</label>
                <div class="col-sm-7">
                    {!!Form::textarea('description',null,['class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>"off", 'id'=>'description'])!!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn btn-circle green-meadow" id="send">Guardar</button>
    <a class="btn btn-circle red" href="{{URL::route('parts.index')}}">Cancelar</a>
</div>
