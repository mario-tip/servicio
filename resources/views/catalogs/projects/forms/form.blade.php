<!-- BEGIN NEW LOCATION PORTLET-->

    <div class="portlet-body">
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="project_name"><span>*</span>Name project: </label>
                            {!! Form::text('project[name]', $project->name, ['class' => 'form-control',
                            'id' => 'project_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group-container">
                        <div class="form-group">
                            <label class="control-label textarea-label" for="project_description"><span>*</span>Description: </label>
                            {!! Form::textarea('project[description]', $project->description, ['rows' => '10', 'class' => 'form-control',
                            'id' => "project_description"]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions col-sm-offset-5">
        <button class="btn btn-circle green-meadow" id="save_project">Save</button>
        <a class="btn btn-circle red" href="{{route('projects.index')}}">Cancel</a>
    </div>

<!-- END NEW LOCATION PORTLET-->
