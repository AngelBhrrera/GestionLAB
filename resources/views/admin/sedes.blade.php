@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestionar</li>
    <li class="breadcrumb-item active" aria-current="page">Sedes</li>
@endsection

@section('subcontent')

    <h2 class="text-2xl mt-5 font-medium pl-5">Gestion de sede</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
            @foreach(['success', 'warning', 'danger'] as $alertType)
                @if(session($alertType))
                    <h6 class="alert alert-{{ $alertType }}">{{ session($alertType) }}</h6>
                @endif
            @endforeach
            @error('nombre')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
        </div>
    </div>
    
    <div class="intro-y box p-5 mt-5">
        <h3 class="text-2xl mt-5 font-small">Lista de sedes y areas</h3>
        <div class="text-center mx-auto" style="padding-left: 10px" id="sedes"></div>
    </div>

    <div class="row mt-5">
    @if(Auth::user()->tipo == 'Superadmin')
        <div class="col-md-6">
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
    @endif


        <div class="col-md-6">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Añadir un área</h3>
                <form method="POST" action="{{route('admin.nuevaArea')}}">
                    @csrf
                    <div class="form-group">
                        <label for="sede">Selecciona una sede</label>
                        <select class="form-control" name="sede" id="sede">
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
    </div>

    <div style="height: 65px;"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var sedes = {!! $tabla_sedes !!};

            var table = new Tabulator("#sedes", {
                height:"100%",
                data: sedes,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
                pagination: "local",
                paginationSize: 10,
                tooltips: true,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre Sede",
                        field: "nombre_sede",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
<<<<<<< Updated upstream
                        width: 300,
=======
                        width: 150,
>>>>>>> Stashed changes
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreSede(id, value);
                        },
                    },{
                        title: "Nombre Area",
                        field: "nombre_area",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 300,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    },{
                        title: "Asistentes",
                        field: "total_personal",
                        width: 100,
                        sorter: "string",
                    }, {
                        title: "Estado",
                        field: "activa",
                        width: 100,
                        formatter: "tickCross",
                        editor: "tickCross",
                        cellClick: function(e, cell) {

                            var campo = cell.getField();
                            var row = cell.getRow();
                            var id = row.getData().id;
                            console.log("Nombre del campo:", campo);
                            activate(id, campo)
                            cell.setValue(!cell.getValue());
                        },
                    }, {
                        title: "Horario",
                        columns: [
                            {
                                title: "Matutino",
                                field: "turnoMatutino",
                                width: 100,
                                headerTooltip: "Horario Matutino de 8 a 12 de la mañana",
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                headerTooltip: "Horario Mediodia de 12 a 4 de la tarde",
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                headerTooltip: "Horario Vespertino de 4 a 8 de la tarde",
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                headerTooltip: "Horario Sabatino de 8 a 2 de la tarde",
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                headerTooltip: "Horario Especial entre semana para personas sin horario fijo",
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    var campo = cell.getField();
                                    var row = cell.getRow();
                                    var id = row.getData().id;
                                    activate(id, campo)
                                    cell.setValue(!cell.getValue());
                                },
                            }
                        ]
                    }, { 
                        title: "", 
                        field: "", 
                        formatter: "html", 
                        width: 5, 
                        formatterParams: { value: " | " } 
                    }, {
                        title: "Modulos",
                        columns: [
                            {
                                title: "Gamificacion",
                                field: "gamificacion",
                                headerTooltip: "Sistema de experiencia y registro de actividades, leaderboard, categoria, subcategoria y proyectos",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                headerTooltip: "Una serie de vistas enfocadas a la administracion de peticiones de solicitudes, capacitaciones, desarrollos e impresiones",
                                formatter: "tickCross",
                                editor: "tickCross",
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
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
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
                ],
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

    </script>
    
@endsection