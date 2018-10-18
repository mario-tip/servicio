<!-- BEGIN NEW LOCATION PORTLET-->
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold">Nuevo proyecto</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12 form-group-container">
                        <div class="form-group">
                            <label class="control-label" for="project_name"><span>*</span>Nombre de proyecto: </label>
                            {!! Form::text('project[name]', $project->name, ['class' => 'form-control',
                            'id' => 'project_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group-container">
                        <div class="form-group">
                            <label class="control-label textarea-label" for="project_description"><span>*</span>Descripción: </label>
                            {!! Form::textarea('project[description]', $project->description, ['rows' => '10', 'class' => 'form-control',
                            'id' => "project_description"]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions col-sm-offset-5">
        <button class="btn green-meadow" id="save_project">Guardar</button>
        <a class="btn red" href="{{route('projects.index')}}">Cancelar</a>
    </div>
</div>
<!-- END NEW LOCATION PORTLET-->