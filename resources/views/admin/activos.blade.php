@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.general')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Prestadores Activos</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Prestadores Activos
</h2>

<div id="players"></div>
<div style="height: 65px;"></div>
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
                responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,

                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                        headerFilter: "input",
                      
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        headerFilter: "input",
                      
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                        headerFilter: "input",
                      
                    }, {
                        title: "Tipo",
                        field: "tipo",
                        editor: "select",
                        editorParams: {
                            values: {
                                    "prestador": "prestador",
                                    "coordinador": "coordinador",
                                }
                        },
                      
                    },{
                        title: "Codigo",
                        field: "codigo",
                      
                    },  {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                      
                        editor: "select",
                        editorParams: {
                            values: {
                                "Matutino": "Matutino",
                                "Mediodia": "Mediodia",
                                "Vespertino": "Vespertino",
                                "Tiempo Completo": "Tiempo Completo",
                                "Sabatino": "Sabatino",
                            }
                        },
                    }, {
                        title: "Cumplidas",
                        field: "horas_cumplidas",
                        sorter: "number",
                      
                    },  {
                        title: "Restantes",
                        field: "horas_restantes",
                        sorter: "number",
                      
                    },  {
                        title: "Carrera",
                        field: "carrera",
                        sorter: "string",
                      
                    },{
                        title: "Modificar",
                        field: "id",
                        width: 120,
                        formatter: function (cell, formatterParams, onRendered) {
                            var row = cell.getRow();
                            var id = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Modificar";
                            button.title = "";
                            button.addEventListener("click", function() {
                                var value = row.getData().horario;
                                var value2 = row.getData().tipo;
                                modificarHPrestador(id, value);
                                modificarTPrestador(id, value2);
                            });
                            return button;
                        }, 
                      
                    }, {
                        title: "Desactivar",
                        field: "id",
                        width: 135,
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Desactivar";
                            button.title = "";
                            button.addEventListener("click", function() {
                                desactivarPrestador(value);
                            });
                            return button;
                        }, 
                      
                    },
                ],
            });

            function modificarTPrestador(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`modificar_tipo_prestador/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al activar usuario:', error);
                });
            } 

            function modificarHPrestador(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`modificar_horario_prestador/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    //window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al activar usuario:', error);
                });
            } 

            
            function desactivarPrestador(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`desactivar_prestador/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Usuario desactivado:', data);

                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al desactivar usuario:', error);
                });
            } 

            
    </script>
@endsection