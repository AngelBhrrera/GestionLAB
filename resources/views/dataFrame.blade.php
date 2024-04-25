@extends('layouts/main')



@section('content')
<div class="container">
    <div class="card-header">
        <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">Dataframe utilizado para la prediccion </h3>
        <div class="table-controls pl-10">
            <button class="download-button" id="download-json">Download JSON</button>
            <button class="download-button" id="download-csv">Download CSV</button>
            <button class="download-button" id="download-xlsx">Download XLSX</button>
        </div>               
    </div>
    <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
</div>

    <script type="text/javascript">

            var data = {!! $data !!};

            var table = new Tabulator("#players", {
               
                data: data,
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
                        sorter: "string",
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
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }
                ],
            });

            document.getElementById("download-csv").addEventListener("click", function(){
                table.download("csv", "data.csv");
            });
            document.getElementById("download-json").addEventListener("click", function(){
                table.download("json", "data.json");
            });
            document.getElementById("download-xlsx").addEventListener("click", function(){
                table.download("xlsx", "data.xlsx", {sheetName:"My Data"});
            });
    </script>
@endsection
