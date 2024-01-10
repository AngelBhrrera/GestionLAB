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

    <div id="players"></div>


        <div class="tab-content">
            <div class="tab-pane fade show active" id="impresoras">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Fecha</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->fecha}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Hora Entrada</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_entrada}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Hora Salida</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_salida}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Tiempo</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->tiempo}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Horas</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->horas}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Estado</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->estado}}</p>
                                @endforeach
                            </li>
                        </ul>
            </div>
        </div>
@endsection

@section('script')

    <script type="text/javascript">

            var table = new Tabulator("#players", {
                height: 225,

                layout: "fitColumns",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                columns: [{
                        title: "Nombre",
                        field: "playername",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input"
                    }, {
                        title: "Codigo",
                        field: "price",
                        sorter: "number",
                        hozAlign: "left",
                        formatter: "progress",
                    },
                    {
                        title: "Sede",
                        field: "team",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                        headerFilter: true,
                        headerFilterParams: {
                            "RCB": "RCB",
                            "MI": "MI",
                            "KKR": "KKR",
                        }
                    }, {
                        title: "Fecha",
                        field: "joiningdate",
                        sorter: "date",
                        hozAlign: "center"
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