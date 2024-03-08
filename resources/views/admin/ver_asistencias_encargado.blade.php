@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Coordinador - aun no esta bien</a></li>
    <li class="breadcrumb-item active" aria-current="page">Horas del Servicio</li>
@endsection

@section('subcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registros de Check - in  </h3>
                </div>
                <div class="w-[350px] relative mx-5 my-5">
                    <input id="searchInput" type="text" class="form-control pl-10" placeholder="Buscar">
                    <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
                </div>
                <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
            </div>
        </div>
    </div>
    
    <div style="height: 45px;"></div>
    @endsection

    @section('script')
    
    <script type="text/javascript">

            var assist = {!! $datos !!};

            var table = new Tabulator("#players", {

                data: assist,
                paginationSize: 12,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",
                //responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,
                headerFilterPlaceholder: "Buscar..",
                headerFilterLiveFilter: false,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                    },  {
                        title: "Codigo",
                        field: "codigo",
                    }, {
                        title: "Prestador",
                        field: "origen",
                        sorter: "string",
                    },{
                        title: "Coordinador",
                        field: "responsable",
                        sorter: "string",

                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                    },  {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                            sorterParams: {
                                format: "DD/MM/YYYY", 
                            },
                    }, {
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                    },{
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                        editor: "select",
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "string", 
                        sorterParams: {
                            format: "HH:mm:ss",
                        },
                    },  
                ],
            });
            
            document.addEventListener('DOMContentLoaded', function() {

                function applyCustomFilter(value) {
                    var searchValue = value.toLowerCase().replace(/[^a-z0-9áéíóúüñ]/g, '');
                    table.setFilter(function(row) {
                        return (row.codigo && row.codigo.toString().toLowerCase().includes(searchValue)) || 
                            (row.origen && row.origen.toLowerCase().includes(searchValue)) || 
                            (row.responsable && row.responsable.toLowerCase().includes(searchValue)) || 
                            (row.tiempo && row.tiempo.toLowerCase().includes(searchValue)) || 
                            (row.horas && row.horas.toLowerCase().includes(searchValue)) || 
                            (row.fecha && row.fecha.toLowerCase().includes(searchValue)) || 
                            (row.correo && row.correo.toLowerCase().includes(searchValue));
                    });
                }
                document.getElementById("searchInput").addEventListener("input", function(e) {
                    var value = e.target.value.trim();
                    applyCustomFilter(value);
                });

            });
    </script>
@endsection