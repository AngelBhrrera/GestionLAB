@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a>Mostrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresiones</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Mis impresiones </h3>
                </div>
                <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
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
                        editor:"input",
                    },
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection
