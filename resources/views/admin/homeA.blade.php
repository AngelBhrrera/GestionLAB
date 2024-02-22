@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')

<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">
            var table = new Tabulator("#players", {
                height: "100%",
                data: tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 20,
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