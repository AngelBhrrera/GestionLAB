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
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.prestadorHub')}}">Prestadores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Prestadores Activos</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#active">Activos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#inactive">Inactivos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#SST">Servicio Terminado</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#SSL">Servicio Liberado</a>
        </li>
    </ul>
    <div class="w-[350px] relative mx-5 my-5">
        <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
        <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="active">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Prestadores Activos</h3>
            </div>
            
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="act1"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="inactive">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Prestadores Inactivos</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="inact2"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="SST">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Prestadores Servicio Terminado</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="ter3"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="SSL">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Prestadores Servicio Liberado</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="lib4"></div>
                </div>
            </div>
        </div>
    </div>
   
@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};
            var usersI = {!! $datosI !!};
            var usersL = {!! $datosL !!};
            var usersT = {!! $datosT !!};

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
                virtualDomHoz:true,
                headerFilterPlaceholder: "Buscar..",
                tooltips: true,
            };

            var table = createTabulatorInstance("#act1", users, {
                ...commonConfig,
                groupBy: "nombre_area",
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                      
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                      
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",                 
                    }, {
                        title: "Tipo",
                        field: "tipo",
                        editor: "select",
                        editorParams: {
                            values: {
                                "prestador": "prestador",
                                "coordinador": "coordinador",
                            }
                        },
                    },{
                        title: "Codigo",
                        field: "codigo",
                      
                    },  {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                      
                        editor: "select",
                        editorParams: {
                            values: {
                                "Matutino": "Matutino",
                                "Mediodia": "Mediodia",
                                "Vespertino": "Vespertino",
                                "Tiempo Completo": "Tiempo Completo",
                                "Sabatino": "Sabatino",
                            }
                        },
                    }, {
                        title: "Cumplidas",
                        field: "horas_cumplidas",
                        sorter: "number",
                      
                    },  {
                        title: "Restantes",
                        field: "horas_restantes",
                        sorter: "number",
                      
                    },  {
                        title: "Carrera",
                        field: "carrera",
                        sorter: "string",
                      
                    },{
                        title: "Modificar",
                        field: "id",
                        headerTooltip: "Tras seleccionar el cambio de tipo usuario o turno, presiona este boton para guardar los cambios. Nota: Si cambias al prestador a un horario que no corresponde con su area de trabajo, no se realizará el cambio",
                        formatter: function (cell, formatterParams, onRendered) {
                            var row = cell.getRow();
                            var id = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Modificar";
                            button.title = "";
                            button.addEventListener("click", function() {
                                var value = row.getData().horario;
                                var value2 = row.getData().tipo;
                                modificarHPrestador(id, value);
                                modificarTPrestador(id, value2);
                            });
                            return button;
                        }, 
                      
                    }, {
                        title: "Desactivar",
                        field: "id",
                        width: 135,
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Desactivar";
                            button.title = "";
                            button.addEventListener("click", function() {
                                desactivarPrestador(value);
                            });
                            return button;
                        }, 
                      
                    },
                ],
            });

            var table2 = createTabulatorInstance("#inact2", usersI, {
                ...commonConfig,
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                        
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                        
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                        
                    }, {
                        title: "Activar",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: #4CAF50; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Activar";
                            button.title = "";
                            button.addEventListener("click", function() {
                                activarPrestador(value);
                            });
                            return button;
                        }, 
                        
                    },
                ],
            });

            var table3 = createTabulatorInstance("#ter3", usersT, {
                ...commonConfig,
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                    },
                ],
            });

            var table4 = createTabulatorInstance("#lib4", usersL, {
                ...commonConfig,
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                    }, {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                    }, {
                        title: "Fecha de Salida",
                        field: "fecha_salida",
                        sorter: "number",
                    }, 
                ],
            });

            function fetchData(url, method, callback) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    callback(data);
                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            function modificarTPrestador(id, value) {
                fetchData(`modificar_tipo_prestador/${id}/${value}`, 'GET', data => {
                    console.log('Respuesta del servidor:', data);
                });
            }

            function modificarHPrestador(id, value) {
                fetchData(`modificar_horario_prestador/${id}/${value}`, 'GET', data => {
                    console.log('Respuesta del servidor:', data);
                });
            }

            function desactivarPrestador(value) {
                fetchData(`desactivar_prestador/${value}`, 'GET', data => {
                    console.log('Usuario desactivado:', data);
                });
            }

            function activarPrestador(value) {
                fetchData(`activar_prestador/${value}`, 'GET', data => {
                    console.log('Usuario activado:', data);
                });
            }

        document.addEventListener('DOMContentLoaded', function() {
            function applyCustomFilter(value, table) {
                var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');
                table.setFilter(function(row) {
                    return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                        (row.name && row.name.toLowerCase().includes(searchValue)) || 
                        (row.apellido && row.apellido.toLowerCase().includes(searchValue)) || 
                        (row.correo && row.correo.toLowerCase().includes(searchValue));
                });
            }

            document.getElementById("searchInput").addEventListener("input", function(e) {
                var value = e.target.value.trim();
                applyCustomFilter(value, table);
                applyCustomFilter(value, table2);
                applyCustomFilter(value, table3); 
                applyCustomFilter(value, table4);
            });
        });

    </script>
@endsection

