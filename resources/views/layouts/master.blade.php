<!DOCTYPE html>

<!-- HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Admin</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports"
          name="description"/>
    <meta content="" name="author"/>

    @include('partials.style')
    @yield('styles')

    <link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">

    @include('partials.header')

            <!-- BEGIN CONTAINER -->
    <div class="clearfix"> </div>
    <div class="page-container">

        @include('partials.sidebar')

                <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                @yield('breadcrumb')

                @yield('page-content')
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2017 &copy; Messoft Systems</div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->


@include('partials.script')
@yield('scripts')

</body>

</html>