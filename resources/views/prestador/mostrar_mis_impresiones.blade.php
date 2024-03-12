@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('printHub')}}">Impresion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mostrar mias</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Mis impresiones </h3>
                </div>
                <div class="w-[350px] relative mx-5 my-5">
                    <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
                    <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
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
                resizableColumns:false,
                fitColumns: true,
                headerFilterPlaceholder: "Buscar..",
                headerFilterLiveFilter: false,
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
                        headerFilter: "select",
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
            });

            document.addEventListener('DOMContentLoaded', function() {

                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');
                    table.setFilter(function(row) {
                        return (row.impresora && row.impresora.toString().toLowerCase().includes(searchValue)) || 
                            (row.proyecto && row.proyecto.toLowerCase().includes(searchValue)) || 
                            (row.fecha && row.fecha.toLowerCase().includes(searchValue)) || 
                            (row.peso && row.peso.toLowerCase().includes(searchValue)) || 
                            (row.estado && row.estado.toLowerCase().includes(searchValue)) || 
                            (row.piezas && row.piezas.toLowerCase().includes(searchValue)) || 
                            (row.color && row.color.toLowerCase().includes(searchValue)) || 
                            (row.nombre_modelo_stl && row.nombre_modelo_stl.toLowerCase().includes(searchValue));
                    });
                }
                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

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
