@extends('layouts/prestador-layout')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear actividad</li>
@endsection

@section('subcontent')
<div class="container">
    <h1 class="text-center"><strong> Actividades</strong></h1>
    <form method="POST" action="{{ route('registro_reporte_guardar') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <!-- Columna 1 - Registro de Actividad -->
            <div class="col-md-6">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">
                        <h2 class="text-center">Registro de actividad</h2>

                        <h5 class="text-center">Titulo</h5>

                        <input id="nombre" type="text" class="form-control" name="nombre" required autocomplete="nombre" autofocus>

                        <h5 class="text-center">Descripción</h5>

                        <textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>

                        <h5 class="text-center">Objetivo</h5>

                        <textarea class="form-control" name="objetivo" id="objetivo" required rows="3"></textarea>
                    </div>
                </div>
            </div>
            <!-- Columna 2 - Asignar Actividad -->
            <div class="col-md-6">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">
                        <h2 class="text-center">Asignar Actividad</h2>

                        <br>
                        <div class="form-group">
                            <label for="asignado_a">Asignado a</label>
                            <select class="form-control" id="asignado_a" name="asignado_a" required>
                                <option value="">Selecciona un prestador</option>
                                @foreach ($prestadores as $prestador)
                                <option value="{{ $prestador->id }}">{{ $prestador->name.' '.$prestador->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tipo_categoria">Categoría</label>
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_categoria">Subcategoría</label>
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tipo_actividad">Actividad</label>
                            <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                                <option value="">Selecciona una actividad</option>
                                @foreach ($actividades as $actividad)
                                <option id="{{ $actividad->id }}" value="{{ $actividad->id }}" {{ (old('tipo', isset($actm[0]->tipo_act) ? $actm[0]->tipo_act : '') == $actividad->id) ? "selected" : '' }}>{{ $actividad->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_actividad">Estimacion Tiempo</label>
                            <div class="row text-center">
                                <div class="col">
                                    <input id="horas" type="number" class="form-control sm:w-56 box pl-10" name="horas" required min="0" max="23" step="1" placeholder="Horas" autocomplete="off">
                                    <input id="minutos" type="number" class="form-control sm:w-56 box pl-10" name="minutos" required min="0" max="59" step="1" placeholder="Minutos" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection

<script>
function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var categoriaId = categoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividades.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        actividadSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('obtenerActividades') }}?categoriaId=' + categoriaId);

        xhr.send();
    }
</script>