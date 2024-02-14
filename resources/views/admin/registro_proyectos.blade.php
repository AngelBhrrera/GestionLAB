@extends('layouts/admin-layout')
@section('subhead')
<style>
    .bootstrap-duallistbox-container .box1,
    .bootstrap-duallistbox-container .box2 {
        width: 48%;
        /* Ajusta el ancho según tus necesidades */
        display: inline-block;
        vertical-align: top;
        margin-right: 2%;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear Nuevo Proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10">
                <form id="btn-proy" method="POST" action="{{route('admin.make_proy')}}">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Titulo del proyecto</label>
                        <div class="col-md-8">
                            <textarea id="t_proyecto" name="t_nombre" type="text" class="form-control"  required>Ingresa el titulo del proyecto</textarea>
                        </div>
                    </div>

                    <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">Crear proyecto</button>
                </form>
            </div>

            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar actividades a proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10">
                    <form id="btn-proy" method="POST">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value="{{ $tipo }}" type="hidden">
                    @endif
                    <br>
                    <div class="col-span-6 sm:col-span-4 text-center">
                        <div class="form-group">
                            <label for="tipo_categoria">Seleccionar proyecto</label>
                            <select class="form-control" id="proyecto" name="proyecto" required>
                                <option value="">Selecciona un proyecto para asginar actividad/es </option>
                                @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_categoria">Filtro por categoría</label>
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" onchange="filtrarCategorias()">
                                <option value=null >Filtrar por categoría</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_subcategoria">Filtro por subcategoría</label>
                            <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria" onchange="filtrarActividades2()">
                                <option value=null >Filtrar por subcategoría</option>
                            </select>
                        </div>
                        <br>
                        <div id="module-container">
                            <div class="module">
                            <select name="module-0" class="form-control">
                                <option value="opcion1">Opción 1</option>
                                <option value="opcion2">Opción 2</option>
                                <option value="opcion3">Opción 3</option>
                            </select>
                            <button type="button" onclick="removeModule(0)">Eliminar</button>
                            </div>
                        </div>
                        <button type="button" id="add-module-btn">+</button>
                    </div>
                    <div class="col-md-8"> 
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">Crear proyecto</button>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>


<div style="height: 45px;"></div>

@endsection

@section('script')

<script type="text/javascript">

    document.getElementById('btn-proy').addEventListener('submit', function(event) {
        
        const prestadorSelect = document.getElementById('prestadores_seleccionados');

        if (prestadorSelect.selectedOptions.length === 0) {
                event.preventDefault();
                alert('Por favor, selecciona al menos un prestador.');
            }
    });

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

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('obtenerActividades') }}?categoriaId=' + categoriaId);

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
        xhr.open('GET', '{{ route('obtenerActividadesB') }}?subcategoriaId=' + subcategoriaId);

        xhr.send();
    }

  const moduleContainer = document.getElementById('module-container');
  const addModuleBtn = document.getElementById('add-module-btn');
  let moduleId = 1; 
  
  function addModule() {
    // Crear el elemento del módulo
    const module = document.createElement('div');
    module.classList.add('module');
    module.innerHTML = `
    <select class="form-control" name="module-${moduleId}">
                <option value="">Asignar actividad</option>
                    @foreach ($actividades as $actividad)
                        <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                    @endforeach
            </select>
            <button type="button" onclick="removeModule(${moduleId})">Eliminar</button>
    `;
    moduleContainer.appendChild(module);
    moduleId++;
  }
  
  function removeModule(id) {

    const moduleToRemove = document.querySelector(`[name="module-${id}"]`);
    if (moduleToRemove) {
      moduleContainer.removeChild(moduleToRemove.parentElement);
    }
  }
  

</script>

@endsection