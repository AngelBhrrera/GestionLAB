@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
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
                    <h3  class="text-2xl font-medium leading-none mt-3"> Registros de Check - in </h3>
                </div>
                <div id="players"></div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')

    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: 525,
                data: assist,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 10,
                tooltips: true,
                columns: [{
                        title: "Encargado",
                        field: "origen",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",

                    },  {
                        title: "Prestador",
                        field: "responsable",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",

                    },{
                        title: "Fecha",
                        field: "fecha_actual",
                        sorter: "joiningdate",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "joiningdate",
                        hozAlign: "center",
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "joiningdate",
                        hozAlign: "center",
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "number",
                        hozAlign: "center"
                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        hozAlign: "center",
                    }, {
                            title: "Estado",
                            field: "accion",
                            formatter: function(cell, formatterParams, onRendered) {
                                return '<button onclick="tuFuncionPersonalizada()">Autorizado/Pendiente/Denegado</button>';
                            },
                            hozAlign: "center",
                            width: 100,
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection