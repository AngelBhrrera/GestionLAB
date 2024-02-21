@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('build/assets/css/actividades_asignadas.css')}}">
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="">Actividades</a></li>
        <li class="breadcrumb-item active" aria-current="page">Abiertas</li>
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
                    <span class="Subcategoria"> {{ $actividad->subcategoria }}</span><br>
                @endif
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
                <span class="tr">Tiempo Invertido:</span> {{ $actividad->duracion }}
                <br>
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
            <div class="detalle botones">
                @if($actividad->estado == 'Asignada')
                    <button class="boton"  onclick="tomarActividad({{ $actividad->id }})" >Tomar Actividad</button>
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

            const horasInput = document.querySelector('input[name="horas"]').value;
            const minutosInput = document.querySelector('input[name="minutos"]').value;

            if (horasInput && minutosInput) {
                const minutos = parseInt(horasInput) * 60 + parseInt(minutosInput);

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

        function pausarActividad(idActividad) {
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

        function continuarActividad(idActividad) {
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