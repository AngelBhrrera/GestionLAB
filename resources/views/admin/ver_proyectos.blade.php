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
        <div class="text-center mx-auto" style="padding-left: 10px" id="proyectos"></div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
            var proyectos = {!! $tabla_proy !!};
            var table = new Tabulator("#proyectos", {
                height:"100%",
                data: proyectos,
                resizableColumns: "false",
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 10,
                tooltips: true,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Título",
                        field: "titulo",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 300,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreSede(id, value);
                        },
                    },{
                        title: "Estado",
                        field: "estado",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 150,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    }, {
                        title: "Fecha inicio",
                        field: "fecha_inicio",
                    },
                    {
                        title: "Fecha final",
                        field: "fecha_fin",
                    },
                    {
                        title: "Colaboradores",
                        field: "n_prestadores",

                    },
                    {
                        title: "Actividades",
                        field: "n_acts",
                    },
                    {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Detalles";
                            button.title = "";
                            button.addEventListener("click", function() {
                                // Modificar la URL de redirección según la ruta deseada
                                window.location.href = 'ver_detalles_proyecto/'+ value;
                            });
                            return button;
                        }, 
                    },
                ],
            });
            
    </script>
    
@endsection