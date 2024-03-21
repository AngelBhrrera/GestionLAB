@extends('layouts/admin-layout')

@section('subhead')
<link rel="stylesheet" href="{{asset('build/assets/css/asignar_actividadess.css')}}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Asignar actividad a prestador</li>
@endsection

@section('subcontent')

<div style="padding-left: 30px" class="row justify-content-center">
    <div class="col-md-8">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
                @if (session('success'))
                    <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
                @endif
                @if(session('warning'))
                    <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
                @endif
                @error('nombre')
                    <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="card">
            <div class="card card-primary" id="titulo_asignar">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar Actividades a Prestador</h3>
            </div>
            <div class="card-body">
                <form id="asign" method="POST" action="{{route('admin.asign')}}">
                    @csrf
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif
                    <div class="col-span-6 sm:col-span-4 text-center">
                        <div class="form-group" id="select_proyect">
                            <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Proyecto</label>
                            <select class="form-control" id="proyecto" name="proyecto" required onchange="filtrarPrestadores()">
                                <option value="">Selecciona un proyecto para asignar la actividad</option>
                                @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="asignar">
                            <label for="tipo_categoria">Filtro por categoría</label>
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" onchange="filtrarCategorias()">
                                <option value="">Filtrar por categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="asignar">
                            <label for="tipo_subcategoria">Filtro por subcategoría</label>
                            <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria" onchange="filtrarActividades2()">
                                <option value="">Selecciona una subcategoria (Opcional)</option>
                            </select>
                        </div>

                        <div class="form-group" id="asignar">
                            <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividad</label>
                            <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                                <option value="">Selecciona una actividad</option>
                                @foreach ($actividades as $actividad)
                                <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                        <div class="form-group" id="duelist_box">
                            <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                @if (isset($prestadores))
                                @foreach ($prestadores as $prestador)
                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                    </div>

                    <div class="col-md-8" id="boton_asignar"> <!-- Ancho ajustado para el botón -->
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">Asignar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="height: 45px;"></div>

@endsection
@section('script')
<script type="text/javascript">

    document.getElementById('asign').addEventListener('submit', function(event) {
        
        const prestadorSelect = document.getElementById('prestadores_seleccionados');

        if (prestadorSelect.selectedOptions.length === 0) {
                event.preventDefault();
                alert('Por favor, selecciona al menos un prestador.');
            }
    });

    let dlb2 = new DualListbox('.select2', {
        availableTitle: 'Prestadores disponibles',
        selectedTitle: 'Prestadores seleccionados',
        addButtonText: 'Agregar',
        removeButtonText: 'Quitar',
        addAllButtonText: 'Agregar todos',
        removeAllButtonText: 'Quitar todos',
        searchPlaceholder: 'Buscar prestadores'
    });
    dlb2.addEventListener('added', function(event) {
        const prestadorSelect = document.getElementById('prestadores_seleccionados');
        console.log(prestadorSelect.value);
    });
    dlb2.addEventListener('removed', function(event) {
        const prestadorSelect = document.getElementById('prestadores_seleccionados');
        if (prestadorSelect.selectedOptions.length === 0) {
            console.log(prestadorSelect.value);
        }
    });

    function filtrarCategorias() {
        filtrarActividades()
        var categoriaSelect = document.getElementById('tipo_categoria');
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelect = document.getElementById('tipo_actividad');
        var categoriaId = categoriaSelect.value;

        subcategoriaSelect.innerHTML = '<option value="">Selecciona una subcategoria (Opcional)</option>';
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
        xhr.open('GET', '{{ route('admin.obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }

    function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelects = document.querySelectorAll('#tipo_actividad');
        var categoriaId = categoriaSelect.value;

        actividadSelects.forEach(function(actividadSelect) {
            actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
        });
        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividadSelects.forEach(function(actividadSelect) {
                        actividades.forEach(function(actividad) {
                            var option = document.createElement('option');
                            option.value = actividad.id;
                            option.text = actividad.titulo;
                            actividadSelect.appendChild(option);
                        });
                    });
                    console.log("Add");
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        xhr.open('GET', '{{ route('admin.obtenerActividades') }}?categoriaId=' + categoriaId);
        xhr.send();
    }

    function filtrarActividades2() {
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelects = document.querySelectorAll('#tipo_actividad');

        var subcategoriaId = subcategoriaSelect.value;
        actividadSelects.forEach(function(actividadSelect) {
            actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
        });
        if (subcategoriaId === '') {
            filtrarActividades();
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividadSelects.forEach(function(actividadSelect) {
                        actividades.forEach(function(actividad) {
                            var option = document.createElement('option');
                            option.value = actividad.id;
                            option.text = actividad.titulo;
                            actividadSelect.appendChild(option);
                        });
                    });
                    console.log("Add");
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('admin.obtenerActividadesB') }}?subcategoriaId=' + subcategoriaId);

        xhr.send();
    }

    function filtrarPrestadores() {

        var proySelect = document.getElementById('proyecto');
        var preSelect = document.getElementById('prestadores_seleccionados');
        var proyId = proySelect.value;

        if (proyId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var prestadores = JSON.parse(xhr.responseText);

                    prestadores.forEach(prestador => {

                    });

                    dlb2.refresh();

                } else {
                    console.error('Error al obtener los prestadores');
                }
            }
        };
        xhr.open('GET', '{{ route('admin.obtenerPrestadoresProyecto') }}?proyectoId=' + proyId);
        xhr.send();
    }

</script>

@endsection