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
                <a href="{!!URL::to('/quotations')!!}">Cotizaciones</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Detalle de Cotización</a>
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
                        <span class="caption-subject bold">Detalle de cotizacón de servicio</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Activo: </label>
                                        <label class="control-label">{{$quotation->incident->asset->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Nombre de cotización: </label>
                                        <label class="control-label">{{$quotation->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label textarea-label">Descripción: </label>
                                        <label class="control-label textarea-content">{{$quotation->description}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Estatus: </label>
                                        <label class="control-label">{{$quotation->getAuthorizationWord()}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Archivo de cotización: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <?php $mime_array = App\Quotation::getFileMime(public_path($quotation->quotation_file)); ?>
                                        @if($mime_array == null)
                                            <h2 class="file-not-found">Archivo no encontrado</h2>
                                        @else
                                            <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                                            @if($file_type == 'image')
                                                <img src="{{$quotation->quotation_file}}" class="quotation-image" alt="">
                                            @else
                                                <div id="icon_file_container">
                                                    <a href="{{$quotation->quotation_file}}" download>
                                                        <img class="file-type-icon"
                                                             src="{{'/images/file_type_icons/' . App\Quotation::getFileTypeIcon($file_extension) . '.png'}}"/>
                                                        </br>Descargar
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
                                        <label class="control-label textarea-label">Comentarios de autorización: </label>
                                        <label class="control-label textarea-content">{{$quotation->comments}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group-container">
                                    <div class="form-group">
                                        <label class="control-label">Partes de incidencia: </label>
                                    </div>
                                </div>
                                <!-- Table parts -->
                                <div class="col-md-12" id="incident_parts_subcontainer">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover order-column" id="datatable_parts">
                                            <thead>
                                            <tr>
                                                <th>Nombre de parte</th>
                                                <th>Precio</th>
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