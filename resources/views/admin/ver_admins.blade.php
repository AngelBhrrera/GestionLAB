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
    <div class="w-[350px] relative mx-5 my-5">
        <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
        <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
    </div>
    <div id="players"></div>
</div>
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
                height: "100%",
                headerFilterPlaceholder: "Buscar..",
                headerFilterLiveFilter: false,
                columns: [{
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
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
                    },  {
                        title: "Area",
                        field: "area",
                        sorter: "string",
                    },{
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                    }, {
                        title: "Horario",
                        field: "horario",
                        sorter: "string",
                    }, 
                ],

            });

            document.addEventListener('DOMContentLoaded', function() {

                function applyCustomFilter(value) {
                var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                    table.setFilter(function(row) {
                        return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                            (row.name && row.name.toLowerCase().includes(searchValue)) || 
                            (row.apellido && row.apellido.toLowerCase().includes(searchValue)) || 
                            (row.sede && row.sede.toLowerCase().includes(searchValue)) || 
                            (row.area && row.area.toLowerCase().includes(searchValue)) || 
                            (row.tipo && row.tipo.toLowerCase().includes(searchValue)) || 
                            (row.horario && row.horario.toLowerCase().includes(searchValue)) || 
                            (row.correo && row.correo.toLowerCase().includes(searchValue));
                    });
                }

                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

            });
    </script>
    
@endsection