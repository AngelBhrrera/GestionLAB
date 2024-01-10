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
    var tabledata = [{
                    playerid: 1,
                    playername: "Virat Kohli",
                    price: "40",
                    team: "RCB",
                    joiningdate: "01/01/2020"
                }, {
                    playerid: 2,
                    playername: "Rohit Sharma",
                    price: "150",
                    team: "MI",
                    joiningdate: "02/01/2020"
                }, {
                    playerid: 3,
                    playername: "MS Dhoni",
                    price: "15",
                    team: "CSK",
                    joiningdate: "03/01/2020"
                }, {
                    playerid: 4,
                    playername: "Shreyas Iyer",
                    price: "7",
                    team: "RCB",
                    joiningdate: "04/01/2020"
                }, {
                    playerid: 5,
                    playername: "KL Rahul",
                    price: "11",
                    team: "KXIP",
                    joiningdate: "05/01/2020"
                }, {
                    playerid: 6,
                    playername: "Dinesh Karthik",
                    price: "7",
                    team: "KKR",
                    joiningdate: "06/01/2020"
                }, {
                    playerid: 7,
                    playername: "Steve Smith",
                    price: "12",
                    team: "RR",
                    joiningdate: "07/01/2020"
                }, {
                    playerid: 8,
                    playername: "David Warner",
                    price: "120",
                    team: "SRH",
                    joiningdate: "08/01/2020"
                }, {
                    playerid: 9,
                    playername: "Kane Williamson",
                    price: "3",
                    team: "SRH",
                    joiningdate: "09/01/2020"
                }, {
                    playerid: 10,
                    playername: "Jofra Archer",
                    price: "7",
                    team: "RR",
                    joiningdate: "10/01/2020"
                }, {
                    playerid: 11,
                    playername: "Andre Russell",
                    price: "9",
                    team: "KKR",
                    joiningdate: "11/01/2020"
                }, {
                    playerid: 12,
                    playername: "Chris Gayle",
                    price: "2",
                    team: "KXIP",
                    joiningdate: "12/01/2020"
                },
                {
                    playerid: 1,
                    playername: "Virat Kohli",
                    price: "40",
                    team: "RCB",
                    joiningdate: "01/01/2020"
                }, {
                    playerid: 2,
                    playername: "Rohit Sharma",
                    price: "150",
                    team: "MI",
                    joiningdate: "02/01/2020"
                }, {
                    playerid: 3,
                    playername: "MS Dhoni",
                    price: "15",
                    team: "CSK",
                    joiningdate: "03/01/2020"
                }, {
                    playerid: 4,
                    playername: "Shreyas Iyer",
                    price: "7",
                    team: "RCB",
                    joiningdate: "04/01/2020"
                }, {
                    playerid: 5,
                    playername: "KL Rahul",
                    price: "11",
                    team: "KXIP",
                    joiningdate: "05/01/2020"
                }, {
                    playerid: 6,
                    playername: "Dinesh Karthik",
                    price: "7",
                    team: "KKR",
                    joiningdate: "06/01/2020"
                }, {
                    playerid: 7,
                    playername: "Steve Smith",
                    price: "12",
                    team: "RR",
                    joiningdate: "07/01/2020"
                }, {
                    playerid: 8,
                    playername: "David Warner",
                    price: "120",
                    team: "SRH",
                    joiningdate: "08/01/2020"
                }, {
                    playerid: 9,
                    playername: "Kane Williamson",
                    price: "3",
                    team: "SRH",
                    joiningdate: "09/01/2020"
                }, {
                    playerid: 10,
                    playername: "Jofra Archer",
                    price: "7",
                    team: "RR",
                    joiningdate: "10/01/2020"
                }, {
                    playerid: 11,
                    playername: "Andre Russell",
                    price: "9",
                    team: "KKR",
                    joiningdate: "11/01/2020"
                }, {
                    playerid: 12,
                    playername: "Chris Gayle",
                    price: "2",
                    team: "KXIP",
                    joiningdate: "12/01/2020"
                },

            ];

            var table = new Tabulator("#players", {
                height: 225,
                data: tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                columns: [{
                        title: "Player Name",
                        field: "playername",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input"
                    }, {
                        title: "Player Price",
                        field: "price",
                        sorter: "number",
                        hozAlign: "left",
                        formatter: "progress",
                    },

                    {
                        title: "Team",
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
                        title: "Joining Date",
                        field: "joiningdate",
                        sorter: "date",
                        hozAlign: "center"
                    },
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection