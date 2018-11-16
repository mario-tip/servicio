
    <div class="portlet-body">
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_compartment"><span></span>Compartment : </label>
                            {!! Form::text('location[compartment]', $location->compartment, ['class' => 'form-control',
                            'id' => 'location_compartment']) !!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_floor"><span>*</span>Floor : </label>
                            {{-- Sole == Piso == Tier --}}
                            {!! Form::text('location[floor]', $location->floor, ['class' => 'form-control',
                            'id' => 'location_floor']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_address"><span>*</span>Address : </label>
                            {!! Form::text('location[address]', $location->address, ['class' => 'form-control',
                            'id' => 'location_address']) !!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_area"><span></span>Area : </label>
                            {!! Form::text('location[area]', $location->area, ['class' => 'form-control',
                            'id' => 'location_area']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_building"><span>*</span>Building : </label>
                            {!! Form::text('location[building]', $location->building, ['class' => 'form-control',
                            'id' => 'location_building']) !!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_room"><span></span>Room : </label>
                            {!! Form::text('location[room]', $location->room, ['class' => 'form-control',
                            'id' => 'location_room']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_shelf"><span></span>Shelf : </label>
                            {!! Form::text('location[shelf]', $location->shelf, ['class' => 'form-control',
                            'id' => 'location_shelf']) !!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="location_hall"><span></span>Hall : </label>
                            {!! Form::text('location[hall]', $location->hall, ['class' => 'form-control',
                            'id' => 'location_hall']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label textarea-label" for="location_description"><span>*</span>Description : </label>
                            {!! Form::textarea('location[description]', $location->description, ['rows' => '10', 'class' => 'form-control',
                            'id' => "location_description"]) !!}
                        </div>
                    </div>
                    <div class="col-md-6 form-group-container">
                        <div class="form-group">
                            <label class="control-label textarea-label" for="location_notes"><span></span>Notes : </label>
                            {!! Form::textarea('location[notes]', $location->notes, ['rows' => '10', 'class' => 'form-control',
                            'id' => "location_notes"]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions col-sm-offset-5">
        <button class="btn btn-circle green-meadow" id="save_location">Save</button>
        <a class="btn btn-circle red" href="{{route('locations.index')}}">Cancel</a>
    </div>
