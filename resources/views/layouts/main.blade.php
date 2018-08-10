<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý dân cư - Paraline</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/avata.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('css/admin/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/skin.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/icheck.min.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
{{--<div id="ajaxloader3" >--}}
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
<div class="wrapper">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=454145418122073";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <header class="main-header">
        @include('layouts.header')
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        @include('layouts.sidebar')
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        @include ('layouts.footer')
    </footer>
</div>
<!-- ./wrapper -->

</body>
</html>
