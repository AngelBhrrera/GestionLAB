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
               
                data: printers,
                paginationSize: 20,
                tooltips: true,
                
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                
               
                columns: [{
                        title: "Nombre de la actividad",
                        field: "titulo",
                        sorter: "string",
                        headerFilter: "input",
                    },  {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: "input",
                    },{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                    }, {
                        title: "TEC",
                        field: "TEC",
                        sorter: "number",
                        headerTooltip: "Tiempo Estimado Compromiso que coordinacion valoro para la actividad",
                    },  {
                        title: "TEU",
                        field: "TEU",
                        sorter: "number",
                        headerTooltip: "Tiempo Estimado del Usuario para terminar la actividad",
                    },  {
                        title: "TI",
                        field: "Tiempo_Invertido",
                        headerTooltip: "Total de tiempo invertido en la actividad",
                        sorter: "number",
                    }, {
                        title: "TR",
                        field: "Tiempo_Real",
                        headerTooltip: "Total de tiempo que tomo realizar la actividad",
                        sorter: "number",
                    }, {
                        title: "XP",
                        field: "exp",
                        sorter: "number",
                        headerTooltip: "Calculo en funcion al TEC, TEU y TR de tu rendimiento en la actividad",
                    }, {
                        title: "",
                        field: "id_actividad",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "+";
                            button.title = "";
                            button.addEventListener("click", function() {
                                window.location.href = "detalles_actividad/" + value;
                            });
                            return button;
                        }, 
                    }, {
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }
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
