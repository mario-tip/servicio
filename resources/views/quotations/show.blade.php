@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/quotation.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/quotations')!!}">Quotations</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Detail quotation</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row">
        <div class="col-md-12">
            <!-- QUOTATION DETAILS PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-eye font-gray"></i>
                        <span class="caption-subject bold font-gray">Detail quotation</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Asset: </label>
                                        <label class="control-label">{{$quotation->incident->asset->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Name quotation: </label>
                                        <label class="control-label">{{$quotation->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Description: </label>
                                        <label class="control-label textarea-content">{{$quotation->description}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Status: </label>
                                        <label class="control-label">{{$quotation->getAuthorizationWord()}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">File quotation: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <?php $mime_array = App\Quotation::getFileMime(public_path($quotation->quotation_file)); ?>
                                        @if($mime_array == null)
                                            <h2 class="file-not-found">Not found file</h2>
                                        @else
                                            <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                            @if($file_type == 'image')
                                                <img src="{{$quotation->quotation_file}}" class="quotation-image" alt="">
                                            @else
                                                <div id="icon_file_container">
                                                    <a href="{{$quotation->quotation_file}}" download>
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
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Notes authorization: </label>
                                        <label class="control-label textarea-content">{{$quotation->comments}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Incident parts :</label>
                                    </div>
                                </div>
                                <!-- Table parts -->
                                <div class="col-md-12" id="incident_parts_subcontainer">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover order-column" id="datatable_parts">
                                            <thead>
                                            <tr>
                                                <th>Part name</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotation->parts as $part)
                                                <tr>
                                                    <td>{{$part->name}}</td>
                                                    <td class="currency-format">{{$part->price}}</td>
                                                </tr>
                                            @endforeach
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
            <!-- END QUOTATION DETAILS PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/jquery.number.js") !!}
    {!! Html::script("/assets/scripts/quotation.js") !!}
    <script type="text/javascript">
        $(document).ready(function() {
          $("#liHelpDesk").addClass("active");
          $("#liServiceOrders").addClass("active");


            $('#asset_cost').number(true, 2);

            $('#datatable_parts').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false,
                "bInfo": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                }
            });
        });
    </script>
@endsection
