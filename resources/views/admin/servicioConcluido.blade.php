@extends('layouts/admin-layout')

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
                    },
                ],
            });
            
    </script>
@endsection