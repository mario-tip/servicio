@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/slick_slider/slick.css") !!}
    {!! Html::style("/assets/css/slick_slider/slick-theme.css") !!}
    {!! Html::style("/assets/css/asset.css") !!}
@endsection

{{-- @section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/actives')!!}">Assets</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a>Detail asset</a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")
    <div class="row paddingForm">
        <div class="col-md-12">
            <!-- BEGIN NEW ASSET PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <div class="portlet-body">
                  <p class="titleForm">Detail asset</p>
                    <div class="horizontal-form">
                        <div class="form-body bodyForm">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Asset Id : </label>
                                        <label class="control-label">{{$asset->asset_custom_id}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Date of purchase : </label>
                                        <label class="control-label">{{$asset->adquisition_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Asset name : </label>
                                        <label class="control-label">{{$asset->name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Price: </label>
                                        <label class="control-label" id="asset_cost">{{'$' . $asset->cost}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Model: </label>
                                        <label class="control-label">{{$asset->model}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">State : </label>
                                        <label class="control-label"> {{ $asset->condition == 1 ? "New" : "Used" }}  </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Serial number : </label>
                                        <label class="control-label">{{$asset->serial}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Status: </label>
                                        <label class="control-label">{{ $asset->serial == 1 ? "Inactive" : "Active" }}</label>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Brand: </label>
                                        <label class="control-label">{{$asset->brand}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Person: </label>
                                        <label class="control-label">{{$asset->person->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Description: </label>
                                        <label class="control-label textarea-content">{{$asset->description}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Expiration date: </label>
                                        <label class="control-label">{{$asset->expires_date}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Provider: </label>
                                        <?php $provider = ($asset->provider != null) ? $asset->provider->name : null; ?>
                                        <label class="control-label">{{$provider}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Purchase reference : </label>
                                        <label class="control-label">{{$asset->purchase_order}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Customer: </label>
                                        <label class="control-label">{{!empty($asset->customers) ? $asset->customers->name : ''}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Barcode: </label>
                                        <label class="control-label">{{$asset->barcode }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END NEW ASSET PORTLET-->

            <!-- BEGIN ASSET'S PARTS PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <div class="portlet-body">
                  <p class="titleForm">Additional information</p>
                    <div class="horizontal-form">
                        <div class="form-body bodyForm">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Maintenance : </label>
                                        <label class="control-label">{{$asset->maintenance_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Notes : </label>
                                        <label class="control-label textarea-content">{{$asset->notes}}</label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Picture : </label>
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
                            </div> --}}

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
          $("#liAssets").addClass("active");
          $("#liAssetsList").addClass("active");

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
