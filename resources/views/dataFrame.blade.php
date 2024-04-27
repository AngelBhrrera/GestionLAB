@extends('layouts/admin-layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Dataframe</li>
@endsection

@section('subhead')
<script src="{{ asset('build/assets/js/tabulator.min.js')}}" type="text/javascript" ></script>
@endsection

@section('subcontent')
<div class="container">
    <div class="card-header">
        <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">Dataframe utilizado para la prediccion </h3>
        <div class="table-controls pl-10">
            <button class="download-button" id="download-csv">Download CSV</button>
        </div>               
    </div>
    <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
</div>

    <script type="text/javascript">

            var data = {!! $data !!};

            var table = new Tabulator("#players", {
               
                data: data,
                paginationSize: 20,
                tooltips: true,
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                columns: [  {
                title: "Perfil de Prestador",
                        columns: [{
                    title: "ID Prestador",
                    field: "id_prestador",
                    sorter: "number",
                    visible: false,
                },   {
                    title: "Horario",
                    field: "horario",
                    sorter: "string",
                },   {
                    title: "Carrera",
                    field: "carrera",
                    sorter: "string",
                },  {
                    title: "Periodo",
                    field: "periodo",
                    sorter: "number",
                },  {
                    title: "Semanas",
                    field: "semanas_actividad",
                    sorter: "number",
                },    {
                    title: "Experiencia total",
                    field: "experiencia",
                    sorter: "number",
                },{
                    title: "Exp Mensual",
                    field: "experiencia_mensual",
                    sorter: "number",
                },   {
                    title: "Exp Semanal",
                    field: "experiencia_semanal",
                    sorter: "number",
                }], },   {
                title: "Perfil de Actividad",
                        columns: [{
                    title: "ID Actividad",
                    field: "id_actividad",
                    sorter: "number",
                    visible: false,
                },  {
                    title: "Dificultad",
                    field: "dificultad",
                    sorter: "string",
                },{
                    title: "Categoria",
                    field: "nombre_categoria",
                    sorter: "string",
                },  {
                    title: "Subcategoria",
                    field: "nombre_subcategoria",
                    sorter: "date",
                },  {
                    title: "Tiempo Estimado",
                    field: "TEC",
                    sorter: "number",
                }], },  {
                    title: "Resultado",
                    field: "resultado",
                    sorter: "string",
                },],
            });

            document.getElementById("download-csv").addEventListener("click", function(){
                table.download("csv", "data.csv");
            });

    </script>
@endsection
