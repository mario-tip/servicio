@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/slick_slider/slick.css") !!}
    {!! Html::style("/assets/css/slick_slider/slick-theme.css") !!}
    {!! Html::style("/assets/css/asset.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/actives')!!}">Activos</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Detalle de Activo</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN NEW ASSET PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Información general</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Id de activo: </label>
                                        <label class="control-label">{{$asset->asset_custom_id}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de compra: </label>
                                        <label class="control-label">{{$asset->adquisition_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Nombre de activo: </label>
                                        <label class="control-label">{{$asset->name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Costo: </label>
                                        <label class="control-label" id="asset_cost">{{'$' . $asset->cost}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Modelo: </label>
                                        <label class="control-label">{{$asset->model}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Condición: </label>
                                        <label class="control-label">{{$asset->condition}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Número de serie: </label>
                                        <label class="control-label">{{$asset->serial}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Estatus: </label>
                                        <label class="control-label">{{$asset->status}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Marca: </label>
                                        <label class="control-label">{{$asset->brand}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Persona: </label>
                                        <label class="control-label">{{$asset->person->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Descripción: </label>
                                        <label class="control-label textarea-content">{{$asset->description}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de vencimiento: </label>
                                        <label class="control-label">{{$asset->expires_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Proveedor: </label>
                                        <?php $provider = ($asset->provider != null) ? $asset->provider->name : null; ?>
                                        <label class="control-label">{{$provider}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Referencia de compra: </label>
                                        <label class="control-label">{{$asset->purchase_order}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Cliente: </label>
                                        <label class="control-label">{{!empty($asset->customers) ? $asset->customers->name : ''}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END NEW ASSET PORTLET-->

            <!-- BEGIN ASSET'S PARTS PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Información adicional</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Mantenimiento: </label>
                                        <label class="control-label">{{$asset->maintenance_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Notas: </label>
                                        <label class="control-label textarea-content">{{$asset->notes}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Fotos: </label>
                                        <label class="control-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="asset-images-carousel" style="margin: 0 auto">
                                    @foreach($asset->images as $image)
                                    <img src="{{Config::get('constants.assets_system_url') . $image->path}}"/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ASSET'S PARTS PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!!Html::script("/assets/scripts/jquery.number.js")!!}
    {!!Html::script("/assets/scripts/slick.min.js")!!}
    {!!Html::script("/assets/scripts/asset.js")!!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#asset_cost').number(true, 2);

            /*Asset images slider*/
            $('.asset-images-carousel').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
            });

        });
    </script>
@endsection
