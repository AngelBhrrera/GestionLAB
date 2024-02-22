@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.general')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Administradores</li>
@endsection

@section('subcontent')
<div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Administradores</h3>
            </div>
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
                    }, {
                        title: "Telefono",
                        field: "contacto",
                        sorter: "number",
                    }, {
                        title: "Sede",
                        field: "sede",
                        sorter: "string",
                        headerFilter: "input",
                    },  {
                        title: "Area",
                        field: "area",
                        sorter: "string",
                        headerFilter: "input",
                    },{
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        headerFilter: "input",
                    }, {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                        headerFilter: "input",
                    }, 
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection