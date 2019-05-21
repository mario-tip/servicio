<!-- BEGIN NEW LOCATION PORTLET-->

<div class="portlet-body">
  <div class="horizontal-form">
    <div class="form-body bodyForm">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="project_name"><span class="required" aria-required="true">* </span>Project ID: </label>
            {!! Form::text('project[id_project]', $project->id_project, [
            'class' => 'form-control',
            'id' => 'project_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="project_name"><span class="required" aria-required="true">* </span>Name project: </label>
            {!! Form::text('project[name]', $project->name, [
            'class' => 'form-control',
            'id' => 'project_name'
            ]) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label textarea-label" for="project_description"><span class="required" aria-required="true">* </span>Description: </label>
            {!! Form::textarea('project[description]', $project->description, [
            'size' => '30x2',
            'class' => 'form-control',
            'id' => "project_description"
            ]) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="inputEmail1"> Email: </label>
            {!!Form::text('project[email]', $project->email, [
            'class'=>'form-control',
            'autocomplete'=>"off",
            'id'=>'email'
            ])!!}
            <p class="color" id="alertEmail" style="color: red;"></p>
          </div>
        </div>
      </div>

      {{-- <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="project_name"><span class="required" aria-required="true">* </span>Phone: </label>
            {!! Form::text('project[phone]', $project->phone, [
            'class' => 'form-control',
            'id' => 'project_name'
            ]) !!}
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="control-label" for="project_name"><span class="required" aria-required="true">* </span>Contract name: </label>
            {!! Form::text('project[name_contract]', $project->name_contract, [
            'class' => 'form-control',
            'id' => 'project_name'
            ]) !!}
          </div>
        </div>
        <div class="col-md-6" id="dates_container">
          <div class="form-group col-md-6" id="dates_sub_container">
            <label class="control-label">Contract time</label>
            <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
              <span class="input-group-addon">Start </span>
              {!! Form::text('project[start_contract]', $project->start_contract, ['class' => 'form-control date-input', 'id' => 'start_contract']) !!}

              <span class="input-group-addon">End </span>
              {!! Form::text('project[end_contract]', $project->end_contract, ['class' => 'form-control date-input', 'id' => 'end_contract']) !!}
            </div>
          </div>
        </div>
      </div> --}}


      {{-- <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="control-label"><span class="required" aria-required="true">* </span>Person:</label>
            {!! Form::select('project[person_id]', $depende['persons'], $project->person_id, ['class' => 'bs-select form-control','id' => 'person_id', 'title' => 'Select...'])!!}

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="control-label"><span class="required" aria-required="true">* </span>Location:</label>
            {!! Form::select('project[location_id]', $depende['locations'], $project->location_id, ['class' => 'bs-select form-control', 'title' => 'Select...'])!!}
          </div>
        </div>
      </div> --}}

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
