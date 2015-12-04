@if ($systemMessage)
    {{$systemMessage}}
@endif
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Page title -->
    <title>后台登录</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ url('/statics/vendor/fontawesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ url('/statics/vendor/metisMenu/dist/metisMenu.css') }}" />
    <link rel="stylesheet" href="{{ url('/statics/vendor/animate.css/animate.css') }}" />
    <link rel="stylesheet" href="{{ url('/statics/vendor/bootstrap/dist/css/bootstrap.css') }}" />

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('/statics/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ url('/statics/fonts/pe-icon-7-stroke/css/helper.css') }}" />
    <link rel="stylesheet" href="{{ url('/statics/styles/style.css') }}">

</head>
<body class="blank">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Responsive Admin Theme</h1><p>Special AngularJS Admin Theme for small and medium webapp with very clean and aesthetic style and feel. </p><img src="{{ url('/statics/images/loading-bars.svg') }}" width="64" height="64" /> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line"></div>

<!-- <div class="pull-left m">
    <a href="index.html" class="btn btn-primary">Back to Dashboard</a>
</div> -->

<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>DOLLARS</h3>
                <!-- <small>The key we've lost.</small> -->
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <form action="/admin/login" id="loginForm" method="post">
                            <div class="form-group">
                                <label class="control-label" for="username">用户名</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="name" id="username" class="form-control">
                                <!-- <span class="help-block small">Your unique username to app</span> -->
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">密码</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <!-- <span class="help-block small">Yur strong password</span> -->
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="remember" value="1" class="i-checks">
                                     记住密码
                                <!-- <p class="help-block small">(if this is a private computer)</p> -->
                            </div>
                            <button class="btn btn-success btn-block">登录</button>
                            <!-- <a class="btn btn-default btn-block" href="#">Register</a> -->
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <strong>DOLLARS</strong> - Umbrella Sheltering Your Family. <br/> 2015 Copyright Xizi.com
        </div>
    </div>
</div>

</div>

</div>

<!-- Vendor scripts -->
<script src="{{ url('/statics/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('/statics/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ url('/statics/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('/statics/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/statics/vendor/metisMenu/dist/metisMenu.min.js') }}"></script>
<script src="{{ url('/statics/vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ url('/statics/vendor/sparkline/index.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('/statics/scripts/homer.js') }}"></script>

</body>
</html>
