<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Paraline') }}</title> --}}

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/icon.icon') }}" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/icheck.min.js') }}"></script>

</head>
<body class="hold-transition login-page">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=454145418122073";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
{{--<div id="ajaxloader3" style="display: none;">--}}
    {{--<div class="outer"></div>--}}
    {{--<div class="inner"></div>--}}
{{--</div>--}}
<div id="loading" >
    <div class="sk-folding-cube">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>
</div>
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">Laravel <b>Login</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <!-- Show errors -->
        @include('notification.error')
        <p class="login-box-msg">{{ config('app.name', 'Paraline') }}</p>
        {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}
            <div class="form-group has-feedback">
                {!! Form::email('email', null, ['placeholder' => 'Email']) !!}
                <i class="fa fa-envelope form-ctl-feedback" aria-hidden="true"></i>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password', ['placeholder' => 'Password']) !!}
                <i class="fa fa-lock form-ctl-feedback" aria-hidden="true" ></i>
            </div>
            <div class="row">
                <div class="col remember">
                    <div class="checkbox icheck">
                        <label class="">
                            <div class="icheckbox_square-blue has-feedback" aria-checked="false" aria-disabled="false">
                            <input type="checkbox">
                            <ins class="iCheck-helper"></ins></div> Remember me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col submit">
                    {!! Form::button('Sign in', ['type'=>'submit', 'class'=>'btn btn-flat btn-login']) !!}
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="{{ URL::to('auth/google') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>
        <!-- /.social-auth-links -->
    </div>
  <!-- /.login-box-body -->
</div>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>

    jQuery('#ajaxloader3').hide();
    jQuery('#loading').hide();
</script>
</body>
</html>