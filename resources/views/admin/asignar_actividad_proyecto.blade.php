@extends('layouts/admin-layout')
@section('subhead')

<link rel="stylesheet" href="{{asset('build/assets/css/registro_proyecto_actividadess.css')}}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
<li class="breadcrumb-item active" aria-current="page">Asignar actividades</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
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
            </div>
            <div class="card card-primary" id="titulo">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar actividades a proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10" id="cardbody">
                    <form id="btnproy" method="POST"  action="{{route('admin.asign2')}}">
                    @csrf
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
                                <option value="">Filtrar por categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_subcategoria">Filtro por subcategoría</label>
                            <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria" onchange="filtrarActividades2()">
                                <option value=null >Filtrar por subcategoría</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividades</label>
                            <div id="module-container">
                                <div class="module">
                                    <select class="form-control" id="tipo_actividad" name="module-0" required>
                                        <option value="" >Asignar actividad</option>
                                    </select>
                                    <button type="button" class="btn btn-danger"  onclick="removeModule(0)">-</button>
                                </div>
                            </div>
                            <button type="submit"  class="btn btn-primary from-prevent-multiple-submits" id="add-module-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-8" id="agregar_actividades"> 
                        <button type="submit" id='asignar' class="btn btn-primary from-prevent-multiple-submits">Agregar a proyecto</button>
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
            var selectedValue = actividadSelect.value;
            if (selectedValue === "") {
                actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
            }
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
        xhr.open('GET', '{{ route('admin.obtenerActividades') }}?categoriaId=' + categoriaId);

        xhr.send();
    }

    function filtrarActividades2() {
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelects = document.querySelectorAll('#tipo_actividad');

        var subcategoriaId = subcategoriaSelect.value;
        actividadSelects.forEach(function(actividadSelect) {
            var selectedValue = actividadSelect.value;
            if (selectedValue === "") {
                actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';
            }
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
</script>

<script>

  const moduleContainer = document.getElementById('module-container');
  const addModuleBtn = document.getElementById('add-module-btn');
  
  let moduleId = 1; 
  
  function addModule() {

    const module = document.createElement('div');
    module.classList.add('module');
    module.innerHTML = `
        <select class="form-control" id="tipo_actividad"  name="module-${moduleId}" required>
            <option value="" >Asignar actividad</option>
        </select>
        <button type="button" class="btn btn-danger" onclick="removeModule(${moduleId})""> - </button>
    `;
    

    moduleContainer.appendChild(module);
    moduleId++;
  }
  
  function removeModule(id) {

        console.log(id);

    const moduleToRemove = document.querySelector(`[name="module-${id}"]`);
    if (moduleToRemove) {
      moduleContainer.removeChild(moduleToRemove.parentElement);
    }
  }
  
  addModuleBtn.addEventListener('click', addModule);

  function obtenerInformacion() {
    const numElementos = moduleId;
    const valoresSeleccionados = [];
    for (let i = 0; i < numElementos; i++) {
      const select = document.querySelector(`[name="module-${i}"]`);
      valoresSeleccionados.push(select.value);
    }
    console.log("Número de elementos:", numElementos);
    console.log("Valores seleccionados:", valoresSeleccionados);
  }
</script>

@endsection