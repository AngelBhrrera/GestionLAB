@extends('layouts/admin-layout')

@section('subhead')
    <link rel="stylesheet" href="{{asset('build/assets/css/asignar_actividadess.css')}}">
    <style>
        .tab-scroll {
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Modulo de Actividades</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
        </div>
    </div>

    <div class="tab-scroll">
        <ul class="nav nav-tabs nav-justified" role="tablist">  
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#eactpr">Evaluar Actividades Pendientes de Revision</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#cact">Registrar Nueva Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#vacts">Ver Todas las Actividades en el Area</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#aactp">Asignar Actividades a Prestador</a>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pract">Aprobar Actividades Propuestas por Prestador</a>
            </li>--}}
        </ul>
    </div>
    
    <div class="tab-content">
        <div class="tab-pane active" id="eactpr">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
                Revisar actividades
            </h2>
            <div class="w-[350px] relative mx-5 my-5">
                <input id="searchInput2" type="text" class="form-control pl-10" placeholder="Buscar">
                <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
            </div>
            <div id="rActs"></div>
        </div>

        <div class="tab-pane" id="cact">
            <form method="POST" action="{{route('admin.makeasign_act')}}">
                <div class="col-md-9" id="parte1">
                    <div class="card card-primary">
                        <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear nueva actividad </h3>
                    </div>
                    <div class="card-body pl-10 pr-10">
                            @if (isset($tipo))
                            <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                            @endif

                            <input id="id" name="id" type="hidden" value="{{!isset($actm[0]->id) ? old('id') : $actm[0]->id }}">
                            <input name="TipoOriginal" type="hidden" value="{{isset($actm[0]->tipo) ? $actm[0]->tipo : old('TipoOriginal') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la actividad</label>

                                <div class="col-md-6">
                                    <input required id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" name="nombre" value="{{isset($actm[0]->nombre_act) ? $actm[0]->nombre_act : old('nombre') }}" required autocomplete="nombre" autofocus>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Categoría</label>
                                <div class="col-md-6">
                                    <select required class="form-control" id="tipo_categoriaC" name="tipo_categoria" required onchange="filtroSC()">
                                        <option value="">Selecciona una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option @selected(old('tipo_categoria')== {{$categoria->id}}) value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Subcategoría</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="tipo_subcategoriaC" name="tipo_subcategoria">
                                        <option value="">Selecciona una subcategoría</option>
                                        @foreach ($subcategorias as $subcategoria)
                                        <option @selected(old('tipo_subcategoria')== {{$subcategoria->id}}) value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="tipo_actividad" class="text-center">Tipo de actividad</label>
                                <div class="row text-center">
                                    <div class="col">
                                        <select required class="form-control" name="tipo_actividad">
                                            <option value="{{null}}">Selecciona un tipo de actividad</option>
                                            <option  value="generica" @selected(old('tipo_actividad')== "generica")>Genérica</option>
                                            <option  value="particular" @selected(old('tipo_actividad')== "particular")>Particular</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-6">
                                <label for="recursos">Recursos necesarios - entradas</label>
                                    <textarea required id="recursos" type="text" class="form-control" name="recursos" placeholder="Ingrese los datos separados por comas (impresora, filamento, papel, agua)">{{old('recursos')}}</textarea>

                                    @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción del trabajo a realizar - procesos</label>

                                <div class="col-md-6">
                                    <textarea required id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" value="{{old('descripcion')}}" name="descripcion" required>{{old('descripcion')}}</textarea>

                                    @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="resultados" class="col-md-4 col-form-label text-md-right">Objetivos, resultados que se esperan - salidas</label>

                                <div class="col-md-6">
                                    <textarea required id="resultados" type="text" class="form-control" value="{{old('resultados')}}" name="resultados" placeholder="Ingrese los datos separados por comas (imprimir, diseñar, pintar)" required>{{old('resultados')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado (TEC)</label>
                                    <div class="col-md-6">
                                            <input required name="horas" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" value="0" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                            <input required name="minutos" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" value="0" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                                    </div>
                                    @error('horas')
                                        <strong>{{$message}}</strong>
                                    @enderror
                                    @error('minutos')
                                        <strong>{{$message}}</strong>
                                    @enderror
                                <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Experiencia</label>
                                <div class="col-md-6">
                                    <select name="exp" class="form-control sm:w-56" required>
                                        <option value="" selected>Ingresa la dificultad de la actividad</option>
                                        <option value="5">Fácil</option>
                                        <option value="20">Normal</option>
                                        <option value="40">Difícil</option>
                                    </select>
                                </div>
                                <small id="Help" class="form-text text-muted">Ingresa la cantidad de experiencia que puede ganar el prestador en caso de un trabajo óptimo</small>
                            </div>
                            <br>
                            <div class="col-md-12 text-center"> 
                                <buttontype="button" id="siguiente" class="btn btn-primary" style="font-size: 20px;">Siguiente</button>
                            </div>
                            <div style="height: 50px;"></div>

                    </div>
                </div>
                <div class="col-md-9" id="parte2" style="display:none">
                    <div class="card card-primary">
                        <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;">Asignar actividad </h3>
                    </div>
                    <div class="card-body pl-10 pr-10">
                        <div class="form-group row">
                            <label for="tipo_asignacion" class="col-md-4 col-form-label text-md-right">Tipo de asignación</label>
                            <div class="col-md-6">
                                <select  class="tom-select" id="tipo_asignacion" name="tipo_asignacion">
                                    <option value="">Selecciona una opción</option>
                                    <option value="1">Asignar a proyecto</option>
                                    <option value="2">Asignar a prestador</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select_premio" class="col-md-4 col-form-label text-md-right">Premio</label>
                            <div class="col-md-6">
                                <select  class="tom-select" id="select_premio" name="premio">
                                
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="select_proyecto" class="col-md-4 col-form-label text-md-right">Proyecto</label>
                            <div class="col-md-6">
                                <select  class="tom-select" id="select_proyecto" name="proyecto">
                                    <option value="">Selecciona un proyecto para asignar la actividad</option>
                                    @foreach ($aProyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div id="campo_adicional_prestador" style="display: none;">
                            <div class="form-group row">
                                <label for="select_prestador" class="col-md-4 col-form-label text-md-right">Prestador/es</label>
                                    <div class="col-md-6">
                                        <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                        @if (isset($aPrestadores))
                                        @foreach ($aPrestadores as $prestador)
                                            <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                    </div>
                                <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                            </div>
                        </div>

                        <div id="campo_adicional_proyecto" style="display: none;">
                            <div class="form-group row">
                                <label for="numero_veces" class="col-md-4 col-form-label text-md-right">Número de veces</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="numero_veces" name="numero_veces" min="1" max="25">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 text-center"> 
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits" style="font-size: 20px;">Crear</button> <!-- Aumentamos el tamaño de la fuente -->
                    </div>
                    <div style="height: 50px;"></div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="vacts">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
                Todas las actividades.
            </h2>
            <div class="w-[350px] relative mx-5 my-5">
                <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
                <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
            </div>
            <div id="vActs"></div>
        </div>

        <div class="tab-pane" id="aactp">
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
                                <select class="tom-select w-full"  id="proyecto" name="proyecto" required>
                                    <option value="">Selecciona un proyecto para asignar la actividad</option>
                                    @foreach ($aProyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group" id="asignar">
                                <label for="tipo_categoria">Filtro por categoría</label>
                                <select class="tom-select w-full" id="tipo_categoria" name="tipo_categoria" onchange="filtrarCategorias()">
                                    <option value="">Filtrar por categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="asignar">
                                <label for="tipo_subcategoria">Filtro por subcategoría</label>
                                <select class="tom-select w-full" id="tipo_subcategoria" name="tipo_subcategoria" onchange="filtrarActividades2()">
                                    <option value="">Selecciona una subcategoria (Opcional)</option>
                                </select>
                            </div>--}}
                            <div class="form-group" id="asignar">
                                <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividad</label>
                                <select class="tom-select w-full" id="tipo_actividad" name="tipo_actividad" required>
                                    <option value="">Selecciona una actividad</option>
                                    @foreach ($aActividades as $actividad)
                                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                            <div class="form-group" id="duelist_box">
                                <select class="select3" name="prestadores_seleccionados[]" id="prestadores_seleccionados2" multiple>  
                                    @if (isset($aPrestadores))
                                    @foreach ($aPrestadores as $prestador)
                                        <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                        </div>

                        <div class="col-md-12 text-center"> 
                            <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits" style="font-size: 20px;">Asignar</button> <!-- Aumentamos el tamaño de la fuente -->
                        </div>
                        <div style="height: 50px;"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="pract">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
             Aqui puedes aprobar actividades propuestas por los prestadores para su posterior asignacion
            </h2>
            <div id="aActs"></div>
        </div>

        
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    document.getElementById('asign').addEventListener('submit', function(event) {
        
        const prestadorSelect = document.getElementById('prestadores_seleccionados2');

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

    let dlb3 = new DualListbox('.select3', {
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

    function filtroSC() {
        var categoriaSelect = document.getElementById('tipo_categoriaC');
        var subcategoriaSelect = document.getElementById('tipo_subcategoriaC');
        var categoriaId = categoriaSelect.value;

        subcategoriaSelect.innerHTML = '<option value="">Selecciona una subcategoria (Opcional)</option>';

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
                        subcategoriaSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };
        xhr.open('GET', '{{ route('admin.obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }

</script>

    <script type="text/javascript">

        var allAct = {!! $data1 !!};
        var prAct = {!! $data2 !!};
        var revAct = {!! $data3 !!};

        function createTabulatorInstance(selector, data, config) {
            return new Tabulator(selector, {
                ...config,
                data: data,
            });
        }

        var commonConfig = {
            paginationSize: 20,
            pagination: "local",
            layout: "fitDataFill",
            resizableColumns:false,
            layoutColumnsOnNewData:true,
            headerFilterPlaceholder: "Buscar..",
            tooltips: true,
        };

        var table = createTabulatorInstance("#vActs", allAct, {
            ...commonConfig,
            columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    },{
                        title: "Prestador",
                        field: "prestador",
                        width: 170,
                    }, {
                        title: "Titulo Act",
                        field: "actividad",
                        sorter: "string",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Asignada": "Asignada",
                            "En proceso": "En Proceso",
                            "En revision": "En revision",
                            "Bloqueada": "Bloqueada",
                            "Error": "Error",
                            "Aprobada": "Aprobada",
                        },
                    }, {
                        title: "Proyecto",
                        field: "proyecto_origen",
                        sorter: "string",
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                    }, {
                        title: "Duracion",
                        field: "duracion",
                    }, {
                        title: "Detalles",
                        field: "detalles",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    },        
            ],
        });

        var table2 = createTabulatorInstance("#aActs", prAct, {
            ...commonConfig,
            columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Proyecto",
                        field: "proyecto_origen",
                        sorter: "string",
                    }, {
                        title: "Titulo",
                        field: "actividad",
                        sorter: "string",
                    }, {
                        title: "Tiempo Invertido",
                        field: "duracion",
                        sorter: "string",
                    }, {
                        title: "Detalles",
                        field: "detalles",
                        sorter: "string",
                    }, {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Aprobar";
                            button.title = "";
                            button.addEventListener("click", function() {

                                window.location.href = 'aprobar_actividad/' + value;
                            });
                            return button;
                        }, 
                    },   {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Eliminar";
                            button.title ="";
                            button.addEventListener("click", function() {
                                eliminarActividad(value);
                            });
                            return button;
                        }, 
                    },
            ],
        });

        var table3 = createTabulatorInstance("#rActs", revAct, {
            ...commonConfig,
            columns: [{
                        title: "Prestador",
                        field: "prestador",
                        sorter: "string",
                        width: 170,
                    }, {
                        title: "Titulo Act",
                        field: "actividad",
                        sorter: "string",
                    },  {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                    },  {
                        title: "Estado",
                        field: "estado",
                        editor: "select",
                        editorParams: {
                            values: {
                                "Aprobada": "Aprobada",
                                "En revision": "En revision",
                                "Error": "Error",
                            }
                        },
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "aprobado": "aprobado",
                            "revision": "revision",
                            "error": "error",
                        },
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            cambiarEstado(id, value);
                        }
                    }, {
                        title: "",
                        field: "actividad_id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "+ Info.";
                            button.title = "";
                            button.addEventListener("click", function() {

                                window.location.href = 'ver_detalles_actividad/' + value;
                            });
                            return button;
                        }, 
                    }, {
                        title: "Detalles",
                        field: "detalles",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    },        
            ],
        });

        function agregarObservaciones(id, value) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`observaciones_actividad/${id}/${value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log('Observaciones de actividad cambiada', data);
            })
            .catch(error => {
                console.error('Error al cambiar de estado de impresion:', error);
            });
        } 
        function eliminarActividad(value) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`eliminar_actividad/${value}`, {
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
                console.error('Error al eliminar actividad:', error);
            });
        }
        
        function cambiarEstado(id, value) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`califAct/${id}/${value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {

                console.log('Estado de horas cambiado', data);

                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error al cambiar de estado:', error);
            });
        } 

        document.addEventListener('DOMContentLoaded', function() {

            function applyCustomFilter(value) {
                var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                table.setFilter(function(row) {
                    return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                        (row.prestador && row.prestador.toLowerCase().includes(searchValue)) || 
                        (row.actividad && row.actividad.toLowerCase().includes(searchValue)) || 
                        (row.estado && row.estado.toLowerCase().includes(searchValue)) || 
                        (row.proyecto && row.proyecto.toLowerCase().includes(searchValue));
                });
            }

            function applyCustomFilter2(value) {
                var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                table.setFilter(function(row) {
                    return (row.prestador && row.prestador.toString().toLowerCase().includes(searchValue)) || 
                        (row.actividad && row.actividad.toLowerCase().includes(searchValue)) || 
                        (row.fecha && row.fecha.toLowerCase().includes(searchValue));
                });
            }

            document.getElementById("searchInput").addEventListener("input", function(e) {
                var value = e.target.value.trim();
                applyCustomFilter(value);
            });

            document.getElementById("searchInput2").addEventListener("input", function(e) {
                var value = e.target.value.trim();
                applyCustomFilter2(value);
            });
        });

    </script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("siguiente").addEventListener("click", function() {
           
            document.getElementById("parte1").style.display = "none";
           
            document.getElementById("parte2").style.display = "block";
        });

        document.getElementById("tipo_asignacion").addEventListener("change", function() {

            var seleccion = this.value;
            if (seleccion === "1") {
                document.getElementById("campo_adicional_proyecto").style.display = "block";
                document.getElementById("campo_adicional_prestador").style.display = "none";
            } else if (seleccion === "2") {
                document.getElementById("campo_adicional_proyecto").style.display = "none";
                document.getElementById("campo_adicional_prestador").style.display = "block";
            }
        });
    });
</script>

@endsection