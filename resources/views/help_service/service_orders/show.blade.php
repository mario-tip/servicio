@extends("layouts.master")

@section("styles")
{{--{!! Html::style("/assets/css/main.css") !!}--}}
{!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
{!! Html::style("/assets/css/service_order.css") !!}
{!! Html::style("/assets/global/plugins/jcrop/css/jquery.Jcrop.min.css") !!}
{!! Html::style("/assets/pages/css/image-crop.css") !!}
{{-- <link href="../../assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/> --}}

@endsection

@section('breadcrumb')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{!!URL::to('/')!!}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{!!URL::to('/service-orders')!!}">View services</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a>Detail service</a>
        </li>
    </ul>
</div>
@endsection

@section("page-content")
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SHOW SERVICE ORDER PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject bold font-gray">Detail service</span>
                    </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet red-hazard box">
                            <div class="portlet-title">

                                <div class="caption">
                                    <i class="icon-magnifier"></i>Order Details
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-5 name">Order # :</div>
                                    <div class="col-md-7 value">
                                        {{$service_order->folio}} <span class="label label-success label-sm">
                                        Email confirmation was sent </span>
                                    </div>
                                </div>
                                @if ($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Who registered :</div>
                                    <div class="col-md-7 value">
                                        {{$service_order->incident->person->name}} 
                                    </div>
                                </div>
                                @endif

                               

                                <div class="row static-info">
                                    <div class="col-md-5 name">Asset ID :</div>
                                    <div class="col-md-7 value">
                                        @if($service_order->type == 0)
                                        {{$service_order->incident->asset->asset_custom_id}}
                                        @else
                                        {{$service_order->maintenance->asset->asset_custom_id}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">Asset name :</div>
                                    <div class="col-md-7 value">
                                        @if($service_order->type == 0)
                                        {{$service_order->incident->asset->name}}
                                        @else
                                        {{$service_order->maintenance->asset->name}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">Brand :</div>
                                    <div class="col-md-7 value">
                                        @if($service_order->type == 0)
                                        {{$service_order->incident->asset->brand}}
                                        @else
                                        {{$service_order->maintenance->asset->brand}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">Serie :</div>
                                    <div class="col-md-7 value">
                                        @if($service_order->type == 0)
                                        {{$service_order->incident->asset->serial}}
                                        @else
                                        {{$service_order->maintenance->asset->serial}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                            Order Date :
                                    </div>
                                    <div class="col-md-7 value">
                                            {{$service_order->date}}
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        Order Time :
                                    </div>
                                    <div class="col-md-7 value">
                                        {{$service_order->time}}
                                    </div>
                                </div>

                                @if($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Suggested attention date :</div>
                                    <div class="col-md-7 value">
                                        {{$service_order->incident->suggested_date}}
                                    </div>
                                </div>
                                @else
                                @endif

                                @if($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Suggested attention hour :</div>
                                    <div class="col-md-7 value">
                                    {{$service_order->incident->suggested_time}}
                                    </div>
                                </div>
                                @endif

                                <div class="row static-info">
                                    <div class="col-md-5 name">Service type :</div>
                                    <div class="col-md-7 value">
                                    @if($service_order->type == 0)
                                        {{App\Incident::getTypeWord($service_order->incident->type)}}
                                    @else
                                        {{App\Maintenance::getTypeWord($service_order->maintenance->type)}}
                                    @endif
                                    </div>
                                </div>

                                <div class="row static-info">
                                    <div class="col-md-5 name">Order Status:</div>
                                    <div class="col-md-7 value">
                                        @if ($service_order->getStatusWord() == "Pending")
                                            <span class="label label-sm label-info">
                                                                        {{$service_order->getStatusWord()}} </span>
                                        @else
                                            <span class="label label-sm label-success">
                                                                        {{$service_order->getStatusWord()}} </span>
                                        @endif
                                    </div>
                                </div>
                                @if($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Priority :</div>
                                    <div class="col-md-7 value">
                                        @if (\App\Incident::getPriorityWord($service_order->incident->priority) == "High")
                                            <span class="label label-sm label-hazard">
                                            {{\App\Incident::getPriorityWord($service_order->incident->priority)}}
                                            </span>
                                        @elseif (\App\Incident::getPriorityWord($service_order->incident->priority)== "Medium")
                                            <span class="label label-sm label-danger">
                                            {{\App\Incident::getPriorityWord($service_order->incident->priority)}}
                                            </span>
                                        @else
                                            <span class="label label-sm label-warning">
                                            {{\App\Incident::getPriorityWord($service_order->incident->priority)}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @else
                                
                                @endif
                                @php
                                    // dd($service_order->maintenance->asset->locations[0]);
                                @endphp
                                <div class="row static-info">
                                    <div class="col-md-5 name">Location :</div>
                                    <div class="col-md-7 value">
                                        @if($service_order->type == 0)
                                        {{$service_order->incident->asset->locations[0]->address}}
                                        @else
                                        {{$service_order->maintenance->asset->locations[0]->address}}
                                        @endif
                                    </div>
                                </div>

                                @if($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Description :</div>
                                    <div class="col-md-7 value">
                                    {{$service_order->incident->description}}
                                    </div>
                                </div>
                                @endif

                                @if($service_order->type == 0)
                                <div class="row static-info">
                                    <div class="col-md-5 name">Evidence :</div>
                                    <div class="col-md-7 value">
                                        <div class="row">
                                            <div class="col-md-12 form-group-container">
                                                <div class="form-group">
                                                    <?php
                                                    $mime_array = App\Quotation::getFileMime(public_path($service_order->incident->evidence_file));
                                                    ?>
                                                    @if($mime_array == null)
                                                        <h2 class="file-not-found">Not found file </h2>
                                                    @else
                                                        <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                                    @if($file_type == 'image')
                                                        <img src="{{'/' . $service_order->incident->evidence_file}}" class="incident-image img-responsive" alt="">
                                                    @else
                                                        <div id="icon_file_container">
                                                            <a href="{{'/' . $service_order->incident->evidence_file}}" download>
                                                                <img class="file-type-icon  "
                                                                    src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}"/>
                                                                </br>Download
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row static-info">
                                    <div class="col-md-5 name">Additional notes :</div>
                                    <div class="col-md-7 value">
                                            {{$service_order->notes}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-6 col-sm-12">
                    <div class="portlet green-meadow box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-earphones-alt"></i>Attention detail
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-5 name">
                                        Technician :
                                </div>
                                <div class="col-md-7 value">
                                        {{$service_order->technician->name}}
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name">
                                        Comments:
                                </div>
                                <div class="col-md-7 value">
                                        {{$service_order->comments}}
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-5 name">
                                        {{$service_order->getIncidentTypeWord()}} <a href="#"></a>uthorized by :
                                </div>
                                <div class="col-md-7 value">
                                        {{!is_null($service_order->authorizer) ? $service_order->authorizer->name : null}}
                                </div>
                            </div>
                                
                            <div class="row static-info">
                                <div class="col-md-5 name">
                                        Signature:
                                </div>
                                <div class="col-md-7 value">
                                    <div class="row">
                                    <div class="col-md-12 form-group-container">
                                        <div class="form-group">
                                            @if(is_null($service_order->signature))
                                                <h2 class="file-not-found">Service order without signature </h2>
                                            @else
                                                <img src="{{'/' . $service_order->signature}}" class=" img-responsive incident-image" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($service_order->type == 0)
            <div class="row">
                    <div class="col-md-6 col-sm-12">
  										<div class="portlet grey-gallery box">
  											<div class="portlet-title">

  												<div class="caption">
  													<i class="icon-magnifier"></i>Service quote detail
  												</div>
  											</div>
  											<div class="portlet-body">
                          @if(!is_null($service_order->quotation))
                            <div class="row static-info">
    													<div class="col-md-5 name">Quote name : </div>
    													<div class="col-md-7 value">{{$service_order->quotation->name}}</div>
    												</div>

                            <div class="row static-info">
    													<div class="col-md-5 name">Description :</div>
    													<div class="col-md-7 value">
    														 {{$service_order->quotation->description}}
    													</div>
    												</div>

                            <div class="row static-info">
    													<div class="col-md-5 name">Status :</div>
    													<div class="col-md-7 value">
    														 {{$service_order->quotation->getAuthorizationWord()}}
    													</div>
    												</div>

                            <div class="row static-info">
    													<div class="col-md-5 name">File quotation :</div>
    													<div class="col-md-7 value">
                                <div class="row">
                                    <div class="col-md-12 form-group-container">
                                        <div class="form-group">
                                            <?php
                                            $mime_array = App\Quotation::getFileMime(public_path($service_order->quotation->quotation_file));
                                            ?>
                                            @if($mime_array == null)
                                                <h2 class="file-not-found">Not foun file </h2>
                                            @else
                                                <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                                @if($file_type == 'image')
                                                    <img src="{{$service_order->quotation->quotation_file}}" class="incident-image  img-responsive" alt="">
                                                @else
                                                    <div id="icon_file_container">
                                                        <a href="{{$service_order->quotation->quotation_file}}" download>
                                                            <img class="file-type-icon"
                                                                src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}"/>
                                                            </br>Download
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
    													</div>
    												</div>

                            <div class="row static-info">
  													<div class="col-md-5 name">Authorization comments :</div>
  													<div class="col-md-7 value">
  														 {{$service_order->quotation->comments}}
  													</div>
  												</div>
                          @else
                          <h2 class="quotation-not-found">The service has no quotation</h2>
                          @endif
                          <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Incident parts : </label>
                                    </div>
                                </div>
                                <!-- Table parts -->
                                <div class="col-md-12" id="incident_parts_subcontainer">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover order-column datatable-parts">
                                            <thead>
                                                <tr>
                                                    <th>Part name </th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($service_order->type == 0)
                                                @foreach($service_order->incident->parts as $part)
                                                    <tr>
                                                        <td>{{$part->name}}</td>
                                                        <td>{{$part->price}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Table parts -->
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
                </div>
            </div>
            @endif
            <!-- END SHOW SERVICE ORDER PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/scripts/jquery.number.js")!!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/service_order_show.js")!!}
    {!! Html::script("/assets/global/plugins/jcrop/js/jquery.color.js")!!}
    {!! Html::script("/assets/global/plugins/jcrop/js/jquery.Jcrop.min.js")!!}

    <script type="text/javascript">
        $(document).ready(function() {
            $("#liHelpDesk").addClass("active");
            $("#liServiceOrders").addClass("active");


           /* $('#asset_cost').number(true, 2);*/
        });
    </script>
@endsection
