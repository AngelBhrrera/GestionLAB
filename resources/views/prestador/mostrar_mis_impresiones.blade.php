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
                height: "100%",
                data: printers,
                pagination: "local",
                paginationSize: 24,
                tooltips: true,
                resizableColumns:false,
                fitColumns: true,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Impresora",
                        field: "impresora",
                        sorter: "string",
                        width: 100,
                        headerFilter: "input",
                    }, {
                        title: "Proyecto",
                        field: "proyecto",
                        sorter: "string",
                        width: 100,
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        width: 100,
                    },  {
                        title: "Modelo",
                        field: "nombre_modelo_stl",
                        sorter: "string",
                        headerFilter: "input",
                        width: 100,
                    }, {
                        title: "Tiempo Impresion",
                        field: "tiempo_impresion",
                        sorter: "number",
                        width: 100,
                    },  {
                        title: "Color",
                        field: "color",
                        sorter: "string",
                        headerFilter: "input",
                        width: 100,
                    },  {
                        title: "Piezas",
                        field: "piezas",
                        sorter: "number",
                        width: 50,
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        editor: "select",
                        width: 130,
                        headerFilter: true,
                        headerFilterParams: {
                            "": "", 
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
                        width: 100,
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
            
    </script>
@endsection
