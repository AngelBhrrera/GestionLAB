@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Actividades</a></li>
    <li class="breadcrumb-item active" aria-current="page">Propuestas por prestadores</li>
@endsection

@section('subcontent')
    <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
        Todas las actividades.
    </h2>
    <div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var acts = {!! $data !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: acts,
                layout: "fitColumns",
                pagination: "local",
                resizableColumns: "false",
                paginationSize: 20,
                tooltips: true,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Titulo",
                        field: "titulo",
                        sorter: "string",
                        headerFilter: "input",
                    }, {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        headerFilter: "input",
                    }, {
                        title: "Descripcion",
                        field: "descripcion",
                        sorter: "string",
                    }, {
                        title: "Definir TEC",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Más Info.";
                            button.title = "";
                            button.addEventListener("click", function() {

                                window.location.href = 'aprobar_actividad/' + value;
                            });
                            return button;
                        }, 
                    },
                ],
            });


            
    </script>
@endsection