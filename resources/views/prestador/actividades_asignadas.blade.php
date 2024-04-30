@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('build/assets/css/actividades_asignadas.css')}}">
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('actHub')}}">Actividades</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asignadas</li>
@endsection

@section('subcontent')

<div>

    @if (!$activo)
        <div class="alert alert-danger-soft show flex items-center mb-2" role="alert">
            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> Para iniciar actividades debes hacer Check-in
        </div>
    @endif
    
    <div class="contenedor-actividades">
    @if(isset($actividades))
        @if (count($actividades)==0)
            <h3 class="text-xl font-medium leading-none">No tienes ninguna actividad asignada ☹ </h3>
        @endif
        @foreach ($actividades as $actividad)

        <div class="actividad">
            <div class="titulo">{{ $actividad->actividad }}
            <button class="boton-azul"  onclick="verDetalles({{ $actividad->actividad_id }})">+</button>
            </div>
            <div class="detalle">
            <span class="subtitulo">Proyecto:</span> {{ $actividad->proyecto_origen }}
                <br>{{ $actividad->categoria }} | </span>
                @if(isset($actividad->subcategoria))
                    <span class="Subcategoria"> {{ $actividad->subcategoria }}</span>
                @endif
                <br>
                <span class="subtitulo">Premio disponible:</span>
                <br>
                <span class="subtitulo">Fecha:</span> {{ $actividad->fecha }} 
            </div>
            <div class="detalle">
                <br>
                <span class="tr">Tiempo Invertido:</span> 
                @php
                    $tiempo_en_minutos = $actividad->duracion;
                    $horas = floor($tiempo_en_minutos / 60);
                    $minutos = $tiempo_en_minutos % 60;
                    echo $horas . " h " . $minutos . " m";
                @endphp
                <br>
                @if(isset($actividad->TEU))
                    @php
                        $tiempo_en_minutos = $actividad->TEU;
                        $horas = floor($tiempo_en_minutos / 60);
                        $minutos = $tiempo_en_minutos % 60;
                    @endphp
                    <div class="col-md-6">
                        <input id= "horas_{{ $actividad->id }}" name="horas_{{ $actividad->id }}"  style="width: 125px;"  type="text" disabled class="form-control sm:w-56" value="{{ $horas . ' h '}}"> 
                        <input id= "minutos_{{ $actividad->id }}" name="minutos_{{ $actividad->id }}"  style="width: 125px;" type="text" disabled class="form-control sm:w-56" value= "{{ $minutos . ' m '}}" >
                    </div>
                @else
                    <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                    <div class="col-md-6">
                        <input id="horas_{{ $actividad->id }}" name="horas_{{ $actividad->id }}" style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1">
                        <input id="minutos_{{ $actividad->id }}" name="minutos_{{ $actividad->id }}" style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1">
                    </div>
                @endif
                @if($actividad->estado == 'En Proceso')
                    <br>
                    <label for="detalles">Comentario (motivo de pausa)</label>
                    <input class="form-control" type="text" name="detalles" id="detalles" placeholder="Comentario">
                @endif
            </div>
            <div class="detalle botones">
                @if($actividad->estado == 'Asignada' || $actividad->estado == 'Creada')
                    <button class="boton"  onclick="comenzarActividad({{ $actividad->id }})" >Comenzar Actividad</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}" disabled>Terminar Actividad</button>
                @elseif($actividad->estado == 'En Proceso')
                    <button class="boton" onclick="pausarActividad({{ $actividad->id }})" >Pausar Actividad</button>
                    <button class="boton" onclick="terminarActividad({{ $actividad->id }})" >Terminar Actividad</button>
                @elseif($actividad->estado == 'Bloqueada')
                    <button class="boton" onclick="continuarActividad({{ $actividad->id }})">Reaunudar Actividad</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}" disabled>Terminar Actividad</button>
                @elseif($actividad->estado == 'Error')
                    <button class="boton" onclick="continuarActividad({{ $actividad->id }})">Reaunudar Actividad</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}" disabled>Actividad devuelta con error</button>
                @else
                    <button class="boton" data-id="{{ $actividad->id }}" disabled>{{ $actividad->estado }}</button>
                    <button class="boton boton-inactivo" data-id="{{ $actividad->id }}"  disabled>Terminar Actividad</button>
                @endif
            </div>
        </div>
        @endforeach
    @endif
    </div>
</div>
@endsection

@section('script')

    <script type="text/javascript">

    function validate(h, m) {

        console.log(h);
        console.log(m);
    
        if ((h >= 0 && m >= 1)||(h >= 1 && m >= 0)) {
            return true;
        }else{
            return false;
        }
    }


        function comenzarActividad(idActividad) {

            var id = idActividad;
            var nH = "horas_"+id;
            var nM = "minutos_"+id;
            const horasInput = document.getElementById(nH);
            const minutosInput = document.getElementById(nM);

            check = validate(parseInt(horasInput.value),parseInt(minutosInput.value));

            if (check) {
                if (!horasInput.value) {
                    var minutos = parseInt(minutosInput.value);
                } else if (!minutosInput.value) {
                    var minutos = parseInt(horasInput.value) * 60;
                } else {
                    var minutos = parseInt(horasInput.value) * 60 + parseInt(minutosInput.value);
                }
                
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`comenzarActividad/${idActividad}/${minutos}`, {
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
            } else {
                alert('Por favor, ingrese las horas y los minutos.');
            }
        } 

        function continuarActividad(idActividad) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`actividadStatus/${idActividad}/${1}/Reanudada`, {
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
            const detallesInput = document.getElementById('detalles');
            if(detallesInput.value==""){
                alert("Ingresa un motivo de pausa de la actividad");
            }else{
                var comentario = detallesInput.value;
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`actividadStatus/${idActividad}/${2}/${comentario}`, {
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
        } 

        function terminarActividad(idActividad) {
            const detallesInput = document.getElementById('detalles');
            if(detallesInput.value==""){
                alert("Ingresa un comentario para terminar");
            }else{
                var comentario = detallesInput.value;
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`actividadStatus/${idActividad}/${3}/${comentario}`, {
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
                    $('#alerta').html('<div class="intro-y col-span-12 lg:col-span-6"><h6 class="alert alert-danger">' + errorMessage + '</h6></div>');
                    console.error('Error en activacion:', error);
                });
            }
        } 


        function verDetalles(idActividad) {
                window.location.href = "detalles_actividad/" + idActividad;
        }

    </script>

@endsection