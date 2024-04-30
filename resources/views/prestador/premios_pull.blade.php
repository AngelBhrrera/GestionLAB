@extends('layouts/prestador-layout')

@section('subhead')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('premios_pull')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item"><a href="">Premios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Disponibles</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Premios Disponibles
</h2>
<div class="container">
    <div id="players_premios"></div>
</div>
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
                title: "Premio",
                field: "nombre",
                sorter: "string",
                editor: "input",
                headerFilter: "input",
            
            }, {
                title: "Descripcion",
                field: "descripcion",
                sorter: "string",
                editor: "input",
                headerFilter: "input",
            
            }, {
                title: "Tipo",
                field: "tipo",
                sorter: "string",
                headerFilter: "input",
            
            }, {
                title: "Horas",
                field: "horas",
            },{
                title: "Inicio Vigencia",
                field: "inicioVigencia",
            
            },  {
                title: "Fin Vigencia",
                field: "finVigencia",
                sorter: "string",
            }, {
                title: "Disponibilidad",
                field: "limite",
                sorter: "string",
            },{
                title: "Detalles de actividad",
                field: "id",
                width: 135,
                formatter: function (cell, formatterParams, onRendered) {
                    var value = cell.getValue();
                    var button = document.createElement("button");
                    button.style = "background-color: blue; color: white; border: 1px solid white; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                    button.textContent = "Detalles";
                    button.title = "";
                    button.addEventListener("click", function() {
                        window.location.href = "prestador/actividadesAbiertas"; // recordar actualizar la redireccion de los botones de detalles. 
                    });
                    return button;
                }, 
                      
            },
        ],
    });

</script>

@endsection