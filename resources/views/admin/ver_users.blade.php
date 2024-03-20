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
    <li class="breadcrumb-item active" aria-current="page">Prestadores Activos</li>
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
            @error('descripcion')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#u">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#a">Admins</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#p">Prestadores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#v">Clientes - Visitantes</a>
        </li>
    </ul>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @if(session('error'))
                <div class="alert mb-5 alert-danger w-full px-4">{{session('error')}}</div>
            @endif
            </div>
        </div>
    </div>
    <div class="w-[350px] relative mx-5 my-5">
        <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
        <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="u">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Todos los Usuarios</h3>
            </div>
            
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="allU"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="a">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Todos lso Administradores</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="allA"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="p">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Todos los Prestadores</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="allP"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="v">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Todos los Clientes - Visitantes</h3>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="allV"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Modal Content -->
    <div id="static-backdrop-modal-preview" id="editarFestivo"class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5"></div>
                        <h2 class="text-2xl mt-5 font-small">Modificar horario/tipo de prestador</h2><br>
                        <label for="nombre">Nombre</label>
                        <input id="nombre" readonly value="" type="text" class="form-control" name="nombre" placeholder="nombre" style="width: 200px">
                        <br><label for="apellido">Apellido</label>
                        <input id="apellido" readonly value="" type="text" class="form-control mt-5" name="apellido" placeholder="apellido" style="width: 200px">
                        
                        
                        <form action="{{route('api.modificar_prestador')}}" method="POST">
                            @csrf
                            <label for="codigo">Código</label>
                            <input id="codigo" readonly value="" type="text" class="form-control mt-5" name="codigo" placeholder="codigo" style="width: 200px">
                            <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                                <br>
                                <label class="mr-5" for="tipo_prest">Tipo</label>
                                <select class="form-control" name="tipo_prest" id="tipo_prest" style="width: 200px">
                                    <option id="prestador" value="prestador">Prestador</option>
                                    <option id="coordinador" value="coordinador">Coordinador</option>
                                    <option id="voluntario" value="voluntario">Voluntario</option>
                                    <option id="practicante" value="practicante">Practicante</option>
                                </select>
                                <br><br>
                                <label  for="horario_prest">Horario</label>
                                <select class="form-control" name="horario_prest" id="horario_prest" style="width: 200px">
                                    @foreach ($horariosValidos as $horario )
                                        @if ($horario)
                                            <option value="{{$horario}}" id="{{$horario}}">{{$horario}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                                <br>
                                <br><br>
                                <div class="text-center">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Cancelar</button>
                                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};
            var usersV = {!! $datosV !!};
            var usersA = {!! $datosA !!};
            var usersP = {!! $datosP !!};

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

            var table = createTabulatorInstance("#allU", users, {
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
                        title: "Codigo",
                        field: "codigo",
                        sorter:"string",
                       
                    },  {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        headerFilter: false,
                        headerFilter:"select",
                        headerFilterParams: {
                            "": "", 
                            "prestador": "prestador",
                            "coordinador": "coordinador",
                            "maestro": "maestro",
                            "alumno": "alumno",
                            "practicante": "practicante",
                            "voluntario": "voluntario",
                        }
                    },  {
                        title: "Contacto",
                        field: "telefono",
                    }
                ],
            });

            var table2 = createTabulatorInstance("#allV", usersV, {
                ...commonConfig,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    },{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                        width: 110,
                    }, {
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        editor: "input",
                    }, {
                        title: "Responsable",
                        field: "responsable",
                        sorter: "string",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                    }, {
                        title: "Contacto",
                        field: "numero",
                    }, {
                        title: "Entrada",
                        field: "hora_llegada",
                        sorter: "string",
                    }, {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                    },{
                        title: "Motivo",
                        field: "motivo",
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

            var table3 = createTabulatorInstance("#allA", usersA, {
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
                        title: "Telefono",
                        field: "contacto",
                        sorter: "number",
                    }, {
                        title: "Sede",
                        field: "sede",
                        sorter: "string",
                    },  {
                        title: "Area",
                        field: "area",
                        sorter: "string",
                    },{
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                    }, {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                    }, 
                ],
            });

            var table4 = createTabulatorInstance("#allP", usersP, {
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
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                    },{
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                      
                    },  {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",

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
                        field: "datos",
                        headerTooltip: "Tras seleccionar el cambio de tipo usuario o turno, presiona este boton para guardar los cambios. Nota: Si cambias al prestador a un horario que no corresponde con su area de trabajo, no se realizará el cambio",
                        formatter: customButtonFormatter, 
                      
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

            function customButtonFormatter(cell, formatterParams, onRendered) {
            var div = document.createElement("div");
            div.classList.add("text-center");
            
            var a = document.createElement("a");
            a.href = "javascript:;";
            a.setAttribute("data-tw-toggle", "modal");
            a.setAttribute("data-tw-target", "#static-backdrop-modal-preview");
            a.classList.add("btn", "btn-primary");
            a.textContent = "Modificar";

            div.appendChild(a);
            a.addEventListener('click', function(){
                var data = cell.getRow().getData();
                document.getElementById('nombre').value = data.name;
                document.getElementById('apellido').value = data.apellido;
                document.getElementById('codigo').value = data.codigo;
                const tipo_prest = document.getElementById('prestador');//Opción Prestador
                const tipo_coord = document.getElementById('coordinador');//Opción coordinador
                const tipo_vol = document.getElementById('voluntario');//Opción Voluntario  
                const tipo_pract = document.getElementById('practicante');//Opción Practicante
                if( tipo_prest.value == data.tipo){
                    tipo_prest.selected = true;
                }else{
                    tipo_coord.selected = true;
                }
                switch(data.tipo) {
                    case "prestador":
                        tipo_prest.selected = true;
                        break;
                    case "coordinador":
                        tipo_coord.selected = true;
                        break;
                    case "voluntario":
                        tipo_vol.selected = true;
                        break;
                    case "practicante":
                        tipo_pract.selected = true;
                        break;
                    default:
                        console.log("Opción no reconocida");
                }

                const select_horario = document.getElementById('horario');
                switch(data.horario){
                    case "Matutino":
                        document.getElementById('Matutino').selected = true;
                        break;
                    case "Mediodia":
                        document.getElementById('Mediodia').selected = true;
                        break;
                    case "Vespertino":
                        document.getElementById('Vespertino').selected = true;
                        break;
                    case "Sabatino":
                        document.getElementById('Sabatino').selected = true;
                        break;
                    case "TC":
                        document.getElementById('TC').selected = true;
                        break;
                    default:
                        document.getElementById('No Aplica').selected = true;
                        break;
                    
                }
            });
            return div;
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

        function agregarObservaciones(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`motivo_visita/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Estado de impresion cambiado', data);
                })
                .catch(error => {
                    console.error('Error al cambiar de estado de impresion:', error);
                });
            } 

    </script>
@endsection

