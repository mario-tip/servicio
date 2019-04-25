@extends("layouts.master")

@section("styles")

@endsection

@section('breadcrumb')
@include('partials.message')
{{-- <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
              <a href="{!!URL::to('/incidents')!!}">Event log </a>
            </li>
        </ul>
    </div> --}}
@endsection

@section("page-content")
<div class="row content_container paddingForm">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit bordered">
      <div class="portlet-title topForm">
      </div>
      <p class="titleForm">Profile</p>
      <div class="portlet-body">
        <div class="form-body bodyForm">
          <form method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="avatar-upload">
                          <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                          </div>
                          <div class="avatar-preview">
                            <img class="profile-pic" id="imagePreview" src="https://stylesatlife.com/wp-content/uploads/2018/02/Hairstyles-For-Oval-Face-Men-1.jpg">
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <label for="name" class="control-label permisos">Nivel de permisos:</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <label for="name" class="control-label nombrePermisos">Administrador</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group profile">
                  <label class="subtitleFormProfile">Change password</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Current password:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">New password:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name" class="control-label">Confirm password:</label>
                        {!!Form::text('asset_custom_id',null,['class'=>'form-control activos', 'placeholder'=>'', 'autocomplete'=>"off", 'id' => 'asset_custom_id'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btnFormSaveProfile">Change password</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>

@endsection

@section("scripts")
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imagePreview').attr('src', e.target.result);
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload").change(function() {
    readURL(this);
  });
</script>

@endsection
