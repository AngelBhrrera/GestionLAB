@extends('layouts/admin-layout')

@section('subhead')
<style>
  /* Estilos para dar formato */
  .module {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
  }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')

<div style="padding-left: 30px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card card-primary">
                    <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar Actividades </h3>
                </div>
                <div class="card-body">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif
                    @csrf

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                            <div class="col-span-12 sm:col-span-8">
                                                <div class="form-group row justify-content-center"> <!-- Alinea el contenido horizontalmente -->
                                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                                    <div class="col-md-8"> <!-- Ancho ajustado para el contenido -->
                                                        <select class="select2" multiple>
                                                            @if (isset($prestadores)) 
                                                                @foreach ($prestadores as $prestador) 
                                                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                                                @endforeach 
                                                            @endif 
                                                        </select>
                                                    </div>
                                                </div>
                                                <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                                            </div>
                                            <div class="col-span-6 sm:col-span-4 text-center">
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

                                                <div class="form-group">
                                                    <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividades</label>
                                                    <div id="module-container">
                                                        <div class="module">
                                                            <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                                                                <option value="">Asignar actividad</option>
                                                                @foreach ($actividades as $actividad)
                                                                <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button onclick="removeModule(0)">Eliminar</button>
                                                        </div>
                                                    </div>
                                                <button id="add-module-btn">+</button>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado</label>
                                                    <div class="col-md-20">
                                                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                                            <input name="horas" type="number" class="form-control" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                                            <input name="minutos" type="number" class="form-control" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                                                        </div>
                                                        <small id="Help" class="form-text text-muted">Ingresa el tiempo que conllevara realizar la actividad</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-12"> <!-- Columna adicional para el botón -->
                                                <div class="form-group row justify-content-center"> <!-- Alinea el botón horizontalmente -->
                                                    <div class="col-md-4"></div> <!-- Columna vacía para alinear con los otros campos -->
                                                    <div class="col-md-8"> <!-- Ancho ajustado para el botón -->
                                                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">As</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div style="height: 45px;"></div>

@endsection

@section('script')


<script type="text/javascript">
    let dlb2 = new DualListbox('.select2', {
        availableTitle: 'Prestadores disponibles',
        selectedTitle: 'Prestadores seleccionados',
        addButtonText: '🡺',
        removeButtonText: '🡸',
        addAllButtonText: '>>',
        removeAllButtonText: '<<',
        searchPlaceholder: 'Buscar prestadores'
    });
    dlb2.addEventListener('added', function(event) {
        console.log(event);
    });
    dlb2.addEventListener('removed', function(event) {
        console.log(event);
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
</script>

<script>
  // Obtener el contenedor donde se agregarán los módulos
  const moduleContainer = document.getElementById('module-container');
  
  // Obtener el botón para agregar un nuevo módulo
  const addModuleBtn = document.getElementById('add-module-btn');
  
  // Contador para asignar IDs únicos a los módulos
  let moduleId = 1; // Comienza en 1 porque ya hay un módulo inicial
  
  // Función para agregar un nuevo módulo de select
  function addModule() {
    // Crear el elemento del módulo
    const module = document.createElement('div');
    module.classList.add('module');
    module.innerHTML = `
        <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
            <option value="">Asignar actividad</option>
                @foreach ($actividades as $actividad)
                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                @endforeach
        </select>
        <button onclick="removeModule(0)">Eliminar</button>
    `;
    
    // Agregar el módulo al contenedor
    moduleContainer.appendChild(module);
    
    // Incrementar el ID para el próximo módulo
    moduleId++;
  }
  
  // Función para eliminar un módulo
  function removeModule(id) {
    // Obtener el módulo por su ID
    const moduleToRemove = document.querySelector(`[name="module-${id}"]`);
    if (moduleToRemove) {
      // Eliminar el módulo del contenedor
      moduleContainer.removeChild(moduleToRemove.parentElement);
    }
  }
  
  // Escuchar eventos de clic en el botón de agregar módulo
  addModuleBtn.addEventListener('click', addModule);

  // Obtener información del número de elementos y contenido seleccionado
  function obtenerInformacion() {
    const numElementos = moduleId;
    const valoresSeleccionados = [];
    for (let i = 0; i < numElementos; i++) {
      const select = document.querySelector(`[name="module-${i}"]`);
      valoresSeleccionados.push(select.value);
    }
    console.log("Número de elementos:", numElementos);
    console.log("Valores seleccionados:", valoresSeleccionados);
    // Aquí puedes enviar los datos a tu backend para la inserción en la BD
  }
</script>

@endsection