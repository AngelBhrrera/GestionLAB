@extends('layouts/app')

@section('content')

    <head>
        <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
        <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
        <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
        <link rel="stylesheet" href={{ asset('css/dobletabla.css') }}>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <div class="container">

        @if (Auth::user()->horario)
            <h1 class="text-center">Horario: {{ Auth::user()->horario }}</h1>


        @else
            <h1 class="text-center">No tienes horario</h1>
        @endif



        {{-- <form method="POST" action="{{ route('horario_guardar') }}">

            @csrf

            <div class="row justify-content-center">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">

                        <h5 class="text-center">Selecciona tu horario</h5>

                        <select class="form-control" name="horario">



                            <option value="vespertino">vespertino</option>
                            <option value="matutino">matutino</option>
                            <option value="tiempo_completo">tiempo_completo</option>
                            <option value="sabados">sabados</option>

                        </select>
                        <br>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>

                    </div>

                </div>

            </div>

        </form> --}}

    </div>





    </div>
@endsection

<script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
<script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('dist/js/adminlte.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('plugins/datatables/jquery.dataTables.min.js') }}></script>
<script src={{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
<script src={{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>
