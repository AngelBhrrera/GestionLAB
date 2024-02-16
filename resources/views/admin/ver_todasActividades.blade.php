@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Actividades</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver todas</li>
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
                resizableColumns: "false",
                paginationSize: 7,
                tooltips: true,
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
                        headerFilter: "input",
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        sorter: "string",
                        editor: "input",
                        headerFilter: "input",
                    }, {
                        title: "Responsable",
                        field: "responsable",
                        sorter: "string",
                        headerFilter: "input",
                    }, {
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                        headerFilter: "input",
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
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
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