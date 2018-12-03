@extends("layouts.master")
@section("styles")

  {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
  {!! Html::style("/assets/css/asset.css") !!}

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
                <a>Edit user</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
          {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'id' => 'user_form']) !!}
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-pencil font-blue-200"></i>
                        <span class="caption-subject bold font-blue-200">Edit user</span>
                    </div>
                </div>
                <div class="portlet-body">
                  @include("users.forms.form")
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
          {!!Form::close()!!}
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
          $("#liUsers").addClass("active");
        });
    </script>
@endsection
