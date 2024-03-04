@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver todos</li>
@endsection

@section('subcontent')


    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
            Lista de proyectos
        </h2>
        <input id="searchInput" type="text" placeholder="Buscar...">
        <div class="text-center mx-auto" style="padding-left: 10px" id="proyectos"></div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
            var proyectos = {!! $tabla_proy !!};
            var table = new Tabulator("#proyectos", {
                data: proyectos,
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
                    }, {
                        title: "Título",
                        field: "titulo",
                    }, {
                        title: "Estado",
                        field: "estado",
                        editor: "select",
                        editorParams: {
                            values: {
                                "Creado": "Creado",
                                "En Desarrollo": "En desarrollo",
                                "Finalizado": "Finalizado",
                                "Cancelado": "Cancelado",
                            }
                        },
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Creado": "Creado",
                            "En Desarrollo": "En desarrollo",
                            "Finalizado": "Finalizado",
                            "Cancelado": "Cancelado",
                        },
                    }, {
                        title: "Fecha inicio",
                        field: "fecha_inicio",
                    }, {
                        title: "Fecha final",
                        field: "fecha_fin",
                    },  {
                        title: "Turno",
                        field: "turno",
                        headerFilter:"select",
                        headerFilterParams: {
                            "": "", 
                            "matutino": "Matutino",
                            "mediodia": "Mediodia",
                            "vespertino": "Vespertino",
                            "sabatino": "Sabatino",
                            "no aplica": "No Aplica",
                        },
                    },{
                        title: "Colaboradores",
                        field: "n_prestadores",

                    }, {
                        title: "Totales",
                        field: "n_acts",
                    },  {
                        title: "Completadas",
                        field: "conteo_terminado",
                    },{
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Detalles";
                            button.title = "";
                            button.addEventListener("click", function() {
                                window.location.href = 'ver_detalles_proyecto/'+ value;
                            });
                            return button;
                        }, 
                    },
                ],
            });

            document.addEventListener('DOMContentLoaded', function() {
                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                    table.setFilter(function(row) {
                        return (row.titulo && row.titulo.toString().toLowerCase().includes(searchValue)) || 
                            (row.fecha_fin && row.fecha_fin.toLowerCase().includes(searchValue)) || 
                            (row.fecha_inicio && row.fecha_inicio.toLowerCase().includes(searchValue));
                    });
                }

                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

                });
            
    </script>
    
@endsection