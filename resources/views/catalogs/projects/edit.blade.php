@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/project.css") !!}
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
                <a href="{!!URL::to('/catalogs')!!}">Catalogos</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('locations.index')}}">Proyectos</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Editar proyecto</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12" id="">
        {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'PUT', 'id' => 'project_form']) !!}
        @include("catalogs.projects.forms.form")
        {!! Form::close() !!}
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liCatalogs").addClass("active");
        });
    </script>
@endsection
