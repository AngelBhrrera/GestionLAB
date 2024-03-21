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
            }, 
        ],
    });

</script>

@endsection