@extends('layouts/prestador-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de horas</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
       
    </div>

    <br>

    <div id="players"></div>
@endsection

@section('script')

    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {
                height: 525,
                data: assist,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                columns: [{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "joiningdate",
                        width: 150,
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "joiningdate",
                        hozAlign: "center",
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "joiningdate",
                        hozAlign: "center",
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "number",
                        hozAlign: "center"
                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        hozAlign: "center",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                        headerFilter: true,
                        headerFilterParams: {
                            "autorizado": "autorizado",
                            "pendiente": "pendiente",
                            "denegado": "denegado",
                        }
                    },
                    
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });


            $.ajax({
                url: 'users.php', 
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    table.setData(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            
    </script>
@endsection