@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item">Actividades</li>
    <li class="breadcrumb-item active" aria-current="page">Ver detalles de proyecto</li>
@endsection

@section('subcontent')


    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl font-medium leading-none mt-3" style="padding-top: 20px; padding-bottom: 20px;">
            Detalles de Proyecto
        </h2>
        @if (isset($proyecto))
            <h3 class="text-xl font-medium leading-none">{{$proyecto}}</h3>
            <br>
            <h3 class="text-xl font-medium leading-none mt-3">--Integrantes--</h3>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Prestador</th>
                            <th class="whitespace-nowrap">Correo</th>
                            <th class="whitespace-nowrap">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($prestadores as $prestador )
                            <tr>
                                <td>{{$prestador->name." ".$prestador->apellido}}</td>
                                <td>{{$prestador->correo}}</td>
                                <td>{{$prestador->telefono}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <h3 class="text-xl font-medium leading-none mt-3">Actividades</h3>
                <div class="text-center mx-auto" style="padding-left: 10px" id="actividades"></div>
        @else
            <h3 class="text-xl font-medium leading-none">No tienes un proyecto asignado ☹ </h3>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
            var actividades = {!! $actividades!!};
            var table = new Tabulator("#actividades", {
                height:"100%",
                data: actividades,
                resizableColumns: "false",
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 20,

                columns: [{
                        title: "ID",
                        field: "actividad_id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Actividad",
                        field: "actividad",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 300,
                        
                    },{
                        title: "Estado",
                        field: "estado",
                        headerFilter: "input",
                        sorter: "string",
                        editor: "input",
                        width: 150,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            nuevoNombreArea(id, value);
                        },
                    }, {
                        title: "Asignado a",
                        field: "prestador",
                    },
                    {
                        title: "",
                        field: "actividad_id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Más Info.";
                            button.title = "";
                            button.addEventListener("click", function() {

                                window.location.href = 'detalles_actividad/' + value;
                            });
                            return button;
                        }, 
                    },
                ],
            });
            
    </script>
    
@endsection