@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
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
                <a href="#">Firmware history </a>
            </li>
        </ul>
    </div>
@endsection --}}

@section("page-content")
    <div class="row content_container paddingForm">
        <div class="col-md-12" id="asset_form_subcontainer">
            <!-- BEGIN NEW ASSET PORTLET-->
            <div class="portlet light portlet-fit bordered">
              <div class="portlet-title topForm">
              </div>
                <div class="portlet-body">
                  <p class="titleForm">Firmware history</p>
                    <div class="horizontal-form firmware-history-asset-data">
                        <div class="form-body bodyForm">
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Equipment ID: </label>
                                        <label class="control-label">{{$asset->asset_custom_id}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Model: </label>
                                        <label class="control-label">{{$asset->model}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Equipment name: </label>
                                        <label class="control-label">{{$asset->name}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Serial number: </label>
                                        <label class="control-label">{{$asset->serial}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="center">Equipment ID </th>
                                <th class="center">Equipment name</th>
                                <th class="center">Previous firmware </th>
                                <th class="center">Updated firmware  </th>
                                <th class="center">Update date </th>
                                <th class="center">Observations</th>
                                <th class="center">Risk</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($asset->firmwares as $firmware)
                            <tr>
                                <td class="center">{{$asset->asset_custom_id}}</td>
                                <td class="center">{{$asset->name}}</td>
                                <td class="center">{{$firmware->previous_firmware}}</td>
                                <td class="center">{{$firmware->firmware}}</td>
                                <td class="center">{{$firmware->date}}</td>
                                <td class="center">{{$firmware->observations}}</td>
                                <td class="center">{{$firmware->risk}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END NEW ASSET PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAssets").addClass("active");
            $("#liAssetsList").addClass("active");

        });

    </script>
@endsection
