@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Prestadores Activos</li>
@endsection

@section('subcontent')

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
                        hozAlign: "center",
                    },  {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Cumplidas",
                        field: "horas_cumplidas",
                        sorter: "number",
                        hozAlign: "center",
                    },  {
                        title: "Restantes",
                        field: "horas_restantes",
                        sorter: "number",
                        hozAlign: "center",
                    },  {
                        title: "Carrera",
                        field: "carrera",
                        sorter: "string",
                        hozAlign: "center",
                    },{
                        title: "MODIFICAR",
                        hozAlign: "center",
                    },
                    {
                        title: "ELIMINAR",
                        hozAlign: "center",
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection