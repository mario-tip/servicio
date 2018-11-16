@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/css/customer.css") !!}
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
                <a href="{{route('providers.index')}}">Suppliers</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Edit supplier</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12" id="">
        {!! Form::model($provider, ['route' => ['providers.update', $provider->id], 'method' => 'PUT', 'id' => 'provider_form']) !!}
        <!-- BEGIN NEW LOCATION PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-pencil font-blue"></i>
                        <span class="caption-subject bold font-blue">Edit supplier</span>
                    </div>
                </div>
                @include("catalogs.providers.forms.form")
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
            $("#liSuppliers").addClass("active");

        });

    </script>
@endsection
