@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<style>  
  .actividad {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .titulo {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .detalle {
    margin-bottom: 10px;
  }

  .input-tiempo {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
  }

  .subtitulo {
    font-weight: bold;
  }

  .categoria-subcategoria {
    display: flex;
    align-items: center;
  }


  .botones {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .boton {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s ease;
  }

  .boton-inactivo {
    background-color: #ccc;
    color: #666;
    cursor: not-allowed;
  }

  .contenedor-actividades {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Tres columnas de igual tamaño */
  gap: 20px; /* Espacio entre las actividades */
}

.boton-azul {
    background-color: blue;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.boton-azul:hover {
    background-color: darkblue;
}

</style>
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
                <span class="proyecto">Proyecto:</span> {{ $actividad->proyecto_origen }}
                <br>
                <span class="categoria">Categoría:</span>{{ $actividad->categoria }}<br>
                @if(isset($actividad->subcategoria))
                    <span class="Subcategoria">Subcategoría:</span> {{ $actividad->subcategoria }}<br>
                @endif
                <span class="subtitulo">Fecha:</span> {{ $actividad->fecha }}<br>
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
            </div>
            <div class="detalle">
                @if(isset($actividad->TEU))
                    @php
                        $tiempo_en_minutos = $actividad->TEU;
                        $horas = floor($tiempo_en_minutos / 60);
                        $minutos = $tiempo_en_minutos % 60;

                    @endphp
                    <div class="col-md-6">
                        <input name="horas"  style="width: 125px;"  type="text"  class="form-control sm:w-56" disabled value="{{ $horas . ' h '}}"> 
                        <input name="minutos"  style="width: 125px;" type="text"  class="form-control sm:w-56" disabled value= "{{ $minutos . ' m '}}" >
                    </div>
                    <small id="Help" class="form-text text-muted"></small>
                @else
                    <div class="col-md-6">
                        <input name="horas"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1">
                        <input name="minutos"  style="width: 125px;" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1">
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