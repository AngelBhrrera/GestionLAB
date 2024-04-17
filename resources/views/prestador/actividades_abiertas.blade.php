@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('build/assets/css/actividades_asignadas.css')}}">
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('actHub')}}">Actividades</a></li>
        <li class="breadcrumb-item active" aria-current="page">Abiertas</li>
@endsection

@section('subcontent')

    @if (!$activo)
        <div class="alert alert-danger-soft show flex items-center mb-2" role="alert">
            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> Para tomar una actividad del pull debes hacer Check-in
        </div>
    @endif

    <div class="contenedor-actividades">
    @if(isset($actividades))
        @foreach ($actividades as $actividad)

        <div class="actividad">
            <div class="titulo">{{ $actividad->actividad }}
                <button class="boton-azul" onclick="verDetalles({{ $actividad->actividad_id }})">+</button>
            </div>
            <div class="detalle">
                <span class="subtitulo">Proyecto:</span> {{ $actividad->proyecto_origen }}
                <br>{{ $actividad->categoria }} | </span>

                @if(isset($actividad->subcategoria))
                    <span class="subcategoria">{{ $actividad->subcategoria }}</span><br>
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
                <div class="col-md-6">
                        <input id = "horas_{{ $actividad->id }}" name="horas_{{ $actividad->id }}"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" >
                        <input id= "minutos_{{ $actividad->id }}" name="minutos_{{ $actividad->id }}"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" >
                    </div>
                    <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                </div>
            <div class="detalle botones">
                @if($actividad->estado == 'Asignada' || $actividad->estado == 'Creada')
                    <button class="boton"  onclick="tomarActividad({{ $actividad->id }})"> Tomar Actividad</button>
                @endif
            </div>
        </div>
        @endforeach
    @endif
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

    function tomarActividad(idActividad) {

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
            fetch(`tomarActividad/${idActividad}/${minutos}`, {
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
            alert('Error en el ingreso de los datos. No puedes ingresar menos de cinco minutos, ni valores nulos en ambos campos.');
        }
    } 

    function verDetalles(idActividad) {
            window.location.href = "detalles_actividad/" + idActividad;
    }

    </script>
@endsection