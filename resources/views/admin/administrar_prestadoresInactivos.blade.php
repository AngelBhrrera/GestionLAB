@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.prestadorHub')}}">Prestadores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Inactivos</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Prestadores Inactivos
</h2>
<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};

            var table = new Tabulator("#players", {

                data: users,
                paginationSize: 10,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",

                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: #4CAF50; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Activar";
                            button.title ="";
                            button.addEventListener("click", function() {
                                activarPrestador(value);
                            });
                            return button;
                        }, 
                        hozAlign: "center",
                    },
                    {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Eliminar";
                            button.title ="";
                            button.addEventListener("click", function() {
                                eliminarPrestador(value);
                            });
                            return button;
                        }, 
                        hozAlign: "center",
                    },
                ],
            });

            function activarPrestador(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`activar_prestador/${value}`, {
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
            function eliminarPrestador(value) {
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
    </script>
@endsection