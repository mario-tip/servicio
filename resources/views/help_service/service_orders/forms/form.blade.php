<!-- BEGIN NEW ASSET PORTLET-->
<div class="portlet-body">
    <div class="horizontal-form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">who registered : </label>
                        <label class="control-label">{{$incident->person->name}}</label>
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label" for="service_order_user_id"><span>*</span>Responsible resolution : </label>
                        {!!Form::select('service_order[user_id]', $dependencies['technicians'], null,
                        ['class' => 'bs-select form-control', 'id' => 'service_order_user_id', 'title' => 'Select...']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Asset : </label>
                        <label class="control-label">{{$incident->asset->name}}</label>
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Brand: </label>
                        <label class="control-label">{{$incident->asset->brand}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Asset ID: </label>
                        <label class="control-label">{{$incident->asset->asset_custom_id}}</label>
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Location: </label>
                        <label class="control-label">{{$incident->asset->locations[0]->address}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Linea: </label>
                        <label class="control-label">{{$incident->asset->equipment->name}}</label>
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label textarea-label">Affected parties: </label>
                        <div class="damaged-parts">
                            @foreach($incident->parts as $part)
                                <span>{{$part->name}}</span></br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label">Serie: </label>
                        <label class="control-label">{{$incident->asset->serial}}</label>
                    </div>
                </div>
                <div class="col-md-6 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label textarea-label">Description : </label>
                        <div class="incident-description">
                            {{$incident->description}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 form-group-container">
                    <div class="form-group datepicker-group">
                        <label class="control-label form-label" for="service_order_date"><span>*</span>Date: </label>
                        <div class="date-picker-container">
                            <div class="input-medium date date-picker" data-date-format="dd-mm-yyyy" id="service_order_date">{{--Removed class input-group, and data-date-start-date="+0d"--}}
                                {!! Form::text('service_order[date]', null, ['class' => 'form-control', 'id' => 'service_order_date', 'readonly', 'role' => 'button']) !!}
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-group-container">
                    <div class="form-group timepicker-group">
                        <label class="control-label form-label" for="service_order_time"><span>*</span>Hour: </label>
                        <div class="input-group time-picker-container">
                            {!! Form::text('service_order[time]', null, ['class' => 'form-control timepicker timepicker-24 input-medium', 'readonly', 'role' => 'button']) !!}
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-11 form-group-container">
                    <div class="form-group">
                        <label class="control-label form-label textarea-label" for="service_order_notes"><span></span>Notes: </label>
                        {!! Form::textarea('service_order[notes]', null, ['rows' => '10', 'class' => 'form-control', 'id' => 'service_order_notes']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <label class="control-label">Evidence: </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group-container">
                    <div class="form-group">
                        <?php
                            $mime_array = App\Quotation::getFileMime(public_path($incident->evidence_file));
                        ?>
                        @if($mime_array == null)
                            <h2 class="file-not-found">Not found archive </h2>
                        @else
                            <?php $file_type = $mime_array[0]; $file_extension = $mime_array[1]; ?>
                            @if($file_type == 'image')
                            <img src="{{'/' . $incident->evidence_file}}" class="incident-image" alt="">
                            @else
                            <div id="icon_file_container">
                                <a href="{{'/' . $incident->evidence_file}}" download>
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
</div>
<!-- END NEW ASSET PORTLET-->

<div class="form-actions col-sm-offset-5">
    <button type="submit" class="btn btn-circle green-meadow" id="save_asset">Save </button>
    <a class="btn btn-circle red" href="{!!URL::route('incidents.index')!!}">Cancel</a>
</div>
