@extends("layouts.master")

@section("styles")
    {!! Html::style("/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
    {!! Html::style("/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! Html::style("/assets/global/plugins/datatables/datatables.min.css") !!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/asset.css") !!}
@endsection

@section('breadcrumb')
    <div class="page-bar">
        <div id="errors_container"></div>
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
                <a>Nuevo Activo</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12" id="asset_form_subcontainer">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            {!! Form::open(['id' => 'asset_form', 'data-method' => 'POST']) !!}
                <!-- BEGIN NEW ASSET PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold">Nuevo activo</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="horizontal-form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_custom_id">Id de activo: </label>
                                            {!! Form::text('asset[asset_custom_id]', $asset->asset_custom_id, ['class' => 'form-control', 'id' => 'asset_custom_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_adquisition_date_container"><span>*</span>Fecha de compra: </label>
                                            <div class="date-picker-container">
                                                <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="asset_adquisition_date_container">  {{--Removed class input-group, and data-date-start-date="+0d"--}}
                                                    {!! Form::text('asset[adquisition_date]', $asset->adquisition_date, ['class' => 'form-control',
                                                    'id' => 'asset_adquisition_date', 'readonly']) !!}
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_name"><span>*</span>Nombre de activo: </label>
                                            {!! Form::text('asset[name]', $asset->name, ['class' => 'form-control', 'id' => 'asset_name']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_cost"><span>*</span>Costo: </label>
                                            {!! Form::text('asset[cost]', $asset->cost, ['class' => 'form-control', 'id' => 'asset_cost',
                                            'onkeypress' => 'return validateInput(event, 5)', 'placeholder' => '0.00']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_model"><span>*</span>Modelo: </label>
                                            {!! Form::text('asset[model]', $asset->model, ['class' => 'form-control', 'id' => 'asset_model']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_condition"><span>*</span>Condición: </label>
                                            {!!Form::select('asset[condition]',['1' => 'Nuevo','2' => 'Usado'], $asset->condition, ['class' => 'bs-select form-control', 'id' => 'asset_condition', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_serial"><span>*</span>Número de serie: </label>
                                            {!! Form::text('asset[serial]', $asset->serial, ['class' => 'form-control', 'id' => 'asset_serial']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_model_status"><span>*</span>Estatus: </label>
                                            {!!Form::select('asset[status]', ['0' => 'Inactivo','1' => 'Activo'], $asset->status, ['class' => 'bs-select form-control', 'id' => 'asset_status', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_brand"><span>*</span>Marca: </label>
                                            {!! Form::text('asset[brand]', $asset->brand, ['class' => 'form-control', 'id' => 'asset_brand']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_person_id"><span>*</span>Persona: </label>
                                            {!!Form::select('asset[person_id]', $dependencies['persons'], $asset->person_id, ['class' => 'bs-select form-control', 'id' => 'asset_person_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label"><span>*</span>Ubicación: </label>
                                            {!!Form::select('asset[location_id]', $dependencies['locations'], $location_id, ['class' => 'bs-select form-control', 'id' => 'asset_location_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group datepicker-group">
                                            <label class="control-label" for="asset_expires_date"><span></span>Fecha de vencimiento: </label>
                                            <div class="date-picker-container">
                                                <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="asset_expires_date">
                                                    {!! Form::text('asset[expires_date]', $asset->expires_date, ['class' => 'form-control', 'id' => 'asset_expires_date', 'readonly']) !!}
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label textarea-label" for="asset_description"><span>*</span>Descripción: </label>
                                            {!! Form::textarea('asset[description]', $asset->description, ['rows' => '10', 'class' => 'form-control', 'id' => 'asset_description']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_provider_id"><span></span>Proveedor: </label>
                                            {!!Form::select('asset[provider_id]', $dependencies['providers'], $asset->provider_id, ['class' => 'bs-select form-control', 'id' => 'asset_provider_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_customer_id">Cliente: </label>
                                            {!!Form::select('asset[customer_id]', $dependencies['customers'], $asset->customer_id, ['class' => 'bs-select form-control', 'id' => 'asset_customer_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_purchase_order"><span></span>Referencia de compra: </label>
                                            {!! Form::text('asset[purchase_order]', $asset->purchase_order, ['class' => 'form-control', 'id' => 'asset_purchase_order']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_project_id"><span></span>Proyecto: </label>
                                            {!! Form::select('asset[project_id]', $dependencies['projects'], $asset->project_id, ['class' => 'bs-select form-control', 'id' => 'asset_project_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_barcode"><span>*</span>Código de barras: </label>
                                            {!! Form::text('asset[barcode]', $asset->barcode, ['class' => 'form-control', 'id' => 'asset_barcode']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group-container">
                                        <div class="form-group">
                                            <label class="control-label" for="asset_subcategory_id"><span>*</span>Subcategoria: </label>
                                            {!! Form::select('asset[subcategory_id]', $dependencies['subcategories'], $asset->subcategory_id, ['class' => 'bs-select form-control', 'id' => 'asset_subcategory_id', 'title' => 'Seleccionar...']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END NEW ASSET PORTLET-->
                @include("assets.forms.form")
            {!! Form::close() !!}
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section("scripts")
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js") !!}
    {!! Html::script("/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! Html::script("/assets/pages/scripts/components-bootstrap-select.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/pages/scripts/table-datatables-scroller.min.js") !!}
    {!! Html::script("/assets/scripts/jquery.number.js") !!}
    {!! Html::script("/assets/scripts/validateFields.js") !!}
    {!! Html::script("/assets/scripts/asset.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAssets").addClass("active");
            $('#asset_cost').number(true, 2);
        });
    </script>
@endsection
