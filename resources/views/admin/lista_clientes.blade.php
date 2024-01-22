@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
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
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Usuarios</a></li>
<li class="breadcrumb-item active" aria-current="page">Clientes</li>
@endsection

@section('subcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Contacto Clientes  </h3>
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
    @endsection

    @section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height:"100%",
                data: assist,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                groupBy: "tipo",
                columns: [{
                        title: "Nombre",
                        field: "name",
                        headerFilter: "input",
                        sorter: "string",
                        width: 150,
                    }, {
                        title: "Apellido",
                        field: "apellido",
                        headerFilter: "input",
                        sorter: "string",
                        hozAlign: "center",
                        width: 200,
                    },{
                        title: "Correo",
                        field: "correo",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                        width: 200,
                    },  {
                        title: "Telefono",
                        field: "telefono",
                        sorter: "number",
                        width: 100,
                        hozAlign: "center",
                    }, {
                        title: "Codigo",
                        field: "codigo",
                        sorter: "number",
                        width: 120,
                        headerFilter: "input",
                        hozAlign: "center",
                        hozAlign: "center",
                    },
                ],
            });

            function cambiarEstado(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`changestate/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Estado de horas cambiado', data);

                    //window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al cambiar de estado:', error);
                });
            } 

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