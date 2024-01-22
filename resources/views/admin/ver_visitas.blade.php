@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver registro visitas</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
  Registro de Visitas en {{ $sede }}
</h2>

<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var visits = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: visits,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 7,
                tooltips: true,
                columns: [{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        editor: "input",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Responsable",
                        field: "responsable",
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
                        title: "Contacto",
                        field: "numero",
                        hozAlign: "center",
                    }, {
                        title: "Entrada",
                        field: "hora_llegada",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                        hozAlign: "center",
                    },{
                        title: "Motivo",
                        field: "motivo",
                        hozAlign: "center",
                        editor: "input",
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });

            function modificarPrestador(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`modificar_prestador/${value}`, {
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