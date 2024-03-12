@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.actHub')}}">Actividad</a></li>
    <li class="breadcrumb-item active" aria-current="page">Aprobar propuesta</li>
@endsection

@section('subcontent')
    <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
        Aqui puedes aprobar actividades propuestas por los prestadores para su posterior asignacion
    </h2>
    <div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var acts = {!! $data !!};

            var table = new Tabulator("#players", {

                data: acts,
                paginationSize: 20,
                
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
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
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Aprobar";
                            button.title = "";
                            button.addEventListener("click", function() {

                                window.location.href = 'aprobar_actividad/' + value;
                            });
                            return button;
                        }, 
                    },   {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Eliminar";
                            button.title ="";
                            button.addEventListener("click", function() {
                                eliminarActividad(value);
                            });
                            return button;
                        }, 
                    },
                ],
            });

            function eliminarActividad(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`eliminar_actividad/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al eliminar actividad:', error);
                });
            } 
            
    </script>
@endsection