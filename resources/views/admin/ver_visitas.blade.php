@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver registro visitas</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('nombre')
                <div class="alert alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#vcli">Lista de clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="vvis">Lista de visitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#chkv">Checkin Visitante</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lisc">Lista de solicitudes por confirmar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lisp">Lista de solicitudes programadas</a>
        </li>
        
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="vcli">
            <div class="w-[350px] relative mx-5 my-5">
                <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
                <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
            </div>
            <div id="players"></div>
        </div>
        <div class="tab-pane active" id="vvis">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
                Registro de Visitas en {{ $sede }}
            </h2>
        </div>
        <div class="tab-pane active" id="chkv">
        </div>
        <div class="tab-pane active" id="lisc">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
               Solicitudes por confirmar (En desarrollo)
            </h2>
        </div>
        <div class="tab-pane active" id="lisp">
            <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
               Solicitudes programadas (En desarrollo)
            </h2>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">

            var visits = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: visits,
                layout: "fitColumns",
                pagination: "local",
                resizableColumns: "false",
                paginationSize: 20,
                headerFilterPlaceholder: "Buscar..",
                headerFilterLiveFilter: false,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    },{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                        width: 110,
                    }, {
                        title: "Nombre",
                        field: "name",
                        sorter: "string",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        editor: "input",
                    }, {
                        title: "Responsable",
                        field: "responsable",
                        sorter: "string",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                    }, {
                        title: "Contacto",
                        field: "numero",
                    }, {
                        title: "Entrada",
                        field: "hora_llegada",
                        sorter: "string",
                    }, {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                    },{
                        title: "Motivo",
                        field: "motivo",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    },
                    
                ],
            });

            document.addEventListener('DOMContentLoaded', function() {

                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');

                    table.setFilter(function(row) {
                        return (row.numero && row.numero.toString().toLowerCase().includes(searchValue)) || 
                            (row.fecha && row.fecha.toLowerCase().includes(searchValue)) || 
                            (row.name && row.name.toLowerCase().includes(searchValue)) || 
                            (row.apellido && row.apellido.toLowerCase().includes(searchValue)) || 
                            (row.correo && row.correo.toLowerCase().includes(searchValue));
                    });
                }

                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

            });

            function agregarObservaciones(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`motivo_visita/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Estado de impresion cambiado', data);
                })
                .catch(error => {
                    console.error('Error al cambiar de estado de impresion:', error);
                });
            } 

            
    </script>
@endsection