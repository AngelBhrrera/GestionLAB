@extends('layouts/admin-layout')

@section('subhead')

    <style>
        .download-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-right: 10px; /* O ajusta el margen según tus necesidades */
        }
    </style>

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Horas del Servicio</li>
@endsection

@section('subcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registros de Check - in  </h3>
                    <div class="table-controls pl-10">
                        <button class="download-button" id="download-json">Download JSON</button>
                        <button class="download-button" id="download-csv">Download CSV</button>
                        <button class="download-button" id="download-xlsx">Download XLSX</button>
                    </div>
                </div>

                <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
            </div>
        </div>
    </div>
</div>
@endsection

    @section('script')
    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height:"100%",
                data: assist,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
                pagination: "local",
                paginationSize: 12,
                tooltips: true,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Prestador",
                        field: "origen",
                        headerFilter: "input",
                        sorter: "string",
                        width: 200,
                    },{
                        title: "Coordinador",
                        field: "responsable",
                        sorter: "string",
                        headerFilter: "input",
                        width: 200,

                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        width: 70,
                    }, {
                        title: "Estado",
                        field: "estado",
                        width: 70,
                        editor: "select",
                        editorParams: {
                            values: {
                                "autorizado": "autorizado",
                                "pendiente": "pendiente",
                                "denegado": "denegado",
                            }
                        },
                        headerFilter: true,
                        headerFilterParams: {
                            "autorizado": "autorizado",
                            "pendiente": "pendiente",
                            "denegado": "denegado",
                        },
                        formatter: function(cell, formatterParams, onRendered) {
                            var estado = cell.getValue();
                            var icono = "";

                            if (estado === "autorizado") {
                                icono = "✔️";
                            } else if (estado === "pendiente") {
                                icono = "⏳";
                            } else if (estado === "denegado") {
                                icono = "❌";
                            }
                            return icono;
                        },
                        width: 100,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            cambiarEstado(id, value);
                        }
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        width: 120,
                            sorterParams: {
                                format: "DD/MM/YYYY", 
                            },
                        headerFilter: "input",
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string", 
                        width: 100,
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string", 
                        width: 100,
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "string", 
                        width: 100,
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                    },  {
                        title: "Ubicacion",
                        field: "ubicacion",
                        width: 200,
                        formatter: "link",
                        formatterParams: {
                            labelField: "ubicacion",
                            urlPrefix: "",
                            target: "_blank"
                        }
                    },  
                ],
            });

            function cambiarEstado(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`changestate/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Estado de horas cambiado', data);

                    //window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al cambiar de estado:', error);
                });
            } 

            document.getElementById("download-csv").addEventListener("click", function(){
                table.download("csv", "data.csv");
            });
            document.getElementById("download-json").addEventListener("click", function(){
                table.download("json", "data.json");
            });
            document.getElementById("download-xlsx").addEventListener("click", function(){
                table.download("xlsx", "data.xlsx", {sheetName:"My Data"});
            });

            
    </script>
@endsection