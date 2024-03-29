@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.general')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">General</li>
@endsection

@section('subcontent')

<div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> General Usuarios</h3>
            </div>
    <div id="players"></div>
</div>
<div style="height: 45px;"></div>
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
                groupStartOpen: false,
                groupBy:"nombre_area",
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
                        title: "Codigo",
                        field: "codigo",
                       
                    },  {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                       
                        headerFilter: true,
                        headerFilterParams: {
                            "": "",
                            "prestador": "prestador",
                            "Coordinador": "coordinador",
                            "maestro": "maestro",
                            "alumno": "alumno",
                            "practicante": "practicante",
                            "voluntario": "voluntario",
                        }
                    },  {
                        title: "Contacto",
                        field: "telefono",
                        sorter: "number",
                       
                    },
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection