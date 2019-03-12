<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Iniciar sesión</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    {!! Html::style('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}

    {!! Html::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('assets/global/plugins/fontawesome-free-5.4.1/css/fontawesome.min.css') !!}
    {!! Html::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
    {!! Html::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    {!! Html::style('assets/global/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
    {!! Html::style('assets/global/css/components-rounded.min.css') !!}
    {!! Html::style('assets/global/css/plugins.min.css') !!}
    {!! Html::style('assets/pages/css/login2.css') !!}
    {!! Html::style('assets/layouts/layout2/css/custom.css') !!}

    <link rel="shortcut icon" href="favicon.ico" />
</head>

<body class=" login">

    {{-- <div class="logo">
      <a href="#">
        <img src="images/Logo_3.png" alt=""  style="height: 6em;"/>
      </a>
    </div> --}}

    <div class="content">
        @yield('content')
    </div>

    <div class="copyright"> @php echo date("Y"); @endphp &copy; Altatec de Occidente SA de CV </div>

    {!! Html::script('assets/global/plugins/respond.min.js') !!}
    {!! Html::script('assets/global/plugins/excanvas.min.js') !!}
    {!! Html::script('assets/global/plugins/ie8.fix.min.js') !!}

    {!! Html::script('assets/global/plugins/jquery.min.js') !!}
    {!! Html::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('assets/global/plugins/js.cookie.min.js') !!}
    {!! Html::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('assets/global/plugins/jquery.blockui.min.js') !!}
    {!! Html::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

    {!! Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
    {!! Html::script('assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
    {!! Html::script('assets/global/plugins/select2/js/select2.full.min.js') !!}

    {!! Html::script('assets/global/scripts/app.min.js') !!}
    {!! Html::script('assets/pages/scripts/login.min.js') !!}
</body>
</html>
