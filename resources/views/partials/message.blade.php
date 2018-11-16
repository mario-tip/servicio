@if(Session::has('message'))
    <div class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('message')}}
    </div>
@endif