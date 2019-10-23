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
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('library/alertifyjs/css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('library/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">



    {{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"> --}}

    @yield('stylesheets')
    @yield('head')
</head>
<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Skynet</strong>
            <div class="pull-right hidden-xs">
                <b>Versión</b> 1.0.0-beta
            </div>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>

   <!-- Scripts -->
   <script src="{{ mix('js/app.js') }}"></script>
   <script src="{{ asset('library/alertifyjs/alertify.min.js') }}"></script>
    @yield('scripts')
    @include('layouts.partials.alertify')

</body>
</html>
