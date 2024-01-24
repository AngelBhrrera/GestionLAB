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
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresion</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-5" style="padding-top: 20px; padding-bottom: 20px;"> Registro de Impresiones 3D </h3>
                </div>    

                <div class="table-controls pl-10">
                    <button class="download-button" id="download-json">Download JSON</button>
                    <button class="download-button" id="download-csv">Download CSV</button>
                    <button class="download-button" id="download-xlsx">Download XLSX</button>
                </div>

                <br>

                <div id="players"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">

            var printers = {!! $impresiones !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: printers,
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
                        title: "Impresora",
                        field: "impresora",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input",
                    }, {
                        title: "Proyecto",
                        field: "proyecto",
                        sorter: "string",
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                    },  {
                        title: "Modelo",
                        field: "nombre_modelo_stl",
                        sorter: "string",
                        headerFilter: "input"
                    }, {
                        title: "Duracion",
                        field: "tiempo_impresion",
                        sorter: "number",
                    },  {
                        title: "Color",
                        field: "color",
                        sorter: "string",
                        headerFilter: "input"
                    },  {
                        title: "Piezas",
                        field: "piezas",
                        sorter: "number",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: true,
                        headerFilterParams: {
                            "Exitoso": "Exitoso",
                            "En Proceso": "En Proceso",
                            "Fallido": "Fallido",
                        },
                        editor: "select",
                        editorParams: {
                            values: {
                                "Exitoso": "Exitoso",
                                "En Proceso": "En Proceso",
                                "Fallido": "Fallido",
                            }
                        },
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            cambiarEstadoImpresion(id, value);
                        }
                    },   {
                        title: "Peso",
                        field: "peso",
                        sorter: "number",
                    },  {
                        title: "Observaciones",
                        field: "observaciones",
                        editor: "input",
                        width: 350,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });

            function cambiarEstadoImpresion(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`changestate_print/${id}/${value}`, {
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

            function agregarObservaciones(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`observaciones_impresion/${id}/${value}`, {
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
