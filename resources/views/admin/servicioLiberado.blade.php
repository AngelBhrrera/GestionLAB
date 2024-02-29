@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.general')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Servicio Liberado</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Prestadores Servicio Liberado (fecha de salida)
</h2>
<div class="container" id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var users = {!! $datos !!};

            var table = new Tabulator("#players", {
               
                data: users,
                paginationSize: 20,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,

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
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                        headerFilter: "input",
                    }, {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        headerFilter: "input",
                    }, {
                        title: "Fecha de Salida",
                        field: "fecha_salida",
                        sorter: "number",
                        headerFilter: "input",
                    }, 
                ],
            });
            
    </script>
@endsection