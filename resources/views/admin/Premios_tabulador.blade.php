@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.Premios_tabulador')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Premios</li>
@endsection

@section("subcontent")
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Gestion premios
</h2>
<div id="players_premios"></div>
@endsection

@section("script")
<script type="text/javascript">

var users = {!! $datos !!};

var table = new Tabulator("#players_premios", {
    height: 500,
    data: users,
    layout: "fitColumns",
    pagination: "local",
    resizableColumns: false,  
    paginationSize: 24,
    groupBy: "nombre_area",
    tooltips: true,
    columns: [{
            title: "Nombre prestador",
            field: "name",
            sorter: "string",
            editor: "input",
            headerFilter: "input",
          
        }, {
            title: "Premio",
            field: "premio",
            sorter: "string",
            editor: "input",
            headerFilter: "input",
          
        }, {
            title: "Descripcion",
            field: "descripcion",
            sorter: "string",
            headerFilter: "input",
          
        }, {
            title: "Tipo",
            field: "tipo",
            editor: "select",
            editorParams: {
                values: {
                        "prestador": "prestador",
                        "coordinador": "coordinador",
                    }
            },
          
        },{
            title: "Horas",
            field: "horas",
          
        },  {
            title: "Fecha",
            field: "fecha",
            sorter: "string",
          
            editor: "select",
            editorParams: {
                values: {
                    "Matutino": "Matutino",
                    "Mediodia": "Mediodia",
                    "Vespertino": "Vespertino",
                    "Tiempo Completo": "Tiempo Completo",
                    "Sabatino": "Sabatino",
                }
            },
        }, {
            title: "Eliminar",
            field: "id",
            width: 120,
            formatter: function (cell, formatterParams, onRendered) {
                var row = cell.getRow();
                var id = cell.getValue();
                var button = document.createElement("button");
                button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                button.textContent = "Modificar";
                button.title = "";
                button.addEventListener("click", function() {
                    var value = row.getData().horario;
                    var value2 = row.getData().tipo;
                    modificarHPrestador(id, value);
                    modificarTPrestador(id, value2);
                });
                return button;
            }, 
          
        }, {
            title: "Desactivar",
            field: "id",
            width: 135,
            formatter: function (cell, formatterParams, onRendered) {
                var value = cell.getValue();
                var button = document.createElement("button");
                button.style = "background-color: red; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                button.textContent = "Desactivar";
                button.title = "";
                button.addEventListener("click", function() {
                    desactivarPrestador(value);
                });
                return button;
            }, 
          
        },
    ],
});

function modificarTPrestador(id, value) {
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    fetch(`modificar_tipo_prestador/${id}/${value}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
        window.location.reload(); 
    })
    .catch(error => {
        console.error('Error al activar usuario:', error);
    });
} 

function modificarHPrestador(id, value) {
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    fetch(`modificar_horario_prestador/${id}/${value}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
        //window.location.reload(); 
    })
    .catch(error => {
        console.error('Error al activar usuario:', error);
    });
} 


function desactivarPrestador(value) {
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    fetch(`desactivar_prestador/${value}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
    })
    .then(response => response.json())
    .then(data => {

        console.log('Usuario desactivado:', data);

        window.location.reload(); 
    })
    .catch(error => {
        console.error('Error al desactivar usuario:', error);
    });
} 


</script>

@endsection