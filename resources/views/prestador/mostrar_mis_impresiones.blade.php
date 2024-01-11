@extends('layouts/prestador-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Mostrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresiones</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title">Mis Impresiones</h1>
                </div>
                <div class= "container"></div>
               
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
                height: 500,
                data: printers,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 24,
                tooltips: true,
                columns: [{
                        title: "Impresora",
                        field: "impresora",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Proyecto",
                        field: "proyecto",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        hozAlign: "center",
                    },  {
                        title: "Modelo",
                        field: "nombre_modelo_stl",
                        sorter: "string",
                        hozAlign: "center",
                        headerFilter: "input"
                    }, {
                        title: "Tiempo Impresion",
                        field: "tiempo_impresion",
                        sorter: "number",
                        hozAlign: "center",
                    },  {
                        title: "Color",
                        field: "color",
                        sorter: "string",
                        hozAlign: "center",
                        headerFilter: "input"
                    },  {
                        title: "Piezas",
                        field: "piezas",
                        sorter: "number",
                        hozAlign: "center",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                        headerFilter: true,
                        headerFilterParams: {
                            "autorizado": "autorizado",
                            "pendiente": "pendiente",
                            "denegado": "denegado",
                        }
                    },   {
                        title: "Peso",
                        field: "peso",
                        sorter: "number",
                        hozAlign: "center",
                    },  {
                        title: "Observaciones",
                        field: "observaciones",
                        sorter: "number",
                        hozAlign: "center",
                        formatter: "progress",
                    },
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection
