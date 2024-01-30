@extends('layouts/prestador-layout')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear actividad</li>
    </ol>
</nav>
@endsection

@section('subcontent')

<div class="container">
    <h1 class="text-center"><strong> Registro de actividad </strong></h1>
    <form method="POST" action="{{ route('registro_reporte_guardar') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                <div class="card-body">

                    <h5 class="text-center">Titulo</h5>

                    <input id="nombre" type="text" class="form-control" name="nombre" required autocomplete="nombre" autofocus>

                    <h5 class="text-center">Descripción</h5>

                    <textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>

                    <h5 class="text-center">Objetivo</h5>

                    <textarea class="form-control" name="objetivo" id="objetivo" required rows="3"></textarea>

                    <div class="text-center pt-5">
                        <label class="form-block-input btn-primary" style="
                                    border-radius: 15px;
                                    font-size: 14px;
                                    font-weight: 600;
                                    display: inline-block;
                                    transition: all .5s;
                                    cursor: pointer;
                                    padding: 15px 40px !important;
                                    text-transform: uppercase;
                                    width: fit-content;
                                    text-align: center;
                                    ">
                            <div style="display:flex;">
                                <i data-lucide="image" height="20" width="20"></i>
                                <input type="file" name="custom-file" class="form-file" style="display: none;" accept="image/jpg, image/jpeg" />
                                <span class="form-file-span pl-5">Selecciona una imagen</span>
                            </div>
                        </label>
                    </div>
                    <div class="text-center pt-5">

                        <label class="form-block-input btn-primary" style="
                                    border-radius: 15px;
                                    font-size: 14px;
                                    font-weight: 600;
                                    display: inline-block;
                                    transition: all .5s;
                                    cursor: pointer;
                                    padding: 15px 40px !important;
                                    text-transform: uppercase;
                                    width: fit-content;
                                    text-align: center;
                                    ">
                            <div style="display:flex;">
                                <i class="pr-5"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-archive">
                                        <circle cx="15" cy="19" r="2" />
                                        <path d="M20.9 19.8A2 2 0 0 0 22 18V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 
                                        3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h5.1" />
                                        <path d="M15 11v-1" />
                                        <path d="M15 17v-2" />
                                    </svg></i>
                                <input type="file" name="custom-file" class="form-file" style="display: none;" accept=".zip" />
                                <span class="form-file-span">Selecciona un archivo zip</span>
                            </div>
                        </label>
                    </div>
                    <br>
                    <h5 class="text-center">Estimación de tiempo (HH:MM)</h5>
                    <div class="row text-center">
                        <div class="col">
                            <input id="horas" type="number" class="form-control sm:w-56 box pl-10" name="horas" required min="0" max="23" step="1" placeholder="Horas" autocomplete="off">
                            <input id="minutos" type="number" class="form-control sm:w-56 box pl-10" name="minutos" required min="0" max="59" step="1" placeholder="Minutos" autocomplete="off">
                        </div>
                    </div>
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
                <br>
                <br>
                <div class="row justify-content-center text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
    </form>
            </div>
        </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Obtener inputs tipo file
        const fileInputs = document.querySelectorAll('input[type=file]');
        const fileButtons = document.querySelectorAll('.form-file-button');
        // Asignar eventos a inputs
        fileInputs.forEach(file => file.addEventListener('change', fileChange));
        fileButtons.forEach(button => button.addEventListener('click', fileClick));

    });

    // Cambios en inputs
    function fileChange(e) {
        let input = e.target;
        let spanBlock = e.target.closest('label').querySelector('.form-file-span');
        // Limpiar contenedor
        spanBlock.innerHTML = '';
        // Recorrer archivos para agregarlos al contenedor
        Array.from(input.files).forEach(file => {
            spanBlock.innerHTML += `<span class="form-files">${file.name}</span>`;
        });
    }
    // Clics en botones
    function fileClick(e) {
        // Desde el botón se obtiene el input y se abre la ventana para seleccionar archivos
        let input = e.target.closest('label').querySelector('input');
        input.click();
    }
</script>

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