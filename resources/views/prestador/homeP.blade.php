@extends('layouts/prestador-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de horas</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
       
    </div>

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

           
            
    </script>
@endsection