@extends('layouts/prestador-layout')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="">Asignar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Actividad</li>
@endsection

@section('subcontent')
<div class="container">
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">
                        <h2 class="text-center"><strong> Asignar actividad</strong></h2>
                        <br>
                        <form method="POST" action="{{ route('registro_reporte_guardar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="asignado_a">Asignado a</label>
                            <select class="form-control" id="asignado_a" name="asignado_a" required>
                                <option value="">Selecciona un prestador</option>
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name.' '.Auth::user()->apellido }}</option>

                            </select>
                        </div>
                        <br>
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="tipo_categoria">Filtro por categoría</label>
                                <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarCategorias()">
                                    <option value="">Filtrar por categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo_subcategoria">Filtro por subcategoría</label>
                                <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria" required onchange="filtrarActividades2()">
                                    <option value="">Filtrar por subcategoría</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tipo_actividad">Actividad</label>
                            <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                                <option value="">Selecciona una actividad</option>
                                @foreach ($actividades as $actividad)
                                <option id="{{ $actividad->id }}" value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="row text-center">
                                <label for="tipo_actividad">Estimacion Tiempo</label>
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
function filtrarCategorias() {
        filtrarActividades()
        var categoriaSelect = document.getElementById('tipo_categoria');
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelect = document.getElementById('tipo_actividad');
        var categoriaId = categoriaSelect.value;

        subcategoriaSelect.innerHTML = '<option value="">Selecciona una subcategoria (Opcional)</option>';
        //actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var subc = JSON.parse(xhr.responseText);

                    subc.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        subcategoriaSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las subcategorias');
                }
            }
        };
        xhr.open('GET', '{{ route('obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }

    function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var categoriaId = categoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (categoriaId === '') {
            actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
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
                        option.text = actividad.titulo;
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

    function filtrarActividades2() {
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var subcategoriaId = subcategoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (subcategoriaId === '') {
            actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
            filtrarActividades();
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
                        option.text = actividad.titulo;
                        actividadSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('obtenerActividadesB') }}?subcategoriaId=' + subcategoriaId);

        xhr.send();
    }
</script>