<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Skynet</title>
    <link rel="shortcut icon" href="{{ asset('img/skynet.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('library/alertifyjs/css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('library/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body{
            background-color:  black !important;
            background-size: 100% auto !important;
            height: 0;
        }
        @media only screen and (max-width: 915px) {
            body {
                background: #d2d6de !important;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('library/alertifyjs/alertify.min.js') }}"></script>
    @include('layouts.partials.alertify')
</html>
