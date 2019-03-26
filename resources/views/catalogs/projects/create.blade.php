@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/project.css") !!}
@endsection

{{-- @section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <a href="{{route('projects.index')}}">Projects</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">New project</a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")

  <div class="row content_container paddingForm">
      <div class="col-md-12" id="">
      {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'id' => 'project_form']) !!}
      <!-- BEGIN NEW LOCATION PORTLET-->
          <div class="portlet light portlet-fit bordered">
            <div class="portlet-title topForm">
            </div>
              <p class="titleForm">New project</p>
              @include("catalogs.projects.forms.form")
          </div>
          <!-- END NEW LOCATION PORTLET-->
      {!! Form::close() !!}
      </div>
  </div>


    {{-- <div class="row content_container">
        <div class="col-md-12" id="">
        {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'id' => 'project_form']) !!}
        @include("catalogs.projects.forms.form")
        {!! Form::close() !!}
        </div>
    </div> --}}

@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liTools").addClass("active");
            $("#liProjects").addClass("active");


        });
    </script>
@endsection
