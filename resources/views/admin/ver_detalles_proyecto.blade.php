@extends('layouts/admin-layout')

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
        <h3 class="text-xl font-medium leading-none">{{$proyecto[0]->titulo}}</h3>
        <input type="hidden" id="nombre" value="{{$proyecto[0]->titulo}}">
        <br>
        <h3 class="text-xl font-medium leading-none mt-3">--Integrantes--</h3>
        @if(count($prestadores)==0)
            Este es un proyecto abierto
        @else
            
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
                fitColumns: true,
                pagination: "local",
                paginationSize: 20,
                tooltips: true,
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
                                // Modificar la URL de redirección según la ruta deseada
                                window.location.href = 'detalles-actividad/' +value//'/admin/ver_detalles_actividad/'+ proyecto_origen + '/' + value;
                            });
                            return button;
                        }, 
                    },
                ],
            });
            
    </script>
    
@endsection