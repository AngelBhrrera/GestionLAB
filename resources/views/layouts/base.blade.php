<!DOCTYPE html>

    <head>
        @yield('headertype')
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>GESTION LAB INVENTORES</title>
        <link href="{{ asset('build/assets/images/Inventores.png')}}" rel="shortcut icon">
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('build/assets/css/dual-listbox.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/css/app.c07cb30e.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/css/app.c469cfb8.css') }}">
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="modulepreload" href="{{ asset('build/assets/js/app.6c589841.js') }}">
        <link rel="modulepreload" href="{{ asset('build/assets/js/_commonjsHelpers.712cc82f.js') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        @yield('head')
    </head>
    <!-- END: Head -->
    @yield('body')

</html>
