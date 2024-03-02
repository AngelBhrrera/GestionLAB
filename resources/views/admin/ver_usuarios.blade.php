@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.prestadorHub')}}">Prestadores</a></li>
    <li class="breadcrumb-item active" aria-current="page">General</li>
@endsection

@section('subcontent')

<div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> General Usuarios</h3>
            </div>
    <input id="searchInput" type="text" placeholder="Buscar...">
    <button id="resetButton">Restablecer búsqueda</button>

    <div id="players"></div>
</div>

@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: users,
                layout: "fitColumns",
                pagination: "local",
                resizableColumns: false,  
                paginationSize: 20,
                tooltips: true,

                headerFilterPlaceholder: "Buscar..",
                headerFilterLiveFilter: false,
                
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                       
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter:"string",
                       
                    },  {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        headerFilter: false,
                        headerFilter:"select",
                        headerFilterParams: {
                            "": "", 
                            "prestador": "prestador",
                            "coordinador": "coordinador",
                            "maestro": "maestro",
                            "alumno": "alumno",
                            "practicante": "practicante",
                            "voluntario": "voluntario",
                        }
                    },  {
                        title: "Contacto",
                        field: "telefono",
                    }
                ],
            });


            document.addEventListener('DOMContentLoaded', function() {

                // Función para aplicar el filtro de búsqueda
                function applyCustomFilter(value) {
                // Convertir el valor de búsqueda a minúsculas y remover caracteres especiales y números
                var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                // Aplicar el filtro a las columnas "codigo", "name", "apellido" y "correo"
                table.setFilter(function(row) {
                    return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                        (row.name && row.name.toLowerCase().includes(searchValue)) || 
                        (row.apellido && row.apellido.toLowerCase().includes(searchValue)) || 
                        (row.correo && row.correo.toLowerCase().includes(searchValue));
                });
                }

                    // Evento de cambio en el input de búsqueda
                    document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                    });

                    function resetSearch() {
                        table.clearFilter();
                        document.getElementById("searchInput").value = ""; // Limpiar el campo de búsqueda
                        }

                        // Evento de clic en un botón para restablecer la búsqueda
                        document.getElementById("resetButton").addEventListener("click", function() {
                        resetSearch();
                        });

            });
            
    </script>
@endsection