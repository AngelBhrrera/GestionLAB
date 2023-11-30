<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Horas Prestador') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/> --}}
    <link rel="icon" href="{{asset('img/recursos/logo.png') }}"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="{{ asset('img/recursos/Logo-CFE.webp') }}" alt="Logo" class="mx-auto d-block" style="max-width: 120px;">
                <a class="navbar-brand" href="{{ url('/')}}">
                    Inicio
                </a>
                {{-- <a class="nav-link" href="{{ route('registroImpresion') }}">
                    Impresión
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(isset(Auth::user()->tipo))
                            @if (Auth::user()->tipo=='clientes')
                                <li><a class="nav-link" href="{{route('cliente.home') }}">Inicio</a></li>
                                <li><a class="nav-link" href="{{ route('cliente.registro') }}">Impresión</a></li>
                                <!--<li><a class="nav-link" href="{{ route('email.impresion') }}">enviar correo</a></li>-->
                                <!--<li><a class="nav-link" href="{{ route('cliente.visitas') }}">Visitas</a></li>-->

                            @endif
                        @endif

                        @if(isset(Auth::user()->tipo))
                            @if (Auth::user()->tipo=='prestador')
                                {{-- <li><a class="nav-link" href="{{route('proyectos') }}">Pendientes</a></li> --}}


                                {{-- <li><a class="nav-link" href="{{route('prestadoresProyectosCompletados') }}">Impresiones Completadas</a></li> --}}
                                {{-- <li><a class="nav-link" href="{{route('Pactividadterminada') }}">Actividades Completadas</a></li> --}}
                                {{-- <li><a class="nav-link" href="{{route('regitro_reporte') }}">Crear Actividad</a></li> --}}
                                {{-- <li><a class="nav-link" href="{{route('actividades_prestadores') }}">Actividades</a></li> --}}
                                <li><a class="nav-link" href="{{route('horario') }}">Horario</a></li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Actividades
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('regitro_reporte') }}">
                                            {{ __('Crear actividad') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividades_prestadores') }}">
                                            {{ __(' Todas mis actividades') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerTodasActividades() }})
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividades_creadas') }}">
                                            {{ __(' Act. creadas') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesCreadas() }})
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividades_en_proceso') }}">
                                            {{ __(' Act. en proceso') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesEnProceso() }})
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividadesTerminadas') }}">
                                            {{ __(' Act. terminadas en revisión') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesEnRevision() }})
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividades_canceladas') }}">
                                            {{ __(' Act. con error') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesConError() }})
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividades_prestadores_revisadas') }}">
                                            {{ __(' Act. revisadas') }} ({{ app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesTerminadas() }})
                                        </a>

                                    </div>
                                </li>
                            @endif
                        @endif

                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->can_admin == 1)
                                    <a class="dropdown-item" href="{{route('admin.cambiorol')}}">
                                        {{ __('Cambiar a admin') }}
                                    </a>
                                    @endif

                                    {{-- <li class="nav-item"> --}}
                                        <a class="dropdown-item" href="{{ route('perfil') }}">{{ __('Mi perfil') }}</a>
                                    {{-- </li> --}}

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
