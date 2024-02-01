<!DOCTYPE html>

    <head>
        @yield('headertype')
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>GESTION LAB INVENTORES</title>
        @yield('head')
        <link href="{{ asset('build/assets/images/inventores.png')}}" rel="shortcut icon">
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('build/assets/css/app.c07cb30e.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/css/app.c469cfb8.css') }}">
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">--}}
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    @yield('body')

</html>
