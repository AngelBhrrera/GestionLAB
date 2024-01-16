@extends('layouts/admin-layout')

@section('subhead')
<link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registros de Check - in  </h3>
                </div>
                <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height:"100%",
                data: assist,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
                pagination: "local",
                paginationSize: 10,
                tooltips: true,
                columns: [{
                        title: "Prestador",
                        field: "responsable",
                        headerFilter: "input",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                        width: 200,
                    },{
                        title: "Encargado",
                        field: "origen",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                        editor: "select",
                        width: 200,

                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        width: 100,
                        hozAlign: "center",
                    }, {
                        title: "Estado",
                        field: "estado",
                        editor: "select",
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
                        hozAlign: "center",
                        width: 100,
                    },{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        width: 120,
                            sorterParams: {
                                format: "DD/MM/YYYY", 
                            },
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string", 
                        width: 100,
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                        hozAlign: "center",
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string", 
                        width: 100,
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                        hozAlign: "center",
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "string", 
                        width: 100,
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                        hozAlign: "center",
                    },  
                ],
            });

            //trigger download of data.csv file
            $("#download-csv").click(function(){
                $("#example-table").tabulator("download", "csv", "data.csv");
            });

            //trigger download of data.json file
            $("#download-json").click(function(){
                $("#example-table").tabulator("download", "json", "data.json");
            });

            //trigger download of data.xlsx file
            $("#download-xlsx").click(function(){
                $("#example-table-download").tabulator("download", "xlsx", "data.xlsx");
            });


    </script>
@endsection