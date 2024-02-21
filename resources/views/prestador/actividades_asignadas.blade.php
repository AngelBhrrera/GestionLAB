@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('build/assets/css/actividades_asignadas.css')}}">
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="">Actividades</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asignadas</li>
@endsection

@section('subcontent')

    <div class="contenedor-actividades">
    @if(isset($actividades))
        @foreach ($actividades as $actividad)

        <div class="actividad">
            <div class="titulo">{{ $actividad->actividad }}</div>
            <div class="detalle">
                <span class="proyecto">Proyecto:</span> {{ $actividad->proyecto_origen }}
                <br>
                <span class="categoria">Categoría:</span>{{ $actividad->categoria }}<br>
                @if(isset($actividad->TEU))
                    <span class="Subcategoria">Subcategoría:</span> {{ $actividad->subcategoria }}
                @endif
                @if(isset($actividad->TEU))
                    @php
                        $tiempo_en_minutos = $actividad->TEU;
                        $horas = floor($tiempo_en_minutos / 60);
                        $minutos = $tiempo_en_minutos % 60;

                    @endphp
                    <div class="col-md-6">
                        <input name="horas"  style="width: 125px;"  class="form-control sm:w-56" value="{{ $horas . ' h '}}"> 
                        <input name="minutos"  style="width: 125px;" class="form-control sm:w-56" value= "{{ $minutos . ' m '}}" >
                    </div>
                @else
                    <div class="col-md-6">
                        <input name="horas"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                        <input name="minutos"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                    </div>
                    <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                @endif
            </div>
            <div class="detalle">
                <span class="subtitulo">Fecha:</span> {{ $actividad->fecha }}<br>
                <span class="tec">Tiempo Esperado:</span>  
                @php
                    $tiempo_en_minutos = $actividad->TEC;
                    $horas = floor($tiempo_en_minutos / 60);
                    $minutos = $tiempo_en_minutos % 60;
                    echo $horas . " h " . $minutos . " m";
                @endphp
                <br>
                <span class="tr">Tiempo Invertido:</span> {{ $actividad->duracion }}
            </div>
            <div class="detalle botones">
                @if($actividad->estado == 'Asignada')
                    <button class="boton"  onclick="comenzarActividad({{ $actividad->id }})" >Comenzar Actividad</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}" disabled>Terminar Actividad</button>
                @elseif($actividad->estado == 'En Proceso')
                    <button class="boton" onclick="pausarActividad({{ $actividad->id }})" >Pausar Actividad</button>
                    <button class="boton" onclick="terminarActividad({{ $actividad->id }})" >Terminar Actividad</button>
                @elseif($actividad->estado == 'Bloqueada')
                    <button class="boton" onclick="continuarActividad({{ $actividad->id }})">Reaunudar Actividad</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}" disabled>Terminar Actividad</button>
                @else
                    <button class="boton" data-id="{{ $actividad->id }}" disabled>{{ $actividad->estado }}</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}"  disabled>Terminar Actividad</button>
                @endif
            </div>
        </div>
        @endforeach
    @endif
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        function comenzarActividad(idActividad) {

            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`actividadStatus/${idActividad}/${1}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
            })
            .then(response => response.json())
            .then(data => {

                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        } 

        function pausarActividad(idActividad) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`actividadStatus/${idActividad}/${2}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
            })
            .then(response => response.json())
            .then(data => {

                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        } 

        function continuarActividad(idActividad) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`actividadStatus/${idActividad}/${3}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
            })
            .then(response => response.json())
            .then(data => {

                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        } 

        function terminarActividad(idActividad) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`actividadStatus/${idActividad}/${4}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
            })
            .then(response => response.json())
            .then(data => {

                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        } 
    </script>

@endsection