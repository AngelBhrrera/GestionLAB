@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.actHub')}}">Actividad</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver todas</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Todas las actividades.
</h2>
<input id="searchInput" type="text" placeholder="Buscar...">
<div id="players"></div>
<div style="height: 65px;"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var visits = {!! $data !!};

            var table = new Tabulator("#players", {

                data: visits,
                paginationSize: 20,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                //responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,

                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    },{
                        title: "Prestador",
                        field: "prestador",
                        width: 170,
                    }, {
                        title: "Titulo Act",
                        field: "actividad",
                        sorter: "string",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Asignada": "Asignada",
                            "En proceso": "En Proceso",
                            "En revision": "En revision",
                            "Bloqueada": "Bloqueada",
                            "Error": "Error",
                            "Aprobada": "Aprobada",
                        },
                    }, {
                        title: "Proyecto",
                        field: "proyecto_origen",
                        sorter: "string",
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                    }, {
                        title: "Duracion",
                        field: "duracion",
                    }, {
                        title: "Detalles",
                        field: "detalles",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    },
                    
                ],
            });

            function agregarObservaciones(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`observaciones_actividad/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Observaciones de actividad cambiada', data);
                })
                .catch(error => {
                    console.error('Error al cambiar de estado de impresion:', error);
                });
            } 

            document.addEventListener('DOMContentLoaded', function() {

                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                    table.setFilter(function(row) {
                        return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                            (row.prestador && row.prestador.toLowerCase().includes(searchValue)) || 
                            (row.actividad && row.actividad.toLowerCase().includes(searchValue)) || 
                            (row.estado && row.estado.toLowerCase().includes(searchValue)) || 
                            (row.proyecto && row.proyecto.toLowerCase().includes(searchValue));
                    });
                }

                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });
            });
    </script>
@endsection