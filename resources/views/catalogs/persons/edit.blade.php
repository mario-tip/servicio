@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/css/person.css") !!}
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
                <a href="{{route('persons.index')}}">People</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
              <a href="#">Edit person</a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12" id="">
        {!! Form::model($person, ['route' => ['persons.update', $person->id], 'method' => 'PUT', 'id' => 'person_form']) !!}
            <input name="id" type="hidden" value="{{$person->id}}">
        <!-- BEGIN NEW LOCATION PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title topForm">
                </div>
                  <p class="titleForm">Edit person</p>
                @include("catalogs.persons.forms.form")
            </div>
            <!-- END NEW LOCATION PORTLET-->
        {!! Form::close() !!}
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liTools").addClass("active");
            $("#liPeople").addClass("active");

        });
    </script>
@endsection
