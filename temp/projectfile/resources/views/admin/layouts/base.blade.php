<!DOCTYPE html>
<html>
    <head>
        <!-- Page title -->
        <title>DOLLARS - @yield('panel-title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ url('/statics/vendor/fontawesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/vendor/metisMenu/dist/metisMenu.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/vendor/animate.css/animate.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/vendor/bootstrap/dist/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css') }}" />

        <!-- App styles -->
        <link rel="stylesheet" href="{{ url('/statics/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/fonts/pe-icon-7-stroke/css/helper.css') }}" />
        <link rel="stylesheet" href="{{ url('/statics/styles/style.css') }}">

    </head>
    <body>
      @include('admin.partials.header')
      @include('admin.partials.sidebar')
        <div id="wrapper">

            @include('admin.partials.breadcrumb')
            @yield('content')

        </div>

        <!-- Vars -->
        <script>
            var STATICS_PATH = '{{ url("/statics/") }}';
            var IMG_PATH = '{{ url("/statics/images/") }}';
            var FAKE_API = 'http://192.168.0.97:3000';
        </script>
        <!-- Vendor scripts -->
        <script src="{{ url('/statics/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/jquery.toggleattr.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/metisMenu/dist/metisMenu.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/iCheck/icheck.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/sparkline/index.js') }}"></script>
        <script src="{{ url('/statics/vendor/do.min.js') }}" data-cfg-autoload="false"></script>
        <script src="{{ url('/statics/vendor/html5Validate/jquery-html5Validate.js') }}"></script>

        <script src="{{ url('/statics/vendor/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/bootstrap-confirmation/bootstrap-confirmation.js')}}"></script>

        <script src="{{ url('/statics/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ url('/statics/vendor/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>

        <!-- App scripts -->
        <script src="{{ url('/statics/scripts/homer.js') }}"></script>
        <script src="{{ url('/statics/scripts/modules.js') }}"></script>
        <script src="{{ url('/statics/scripts/xz_admin.js') }}"></script>
        <script src="{{ url('/statics/scripts/charts.js') }}"></script>
        @yield('page-js')
    </body>
</html>
