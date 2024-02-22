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
                <span class="subtitulo">Fecha:</span> {{ $actividad->fecha }} 
            </div>
            <div class="detalle">
                <span class="tec">Tiempo Esperado:</span>  
                @php
                    $tiempo_en_minutos = $actividad->TEC;
                    $horas = floor($tiempo_en_minutos / 60);
                    $minutos = $tiempo_en_minutos % 60;
                    echo $horas . " h " . $minutos . " m";
                @endphp
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
                    <div class="col-md-6">
                        <input id = "horas_{{ $actividad->id }}" name="horas_{{ $actividad->id }}"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" >
                        <input id= "minutos_{{ $actividad->id }}" name="minutos_{{ $actividad->id }}"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" >
                    </div>
                    <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                @endif
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

        var id = idActividad;

        var nH = "horas_"+id;
        var nM = "minutos_"+id;
        const horasInput = document.getElementById(nH);
        const minutosInput = document.getElementById(nM);

            if (horasInput.value || minutosInput.value) {

                if(!horasInput.value){
                    fixedHoras = 0;
                    var minutos = parseInt(minutosInput.value);
                }
                if(!minutosInput.value){
                    fixedMinutos = 0;
                    var minutos = parseInt(horasInput.value) * 60;
                }else{
                    var minutos = parseInt(horasInput.value) * 60 + parseInt(minutosInput.value);
                }

                console.log(minutos);
                
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`startAct/${idActividad}/${minutos}`, {
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

        function terminarActividad(idActividad) {
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


        function verDetalles(idActividad) {
                window.location.href = "detalles_actividad/" + idActividad;
        }


    </script>

@endsection