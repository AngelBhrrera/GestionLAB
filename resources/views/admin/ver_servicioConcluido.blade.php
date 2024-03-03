@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.prestadorHub')}}">Prestadores</a></li>
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
                height: "100%",
                data: users,
                layout: "fitColumns",
                pagination: "local",
                resizableColumns: false,  
                paginationSize: 20,
                tooltips: true,
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
                    },
                ],
            });
            
    </script>
@endsection