@extends('layouts/admin-layout')

@section('subhead')
    <style>
        .tooltip {
            cursor: pointer;
        }

        .tooltip-info {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            position: absolute;
            z-index: 999;
        }
    </style>
    <link rel="stylesheet" href="{{asset('build/assets/css/registro_proyecto_actividadess.css')}}">
    <script src="{{ asset('vendor/select2/select2/dist/js/select2.min.js') }}"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('nombre')
                <div class="alert alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#cproy">Registrar Nuevo Proyecto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vproy">Ver Proyectos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#aproy">Asignar Actividades a Proyecto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#approy">Añadir Prestadores a Proyecto</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="cproy">
            <div class="card card-primary">
                <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear Nuevo Proyecto </h3>
            </div>

            <div class="row justify-content-center">
                <form id="enviar" method="POST" action="{{route('admin.make_proy')}}">
                @csrf
                    <div class="form-group row" >
                        <label style="font-weight: bold; font-size: 1.2em;" for="nombre" class="col-md-4 col-form-label text-md-right">Titulo del proyecto</label>
                        <div class="col-md-8">
                            <input id="t_proyecto" name="t_nombre" type="text" class="form-control"  placeholder="Ingresa el titulo del proyecto" required></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; font-size: 1.2em;" for="tipo_categoria">Seleccionar area</label>
                        <span class="tooltip" title="Los proyectos deben formar parte de un area de trabajo, tus areas de trabajo estan limitadas por tu rol en el sistema. No puedes crear proyectos en areas o sedes a las que no perteneces">ℹ️</span>
                        <select class="form-control" id="area" name="area" required  onchange="filtroArea()">
                            <option value="">Selecciona el area de trabajo donde estará principalmente el proyecto</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold; font-size: 1.2em;" for="horarios" class="form-label">Turno</label>
                        <span class="tooltip" title="Incluir un turno para el proyecto permite clasificar los proyectos por el horario en el que se trabaja en cada uno">ℹ️</span>
                        <select class="form-control" name="horario" id="horarios" disabled>
                            <option selected id="0" value="">Seleccione un turno</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold; font-size: 1.2em;" for="horarios" class="form-label">Particular</label>
                        <span class="tooltip" title="Los proyectos particulares tienen un numero finito de prestadores que lo conforman y solo se le pueden asignar actividades a esos prestadores. Use un proyecto no particular cuando se realicen actividades generales que cualquier prestador podria realizar.">ℹ️</span>
                        <br>
                        <input id="checkbox" name="particular" class="form-check-input" type="checkbox" checked>
                    </div>

                    <div class="container" id="card_duelist_box">
                        <div class="row justify-content-center">
                            <label style="font-weight: bold; font-size: 1.2em;" for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                            <div class="col-md-8"> 
                                <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                    @if (isset($prestadores))
                                    @foreach ($prestadores as $prestador)
                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <small id="Help" class="form-text text-muted">Selecciona a los prestadores que formaran parte del proyecto</small>
                        </div>
                        <button id="boton_crear" type="submit" class="btn btn-primary from-prevent-multiple-submits">Crear proyecto</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="vproy">
            <div class="intro-y box p-5 mt-5">
                <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
                    Lista de proyectos
                </h2>
                <div class="w-[350px] relative mx-5 my-5">
                    <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
                    <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
                </div>
                <div class="text-center mx-auto" style="padding-left: 10px" id="proyectos"></div>
            </div>
        </div>

        <div class="tab-pane" id="aproy">
            <div class="card card-primary" id="titulo">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar actividades a proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10" id="cardbody">
                <form id="btnproy" method="POST"  action="{{route('admin.asign2')}}">
                @csrf
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
                                    <select class="form-control mi-select" id="tipo_actividad" name="module-0" required>
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
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="aproy">
        </div>
    </div>
</div>


@endsection

@section('script')


    <script type="text/javascript">

        document.getElementById('enviar').addEventListener('submit', function(event) {

            const prestadorSelect = document.getElementById('prestadores_seleccionados');
            const check = document.getElementById('checkbox');

            if (prestadorSelect.selectedOptions.length === 0) {
                
                if(check.checked){
                    event.preventDefault();
                    alert('Por favor, selecciona al menos un prestador.');
                }        
            }
        });
        
        let dlb2 = new DualListbox('.select2', {
            availableTitle: 'Prestadores disponibles',
            selectedTitle: 'Prestadores seleccionados',
            addButtonText: '<span style="color:black;">Agregar</span>',
            removeButtonText: '<span style="color:black;">Quitar</span>',
            addAllButtonText: '<span style="color:black;">Agregar todos</span>',
            removeAllButtonText: '<span style="color:black;">Quitar todos</span>',
            searchPlaceholder: 'Buscar prestadores'
        });
        dlb2.addEventListener('added', function(event) {

        });
        dlb2.addEventListener('removed', function(event) {

        });

        let searchInputs = document.querySelectorAll('.dual-listbox__search');
        if (searchInputs) {
            searchInputs.forEach(function(searchInput) {
                searchInput.style.color = 'black';
            });
        }

        $(document).ready(function() {
            $('.tooltip').click(function() {
                $('.tooltip-info').toggle();
            });
        });

        function filtroArea() {
            var areaSelect = document.getElementById('area');
            var horarioSelect = document.getElementById('horarios');

            var area = areaSelect.value;
            horarioSelect.innerHTML = '<option value="">Selecciona un horario</option>';

            var horariosMapping = {
                'turnoMatutino': 'Matutino',
                'turnoMediodia': 'Mediodia',
                'turnoVespertino': 'Vespertino',
                'turnoSabatino': 'Sabatino',
                'turnoTiempoCompleto': 'TC'
            };

            if (area === '') {
                horarioSelect.disabled = true;
            } else {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var horariosArea = JSON.parse(xhr.responseText);
                            horarioSelect.disabled = false;
                            if (horariosArea[0].turnoMatutino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Matutino';
                                option1.text = 'Matutino';
                                horarioSelect.appendChild(option1);
                            }
                            if (horariosArea[0].turnoMediodia === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Mediodia';
                                option1.text = 'Mediodia';
                                horarioSelect.appendChild(option1);
                            }
                            if (horariosArea[0].turnoVespertino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Vespertino';
                                option1.text = 'Vespertino';
                                horarioSelect.appendChild(option1);
                            }
                            if (horariosArea[0].turnoSabatino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Sabatino';
                                option1.text = 'Sabatino';
                                horarioSelect.appendChild(option1);
                            }
                            if (horariosArea[0].turnoTiempoCompleto === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'TC';
                                option1.text = 'TC';
                                horarioSelect.appendChild(option1);
                            }
                        } else {
                            console.error('Error al obtener horarios');
                        }
                    }
                };
                xhr.open('GET', 'area/' + area); 
                xhr.send();
            }
        }
    </script>

    <script>

        $(document).ready(function() {
            $('.mi-select').select2();
        });

        const moduleContainer = document.getElementById('module-container');
        const addModuleBtn = document.getElementById('add-module-btn');
        let moduleId = 1; 
        function addModule() {

        const module = document.createElement('div');
        module.classList.add('module');
        module.innerHTML = `
            <select class="form-control select2" id="tipo_actividad"  name="module-${moduleId}" required>
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

    <script type="text/javascript">
            var proyectos = {!! $tabla_proy !!};
            var table = new Tabulator("#proyectos", {
                data: proyectos,
                paginationSize: 20,
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Título",
                        field: "titulo",
                    }, {
                        title: "Estado",
                        field: "estado",
                        editor: "select",
                        editorParams: {
                            values: {
                                "Creado": "Creado",
                                "En Desarrollo": "En desarrollo",
                                "Finalizado": "Finalizado",
                                "Cancelado": "Cancelado",
                            }
                        },
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Creado": "Creado",
                            "En Desarrollo": "En desarrollo",
                            "Finalizado": "Finalizado",
                            "Cancelado": "Cancelado",
                        },
                    }, {
                        title: "Fecha inicio",
                        field: "fecha_inicio",
                    }, {
                        title: "Fecha final",
                        field: "fecha_fin",
                    },  {
                        title: "Turno",
                        field: "turno",
                        headerFilter:"select",
                        headerFilterParams: {
                            "": "", 
                            "matutino": "Matutino",
                            "mediodia": "Mediodia",
                            "vespertino": "Vespertino",
                            "sabatino": "Sabatino",
                            "no aplica": "No Aplica",
                        },
                    },{
                        title: "Colaboradores",
                        field: "n_prestadores",

                    }, {
                        title: "Totales",
                        field: "n_acts",
                    },  {
                        title: "Completadas",
                        field: "conteo_terminado",
                    },{
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Detalles";
                            button.title = "";
                            button.addEventListener("click", function() {
                                window.location.href = 'ver_detalles_proyecto/'+ value;
                            });
                            return button;
                        }, 
                    },
                ],
            });

            document.addEventListener('DOMContentLoaded', function() {
                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                    table.setFilter(function(row) {
                        return (row.titulo && row.titulo.toString().toLowerCase().includes(searchValue)) || 
                            (row.fecha_fin && row.fecha_fin.toLowerCase().includes(searchValue)) || 
                            (row.fecha_inicio && row.fecha_inicio.toLowerCase().includes(searchValue));
                    });
                }

                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

                });
            
    </script>

@endsection