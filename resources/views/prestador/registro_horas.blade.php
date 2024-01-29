@extends('layouts/prestador-layout')

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
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Registro de horas</li>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
    </div>
    <br>
    <div class="table-controls pl-10">
                    <button class="download-button" id="download-json">Download JSON</button>
                    <button class="download-button" id="download-csv">Download CSV</button>
                    <button class="download-button" id="download-xlsx">Download XLSX</button>
    </div>
    <br>
    <div id="players"></div>

@endsection

@section('script')

    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: 525,
                data: assist,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                columns: [{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "joiningdate",
                        width: 150,
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        hozAlign: "center",
                        width: 100,
                    }, {
                        title: "Estado",
                        field: "estado",
                        hozAlign: "center",
                        width: 100,
                        headerFilter: true,
                        headerFilterParams: {
                            "autorizado": "autorizado",
                            "pendiente": "pendiente",
                            "denegado": "denegado",
                        },
                        formatter: function(cell, formatterParams, onRendered) {
                            // Mostrar un ícono o texto según el estado
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
                        
                    },{
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string",
                        hozAlign: "center",
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "number",
                        hozAlign: "center"
                    },  
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });

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