@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/location.css") !!}
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
                <a href="{{route('locations.index')}}">Locations</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">New location</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12" id="">
        {!! Form::open(['route' => 'locations.store', 'method' => 'POST', 'id' => 'location_form']) !!}
        <!-- BEGIN EDIT LOCATION PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-blue-600"></i>
                        <span class="caption-subject bold font-blue-600">New location</span>
                    </div>
                </div>
                @include("catalogs.locations.forms.form")
            </div><!-- END EDIT LOCATION PORTLET-->
        {!! Form::close() !!}
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liTools").addClass("active");
            $("#liLocations").addClass("active");

        });
    </script>
@endsection
