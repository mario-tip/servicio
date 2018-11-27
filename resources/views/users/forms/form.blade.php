<div class="form-body">
    <div class="form-group">
        <label for="name" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Name:</label>
        <div class="col-sm-7">
            {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Ingresar tu nombre completo', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)', 'id'=>'name'])!!}
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Email:</label>
        <div class="col-sm-7">
            {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Ingresar correo electrónico', 'autocomplete'=>"off", 'id'=>'email'])!!}
            <p class="color" id="alertEmail" style="color: red;"></p>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> Password:</label>
        <div class="col-sm-7">
            {{Form::password('password', ['class' => 'form-control', 'id' => 'user_password', 'autocomplete' => 'off'])}}
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-md-4 control-label"><span class="required" aria-required="true"> * </span> User:</label>
        <div class="col-sm-7">
            {!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Ingresar nombre de usuario', 'autocomplete'=>"off", 'onkeypress'=>'validateInput(event, 1)'])!!}
        </div>
    </div>
</div>

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn green-meadow circle" id="send">Save</button>
    <a class="btn red circle" href="{{URL::route('users.index')}}">Cancel</a>
</div>
