@extends('layouts/admin-layout')

@section('subhead')

    <style>
        .download-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-right: 10px; /* O ajusta el margen según tus necesidades */
        }
    </style>

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Horas del Servicio</li>
@endsection

@section('subcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registros de Check - in  </h3>
                </div>

                <div class="table-controls pl-10">
                    <button class="download-button" id="download-json">Download JSON</button>
                    <button class="download-button" id="download-csv">Download CSV</button>
                    <button class="download-button" id="download-xlsx">Download XLSX</button>
                </div>

                <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
            </div>
        </div>
    </div>
    
    <div style="height: 45px;"></div>
    @endsection

    @section('script')
    
    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {

                data: assist,
                paginationSize: 12,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                //responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,

                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                    }, {
                        title: "Prestador",
                        field: "origen",
                        headerFilter: "input",
                        sorter: "string",
                    },{
                        title: "Coordinador",
                        field: "responsable",
                        sorter: "string",
                        headerFilter: "input",

                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                    },  {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                            sorterParams: {
                                format: "DD/MM/YYYY", 
                            },
                        headerFilter: "input",
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                    },{
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                    },  
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