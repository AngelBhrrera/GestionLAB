@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
@endsection

@section('subcontent')

<div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> General Usuarios</h3>
            </div>
        <div class="w-[350px] relative mx-5 my-5">
            <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
            <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
        </div>
    <button id="resetButton">Restablecer búsqueda</button>

    <div id="players"></div>
</div>

@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};

            var table = new Tabulator("#players", {

                data: users,
                paginationSize: 20,
                groupBy: "nombre_area",

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                //responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,

                groupStartOpen: true,
                groupBy:"nombre_area",

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
                    }, {
                        title: "Eliminar",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Eliminar usuario";
                            button.addEventListener("click", function() {
                                eliminarUsuario(value);
                            });
                            return button;
                        }, 
                        
                    },
                ],
            });

            function eliminarUsuario(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`eliminar_prestador/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Usuario activado:', data);

                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al activar usuario:', error);
                });
            } 

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