@extends("layouts.master")
@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/css/roles.css") !!}
    {!!Html::style("/assets/global/plugins/icheck/skins/all.css")!!}
    {{-- {!!Html::style("/assets/global/plugins/jstree/dist/themes/default/style.min.css")!!} --}}

@endsection

@section('breadcrumb')
    <div class="page-bar">
        @include('partials.request')
        {{-- <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/roles')!!}">Roles</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/roles/create')!!}">New roll</a>
            </li>
        </ul> --}}
    </div>
@endsection

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
              <div class="portlet-body">
                <p class="titleForm">New roll</p>
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        @include("roles.forms.form")
                    {!!Form::close()!!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")

    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/global/plugins/icheck/icheck.min.js") !!}
    {{-- {!! Html::script("/assets/global/plugins/jstree/dist/jstree.min.js") !!} --}}


    <script type="application/javascript">
        $(document).ready(function(){
          $("#liTools").addClass("active");
          $("#liRoles").addClass("active");


        });
    </script>
@endsection
