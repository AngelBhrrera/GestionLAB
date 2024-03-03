@extends('layouts/prestador-layout')

@section('subhead')
    <style>
        .square-box {
            width: 150px; /* Ajusta el ancho a tu preferencia */
            height: 150px; /* Ajusta la altura a tu preferencia */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: 1px solid #ccc; /* Puedes ajustar el estilo del borde */
        }
        .square-box img {
            max-width: 100%; /* Asegura que la imagen se ajuste al contenedor */
            max-height: 100%; /* Asegura que la imagen se ajuste al contenedor */
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Leaderboard</li>
@endsection

@section('subcontent')

<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#filtro-area">Área</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#filtro-sede">Sede</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="filtro-area">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#semanal-area">Semana</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#mensual-area">Mes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#global-area">Todos</a>
            </li>
        </ul>
    </div>
    
    <div class="tab-pane" id="filtro-sede">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#semanal-sede">Semana</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#mensual-sede">Mes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#global-sede">Todos</a>
            </li>
        </ul>
    </div>
</div>

               
                
        <div class="tab-content">
            <div class="tab-pane" id="semanal-area">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoardW as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
            <div class="tab-pane" id="mensual-area">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoardM as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
            <div class="tab-pane" id="global-area">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoard as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
            <div class="tab-pane fade show active" id="semanal-sede">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoardWSede as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
            <div class="tab-pane" id="mensual-sede">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoardMSede as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
            <div class="tab-pane" id="global-sede">
            <ul class="nav nav-tabs nav-justified " role="tablist">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Experiencia</th>
                            <th class="whitespace-nowrap">Semanas</th>
                            <th class="whitespace-nowrap">Rango</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderBoardSede as $top)
                        <tr>
                            <td>{{ $top->Posicion }}</td>
                            <td>
                                <div class="w-10 h-10 image-fit">
                                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{ Auth::user()->name.' '.Auth::user()->apellido }}" 
                                        src="{{ route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false']) }}">
                                </div>
                                {{ $top->Inventor }}
                            </td>
                            <td>{{ $top->total_exp }}</td>
                            <td>{{ $top->semanas_actividad }}</td>
                            <td><img src="{{ asset('build/assets/'.$top->ruta) }}" width="40" height="80" alt=""></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <ul>
            </div>
        </div>

                    
@endsection
