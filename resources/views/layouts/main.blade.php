@extends('../layouts/base')

@section('body')
    <body class="main">
        @yield('content')

        {{-- SCRIPTS --}}
        <script type="module" src="{{ asset('/build/assets/js/app.6c589841.js')}}"></script>
        
        <script src="{{ asset('build/assets/js/jquery-3.6.4.min.js')}}"></script>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{ asset('build/assets/js/xlsx.full.min.js')}}"></script>
        <script src="{{ asset('build/assets/js/tabulator.min.js')}}" type="text/javascript" ></script>
        <script src="{{ asset('build/assets/js/index.global.min.js')}}" type="text/javascript" ></script>

        <script src="{{ asset('build/assets/js/dual-listbox.min.js')}}"></script>
        @yield('script')

        @include('layouts.components.quitarAlerta')
        
    </body>
@endsection
