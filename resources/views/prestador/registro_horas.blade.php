@extends('layouts/prestador-layout')

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
    <li class="breadcrumb-item active" aria-current="page">Registro de horas</li>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
    </div>
    <div id="players"></div>

@endsection

@section('script')

    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: assist,
                layout: "fitColumns",
                pagination: "local",
                resizableColumns: false,  
                paginationSize: 25,
                tooltips: true,
                columns: [{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        formatter: "datetime",
                        formatterParams: {
                            inputFormat: "DD/MM/YYYY",
                            outputFormat: "DD/MM/YYYY", 
                            invalidPlaceholder: "(Fecha inválida)",
                        },
                        headerFilter: "input",
                        width: 120,
                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        width: 100,
                    }, {
                        title: "Estado",
                        field: "estado",
                        headerFilter: true,
                        headerFilterParams: {
                            "": "", 
                            "autorizado": "autorizado",
                            "pendiente": "pendiente",
                            "denegado": "denegado",
                        },
                        formatter: function(cell, formatterParams, onRendered) {
                            // Mostrar un ícono o texto según el estado
                            var estado = cell.getValue();
                            var icono = "";

                            if (estado === "autorizado") {
                                icono = "✔️";
                            } else if (estado === "pendiente") {
                                icono = "⏳";
                            } else if (estado === "denegado") {
                                icono = "❌";
                            }
                            return icono;
                        },
                        
                    },{
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string",
                        width: 120,
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                        width: 120,
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "number",
                    },  
                    
                ],
            });
            
    </script>
@endsection