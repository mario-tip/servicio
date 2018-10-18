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
                <a href="{!!URL::to('/catalogs')!!}">Catalogos</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('providers.index')}}">Proveedores</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Editar proveedor</a>
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
                        <span class="caption-subject bold">Editar proveedor</span>
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
            $("#liCatalogs").addClass("active");
        });
    </script>
@endsection
