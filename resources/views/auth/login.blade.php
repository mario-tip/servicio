@extends('layouts.login_layout')

@section('content')
{{--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

  <div class="col-md-6">
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

    @if ($errors->has('email'))
    <span class="help-block">
      <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
  <label for="password" class="col-md-4 control-label">Password</label>

  <div class="col-md-6">
    <input id="password" type="password" class="form-control" name="password" required>

    @if ($errors->has('password'))
    <span class="help-block">
      <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
      </label>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-8 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      Login
    </button>

    <a class="btn btn-link" href="{{ url('/password/reset') }}">
      Forgot Your Password?
    </a>
  </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>--}}
<div class="panel">
  <div class="panel-body">
    <div class="logo">
      <a href="#">
        <img class="img-responsive" src="images/AntCMMS.png" alt="" style="width:220px; display: inherit;" />
      </a>
    </div>
    <form class="login-form" action="{{ url('/login') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{csrf_token()}}">
      <div class="form-title">
        <span class="form-title">Sign in</span>
      </div>

      <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Introduce tu correo electrónico y contraseña. </span>
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Enter your username</label>
        <div class="form-title-div-label">
          <span class="form-title-label">Username</span>
        </div>
        <div class="input-icon">
          {{-- <i class="fa fa-envelope"></i> --}}
          <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Enter your username" name="email" value="{{ old('email') }}" required />
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="form-title-div-label">
          <span class="form-title-label">Password</span>
        </div>
        <div class="input-icon">
          {{-- <i class="fa fa-lock"></i> --}}
          <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Enter your password" name="password" />
          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <label class="container-checkbox">Remember me
          <input type="checkbox">
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-login btn-outline btn-block  uppercase">Sign in</button>
        {{--<label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />Remember
                <span></span>
            </label>--}}
        <br>
        <a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">Forgot password?</a>
      </div>
      {{--<div class="login-options">
            <h4>Or login with</h4>
            <ul class="social-icons">
                <li>
                    <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                </li>
            </ul>
        </div>--}}
      {{--<div class="create-account">
            <p>
                <a href="{{ url('/register') }}" id="register-btn" class="uppercase">Crear una cuenta</a>
      </p>
  </div>--}}
  </form>
</div>
</div>
@endsection
