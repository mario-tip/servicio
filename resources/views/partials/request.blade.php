@if(count($errors)>0)
    <div class="custom-alerts alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{!!$error!!}</li>
            @endforeach
        </ul>
    </div>
@endif