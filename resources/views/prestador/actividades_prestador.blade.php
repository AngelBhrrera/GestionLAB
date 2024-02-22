@extends('layouts/prestador-layout')
@section('content')


@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active">Actividades</li>
            <li class="breadcrumb-item active" aria-current="page">Mis actividades</li>
        </ol>
    </nav>
@endsection

@section('subcontent')
<div class="container">
    <h1 class="text-center">Mis Actividades</h1>
    <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
</div>
@endsection


@section('script')
    <script type="text/javascript">

            var printers = {!! $impresiones !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: printers,
                pagination: "local",
                layout: "fitColumns",
                paginationSize: 24,
                tooltips: true,
                resizableColumns:false,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre de la actividad",
                        field: "titulo",
                        sorter: "string",
                        headerFilter: "input",
                        width: 120,
                    },  {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: "input",
                        width: 100
                    },{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        width: 120,
                    }, {
                        title: "TEC",
                        field: "TEC",
                        sorter: "number",
                        width: 65,
                    },  {
                        title: "TEU",
                        field: "TEU",
                        sorter: "number",
                        width: 65,
                    },  {
                        title: "Inversion",
                        field: "Tiempo_Invertido",
                        sorter: "number",
                        width: 65,
                    }, {
                        title: "Tiempo",
                        field: "Tiempo_Real",
                        sorter: "number",
                        width: 65,
                    }, {
                        title: "Experiencia",
                        field: "exp",
                        sorter: "number",
                        width: 75,
                    },  {
                        title: "Detalles",
                        field: "detalles",
                        editor: "input",
                        width: 290,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
                    }, {
                        title: "",
                        field: "id_actividad",
                        width: 120,
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Más Info.";
                            button.title = "";
                            button.addEventListener("click", function() {
                                window.location.href = "detalles_actividad/" + value;
                            });
                            return button;
                        }, 
                      
                    },
                ],
            });

            function agregarObservaciones(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`observaciones_actividad/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Observaciones de actividad cambiada', data);
                })
                .catch(error => {
                    console.error('Error al cambiar de estado de impresion:', error);
                });
            } 
            
    </script>
@endsection
