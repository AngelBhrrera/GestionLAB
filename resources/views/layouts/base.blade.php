<!DOCTYPE html>
<!--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class = '.dark'>
 BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('build/assets/images/inventores.png')}}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rocketman admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rocketman Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    
    @yield('head')

    <!-- BEGIN: CSS Assets-->

    
    <link href="{{ asset('build/assets/app.c07cb30e.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/app.c469cfb8.css') }}" rel="stylesheet">
    
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

</html>
