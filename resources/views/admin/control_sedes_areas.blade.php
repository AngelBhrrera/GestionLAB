@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Sedes</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 mb-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
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

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#vare">Lista de areas</a>
        </li>
        @if(Auth::user()->tipo == 'Superadmin' )
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#rsed">Registrar sedes</a>
        </li>
        @endif
        @if(Auth::user()->tipo == 'Superadmin' || Auth::user()->tipo == 'jefe sede' || Auth::user()->tipo == 'jefe area')
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#rare">Registrar areas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#aresed">Editar datos area/sede</a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#areh">Editar horarios de areas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#arem">Editar modulos de areas</a>
        </li>
        
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="vare">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Lista de sedes y areas</h3>
                <div class="text-center mx-auto" style="padding-left: 10px" id="areastate"></div>
            </div>
        </div>
        <div class="tab-pane" id="rsed">
            <div class="intro-y box p-5">
                <h3 class="text-2xl mt-5 font-small">Añadir una sede</h3>
                <form action="{{ route('admin.nuevaSede') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombreSede">Nombre de la sede</label>
                        <input required id="nombreSede" type="text" class="form-control" name="nombreSede" placeholder="Nombre">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Crear</button>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="rare">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Añadir un área</h3>
                <form method="POST" action="{{route('admin.nuevaArea')}}">
                    @csrf
                    <div class="form-group">
                        <label for="sede">Selecciona una sede</label>
                        <select class="form-control" name="sede" id="sede" required>
                            @if (isset($s))
                                <option value="null">Selecciona una sede</option>
                                @foreach ($s as $dato)
                                    <option value="{{ $dato->id_sede }}">{{ $dato->nombre_sede }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombreArea">Nombre del área</label>
                        <input required id="nombreArea" type="text" class="form-control" name="nombreArea" placeholder="Nombre de área">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Crear</button>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="areh">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Configurar horarios de las areas</h3>
                <div class="text-center mx-auto" style="padding-left: 10px" id="areahor"></div>
            </div>
        </div>
        <div class="tab-pane" id="arem">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Configurar modulos de las areas</h3>
                <div class="text-center mx-auto" style="padding-left: 10px" id="areamod"></div>
            </div>
        </div>
        <div class="tab-pane" id="aresed">
            @if(Auth::user()->tipo == 'Superadmin' || Auth::user()->tipo == 'jefe sede')
            <div class="intro-y box p-5">
                <h3 class="text-2xl mt-5 font-small">Editar nombre de sede</h3>
                <form action="{{route('admin.modificarSede')}}" method="POST">
                    @csrf
                    <input type="hidden" name="idSede" id="idSede" value="">
                    <select class="form-control" name="sede_edit" id="sede_edit" onchange="modificarCamposSede()">
                        <option value="null">Selecciona una sede</option>
                        @if (isset($s))
                            @foreach ($s as $dato)
                                <option  @if(Auth::user()->tipo == 'jefe sede') selected @endif id="{{$dato->nombre_sede}}" value="{{json_encode($dato)}}">{{$dato->nombre_sede }}</option>
                            @endforeach
                        @endif
                    </select>
                    <br><br>
                    <input required type="text" name="nuevoNombre" id="nuevoNombre" style="width: 40%" placeholder="Nuevo nombre" class="form-control">
                    <br><br>
                    <button type="Submit" disabled id = "guardar" class="btn btn-primary"> Guardar cambios</button>
                </form>
            </div>
            <br>
            @endif
            
        
            <div class="intro-y box p-5">
                <h3 class="text-2xl mt-5 font-small">Editar nombre de area</h3>
                <input type="hidden" id="area_user" value="{{Auth::user()->area}}">
                <input type="hidden" id="bandera" value = @if (Auth::user()->tipo=='jefe sede') 0  @else 1 @endif>
                <form action="{{route('admin.modificarArea')}}" method="POST">
                    @csrf
                    <select class="form-control" name="sede_2" id="sede_2" onchange="filtrarAreaSede()">
                        <option value="null">Selecciona una sede</option>
                        @if (isset($s))
                            @foreach ($s as $dato)
                                <option @if(Auth::user()->tipo == 'jefe area' || Auth::user()->tipo == 'jefe sede') selected @endif id="{{$dato->nombre_sede}}" value="{{$dato->id_sede}}">{{$dato->nombre_sede }}</option>
                            @endforeach
                        @endif
                    </select>
                    <br><br>
                    <select disabled class="form-control" name="area_edit" id="area_edit" onchange="modificarCamposArea()">
                        <option id="default" value="null">Selecciona un área de trabajo</option>
                    </select>
                    <br><br>
                    <input required type="text" name="nuevoNombre_2" id="nuevoNombre_2" style="width: 40%" placeholder="Nuevo nombre" class="form-control">
                    <br><br>
                    <button type="Submit" disabled id ="guardar_2" class="btn btn-primary"> Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div style="height: 65px;"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var sedes = {!! $tabla_sedes !!};

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
                virtualDomHoz:true,
                tooltips: true,
            };

            var table = createTabulatorInstance("#areastate", sedes, {
                ...commonConfig,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre Sede",
                        field: "nombre_sede",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreSede(id, value);
                        },
                    },{
                        title: "Nombre Area",
                        field: "nombre_area",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    },{
                        title: "Prestadores activos del área",
                        field: "total_personal",
                        sorter: "string",
                    }, {
                        title: "Estado",
                        field: "activa",
                        formatter: "tickCross",
                        cellClick: function(e, cell) {

                            var campo = cell.getField();
                            var row = cell.getRow();
                            var id = row.getData().id;
                            console.log("Nombre del campo:", campo);
                            activate(id, campo)
                            cell.setValue(!cell.getValue());
                        },
                    },
                ]
            });

            var table = createTabulatorInstance("#areahor", sedes, {
                ...commonConfig,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre Sede",
                        field: "nombre_sede",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreSede(id, value);
                        },
                    },{
                        title: "Nombre Area",
                        field: "nombre_area",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    },{
                        title: "Horario",
                        columns: [
                            {
                                title: "Matutino",
                                field: "turnoMatutino",
                                headerTooltip: "Horario Matutino de 8 a 12 de la mañana",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }, {
                                title: "Mediodia",
                                field: "turnoMediodia",
                                headerTooltip: "Horario Mediodia de 12 a 4 de la tarde",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            },{
                                title: "Vespertino",
                                field: "turnoVespertino",
                                headerTooltip: "Horario Vespertino de 4 a 8 de la tarde",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            },{
                                title: "Sabatino",
                                field: "turnoSabatino",
                                headerTooltip: "Horario Sabatino de 8 a 2 de la tarde",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }, {
                                title: "Tiempo Completo",
                                field: "turnoTiempoCompleto",
                                headerTooltip: "Horario Especial entre semana para personas sin horario fijo",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }
                        ]
                    }
                ]
            });

            var table = createTabulatorInstance("#areamod", sedes, {
                ...commonConfig,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre Sede",
                        field: "nombre_sede",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreSede(id, value);
                        },
                    },{
                        title: "Nombre Area",
                        field: "nombre_area",
                        sorter: "string",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    }, {
                        title: "Modulos",
                        columns: [
                            {
                                title: "Gamificacion",
                                field: "gamificacion",
                                headerTooltip: "Sistema de experiencia y registro de actividades, leaderboard, categoria, subcategoria y proyectos",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }, {
                                title: "Visitas",
                                field: "visitas",
                                headerTooltip: "Incluye check y registro de visitas y contacto de visitantes al area de trabajo",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            },{
                                title: "Solicitudes",
                                field: "solicitudes",
                                headerTooltip: "Una serie de vistas enfocadas a la administracion de peticiones de solicitudes, capacitaciones, desarrollos e impresiones",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            },{
                                title: "Impresiones",
                                field: "impresiones",
                                headerTooltip: "Vistas enfocadas al registro y gestion de impresoras e impresiones 3D",
                                formatter: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }, 
                        ]
                    },
                ]
            });


        function activate(id, campo) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`activar_area/${id}/${campo}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    //window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error en activacion:', error);
                });
            } 

        function nuevoNombreArea(id, campo) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`area_edit/${id}/${campo}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {

                //window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        } 

        function nuevoNombreSede(id, campo) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`sede_edit/${id}/${campo}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {

                //window.location.reload(); 
            })
            .catch(error => {
                console.error('Error en activacion:', error);
            });
        }

        function modificarCamposSede(){
            btn_guardar= document.getElementById("guardar");
            selectSede = document.getElementById("sede_edit");
            campoNombre = document.getElementById("nuevoNombre");
            idSede=document.getElementById("idSede");
            
            if(selectSede.value === "null"){
                 // Restablecer los campos al estado inicial
                campoNombre.value = "";
                idSede.value = "";
                btn_guardar.disabled = true;
                return;
            }
            btn_guardar.disabled = false;
            var datoSede = JSON.parse(selectSede.value);
            campoNombre.value = datoSede.nombre_sede;
            idSede.value = datoSede.id_sede;
        }

        function filtrarAreaSede(){
            btn_guardar= document.getElementById("guardar_2");
            selectSede = document.getElementById("sede_2");
            selectArea = document.getElementById("area_edit");
            defaultOp =document.getElementById('default');
            nuevoNombreArea = document.getElementById("nuevoNombre_2");
            area_user = document.getElementById("area_user");
            
            if(selectSede.value === "null"){
                // Restablecer los campos al estado inicial
                //campoNombre.value = "";
                btn_guardar.disabled = true;
                selectArea.disabled = true;
                nuevoNombreArea.value = "";
                defaultOp.selected = true;
                return;
            }
            selectArea.innerHTML = '<option id="default" value="null"> Selecciona un área de trabajo</option>';      
            var sedeId = selectSede.value;
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var areas = JSON.parse(xhr.responseText);
                            selectArea.disabled = false;
                            areas.forEach(function(area) {
                                var option = document.createElement('option');
                                option.value = JSON.stringify({id: area.id, nombre: area.nombre_area});
                                option.text = area.nombre_area;
                                selectArea.appendChild(option);
                                if(JSON.parse(option.value).id == area_user.value){
                                    option.selected = true;
                                    btn_guardar.disabled = false;
                                    nuevoNombreArea.value = option.text;
                                }
                            });
                        } else {
                            console.error('Error al obtener las sedes');
                        }
                    }
                }
            xhr.open('GET', 'filtroEditArea/' + sedeId);
            xhr.send();
        }

        function modificarCamposArea(){
            selectArea = document.getElementById("area_edit");
            nuevoNombreArea = document.getElementById("nuevoNombre_2");
            btn_guardar= document.getElementById("guardar_2");
            if(selectArea.value === "null"){
                // Restablecer los campos al estado inicial
                console.log(selectArea.value);
                btn_guardar.disabled = true;
                nuevoNombreArea.value = "";
                return;
            }
            btn_guardar.disabled = false;
            nuevoNombreArea.value = JSON.parse(selectArea.value).nombre;
        }
        window.onload = function() {
            if(document.getElementById("bandera").value == 0){
                modificarCamposSede();
            }
            filtrarAreaSede();
            modificarCamposArea();
        };

    </script>
    
@endsection