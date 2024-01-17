@extends('../layouts/base')

@section('body')
    <body class="main">
        @yield('content')
        <link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}"  rel="stylesheet" >
        <link href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}" rel="stylesheet" >

        <!-- BEGIN: JS Assets-->
        <link rel="preload" as="style" href="{{ asset('/build/assets/app.c07cb30e.css') }}" />
        <link rel="modulepreload" href="{{ asset('/build/assets/app.6c589841.js') }}" />
        <link rel="modulepreload" href="{{ asset('build/assets/_commonjsHelpers.712cc82f.js') }}" />
        <link rel="stylesheet" href="{{ asset('/build/assets/app.c469cfb8.css') }}" />
        <!-- END: JS Assets-->
        @yield('script')
        <script type="module" src="{{ asset('/build/assets/app.6c589841.js')}}"></script>
    </body>
@endsection
