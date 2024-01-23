@extends('../layouts/base')

@section('body')
    <body class="main">
        @yield('content')

        {{-- ESTILOS --}}

        <link rel="modulepreload" href="{{ asset('build/assets/js/app.6c589841.js') }}">
        <link rel="modulepreload" href="{{ asset('build/assets/js/_commonjsHelpers.712cc82f.js') }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

        {{-- SCRIPTS --}}
        <script type="module" src="{{ asset('/build/assets/app.6c589841.js')}}"></script>
        <script src="{{ asset('build/assets/js/jquery-3.6.4.min.js')}}"></script>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- <script src="{{ asset('dist/js/adminlte.min.js') }}"></script> --}}

        <script src="{{ asset('build/assets/js/moment.min.js')}}"></script>
        <script src="{{ asset('build/assets/js/xlsx.full.min.js')}}"></script>
        <script src="{{ asset('build/assets/js/tabulator.min.js')}}" type="text/javascript" ></script>

        {{-- componentes necesarios para que funcione el dualistbox --}}
        <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

        @yield('script')
        
    </body>
@endsection
