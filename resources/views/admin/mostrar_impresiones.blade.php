@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
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
                    <h3  class="text-2xl font-medium leading-none mt-3" style="padding-top: 20px; padding-bottom: 20px;"> Registro de Impresiones 3D </h3>
                </div>             
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
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
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
                        sorter: "string",
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
                        hozAlign: "center",
                    },  {
                        title: "Observaciones",
                        field: "observaciones",
                        editor: "input",
                        sorter: "number",
                        hozAlign: "center",
                        cellEdited: function (cell) {
                            
                        },
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });

            function cambiarEstadoImpresion(id, value) {
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

    </script>
@endsection
