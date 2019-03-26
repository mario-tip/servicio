<!-- BEGIN NEW LOCATION PORTLET-->

<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label" for="project_name"><span class="required" aria-required="true">* </span>Name project: </label>
            {!! Form::text('project[name]', $project->name, ['class' => 'form-control',
            'id' => 'project_name']) !!}
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label textarea-label" for="project_description"><span class="required" aria-required="true">* </span>Description: </label>
            {!! Form::textarea('project[description]', $project->description, ['size' => '30x5', 'class' => 'form-control',
            'id' => "project_description"]) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <button class="btn btnFormSave" id="save_project">Save</button>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" style="text-align: center;">
      <a class="btn btnFormCancel" href="{{route('projects.index')}}">Cancel</a>
    </div>
  </div>
</div>

<!-- END NEW LOCATION PORTLET-->
