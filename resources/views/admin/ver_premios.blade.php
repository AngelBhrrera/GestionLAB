@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.gestor_premios')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Premios Otorgados</li>
@endsection

@section("subcontent")
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Gestion premios
</h2>
<div id="players_premios"></div>
@endsection

@section("script")
<script type="text/javascript">

    var premios = {!! $datosJson !!};


    var table = new Tabulator("#players_premios", {
        height: "100%",
        data: premios,
        layout: "fitColumns",
        pagination: "local",
        resizableColumns: false,  
        paginationSize: 24,
        groupBy: "nombre_area",
        tooltips: true,
        columns: [{
                title: "Nombre prestador",
                field: "nombre_prestador",
                sorter: "string",
                editor: "input",
                headerFilter: "input",
            
            }, {
                title: "Premio",
                field: "nombre",
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
            },{
                title: "Horas",
                field: "horas",
            
            },  {
                title: "Fecha",
                field: "fecha",
                sorter: "date",
            }, {
                title: "Eliminar",
                field: "id",
                formatter: function (cell, formatterParams, onRendered) {
                    var value = cell.getValue();
                    var button = document.createElement("button");
                    button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                    button.textContent = "Eliminar";
                    button.addEventListener("click", function() {
                        eliminarPremio(value);
                    });
                        return button;
                },          
            },
        ],
    });
    function eliminarPremio(value) {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        fetch(`eliminar_premio/${value}`,{
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
        })
        .then(response => response.json())
        .then(data => {

            console.log('Premio eliminado:', data);

            window.location.reload(); 
        })
        .catch(error => {
            console.error('Error al eliminar premio:', error);
        });
    } 


</script>

@endsection