@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Servicio Concluido</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Prestadores Servicio Concluido (Total de Horas Autorizadas)
</h2>
<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: 500,
                data: users,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 24,
                tooltips: true,
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
                        title: "Liberar",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: #4CAF50; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Liberar";
                            button.title ="";
                            button.addEventListener("click", function() {
                                liberarPrestador(value);
                            });
                            return button;
                        }, 
                        hozAlign: "center",
                    },
                ],
            });

            function liberarPrestador(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`liberar_prestador/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al activar usuario:', error);
                });
            } 
            
    </script>
@endsection