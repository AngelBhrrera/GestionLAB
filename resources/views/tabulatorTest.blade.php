
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>


    <div id="players"></div>

    <script type="text/javascript"> 

            var dataFromServer = {!! $impresoras !!};

            var table = new Tabulator("#players", {
                height: 225,
                data: dataFromServer,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 8,
                tooltips: true,
                columns: [{
                        title: "Nombre",
                        field: "nombre",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input"
                    }, {
                        title: "Codigo",
                        field: "marca",
                        sorter: "string",
                        hozAlign: "left",
                        formatter: "progress",
                    },
                    {
                        title: "Sede",
                        field: "tipo",
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
                        field: "estado",
                        sorter: "string",
                        hozAlign: "center"
                    },
                ],
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });

            
    </script>
