@extends('layouts.login_layout')

<!-- Main Content -->
@section('content')
{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
</div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
  {{ csrf_field() }}

  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

      @if ($errors->has('email'))
      <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
      @endif
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <button type="submit" class="btn btn-primary">
        Send Password Reset Link
      </button>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>
</div>--}}

<!-- BEGIN FORGOT PASSWORD FORM -->
<div class="panel">
  <div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
      {{ csrf_field() }}
      <h3>Reset your password</h3>
      <p> Enter your email address and we will send you a link to reset your password. </p>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="input-icon">
          <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Enter your email address" name="email" value="{{ old('email') }}" required /> </div>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-actions">
        <a href="{{ url('/login') }}" id="back-btn" class="uppercase btn btn-login btn-outline">Back</a>
        <button type="submit" class="uppercase btn btn-login pull-right"> Send </button>
      </div>
    </form>
  </div>
</div>

<!-- END FORGOT PASSWORD FORM -->
@endsection
