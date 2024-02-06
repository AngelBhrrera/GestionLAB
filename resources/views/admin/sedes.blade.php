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
                <form method="POST">
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
                        <input required id="nombreArea" type="text" class="form-control" name="nombreArea" placeholder="Nombre">
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
                        width: 300,
                    },{
                        title: "Nombre Area",
                        field: "nombre_area",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 300,
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
                            cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                            activar()
                        },
                    }, {
                        title: "Horario",
                        columns: [
                            {
                                title: "Matutino",
                                field: "turnoMatutino",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            }, {
                                title: "Mediodia",
                                field: "turnoMediodia",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            },{
                                title: "Vespertino",
                                field: "turnoVespertino",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            },{
                                title: "Sabatino",
                                field: "turnoSabatino",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            }, {
                                title: "Tiempo Completo",
                                field: "turnoTiempoCompleto",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
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
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            }, {
                                title: "Visitas",
                                field: "visitas",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            },{
                                title: "Solicitudes",
                                field: "solicitudes",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            },{
                                title: "Impresiones",
                                field: "impresiones",
                                width: 100,
                                formatter: "tickCross",
                                editor: "tickCross",
                                cellClick: function(e, cell) {
                                    cell.setValue(!cell.getValue()); // Cambia el valor al hacer clic
                                },
                            }, 
                        ]
                    },
                ],
            });
    </script>

<script>
        function modificarCamposSede(){
            
            checks= document.querySelectorAll('.form-check-input');
            
            if(document.getElementById("sede").value === "null"){
                 // Restablecer los campos al estado inicial
                 document.getElementById("nuevoNombre").value = "";
                 document.getElementById("idSede").value = "";
                document.getElementById("guardar").disabled = true;
                for(var check of checks){
                    check.checked = false;
                }
                return;
            }
            document.getElementById("guardar").disabled = false;
            document.getElementById("nuevoNombre").value=datoSede.nombre_sede;
            document.getElementById("idSede").value = datoSede.id_sede;
            datoSede = JSON.parse(document.getElementById("sede").value);

            const propiedades = ['activa', 'turnoMatutino', 'turnoMediodia', 'turnoVespertino', 'turnoSabatino', 'turnoTiempoCompleto'];

            propiedades.forEach((propiedad, index) => {
                const checkbox = checks[index];
                checkbox.checked = datoSede[propiedad] == 1;
            });
            
        }
        setTimeout(function(){

            document.getElementById("alerta").style.display="none";

        }, 4000);
    </script>
    
@endsection