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
        <link href="{{ asset('build/assets/app.c07cb30e.css') }}" rel="stylesheet">
        <link href="{{ asset('build/assets/app.c469cfb8.css') }}" rel="stylesheet">
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    @yield('body')

</html>
