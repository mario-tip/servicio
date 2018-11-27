@extends("layouts.master")
@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
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
                <a href="{!!URL::to('/users')!!}">Users</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/users/create')!!}">New user</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-blue-200"></i>
                        <span class="caption-subject bold font-blue-200">New user</span>
                    </div>
                </div>
                <div class="portlet-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        @include("users.forms.form")
                    {!!Form::close()!!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/validateFields.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liUsr").addClass("active");
        });
    </script>
@endsection
