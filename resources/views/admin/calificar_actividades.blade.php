@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver actividades pendientes de revision</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Revisar actividades
</h2>
<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var visits = {!! $data !!};

            var table = new Tabulator("#players", {
                data: visits,
                paginationSize: 10,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                columns: [{
                        title: "Prestador",
                        field: "prestador",
                        sorter: "string",
                        width: 170,
                    }, {
                        title: "Titulo Act",
                        field: "actividad",
                        sorter: "string",
                        headerFilter: "input",
                    },  {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                        headerFilter: "input",
                    },  {
                        title: "Estado",
                        field: "estado",
                        editor: "select",
                        editorParams: {
                            values: {
                                "Aprobada": "Aprobada",
                                "En revision": "En revision",
                                "Error": "Error",
                            }
                        },
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "aprobado": "aprobado",
                            "revision": "revision",
                            "error": "error",
                        },
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            cambiarEstado(id, value);
                        }
                    }, 
                ],
            });

            function cambiarEstado(id, value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`califAct/${id}/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Estado de horas cambiado', data);

                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al cambiar de estado:', error);
                });
            } 


    </script>
@endsection