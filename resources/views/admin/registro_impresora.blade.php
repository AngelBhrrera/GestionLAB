@extends('layouts/admin-layout')

@section('subhead')
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresora</li>
@endsection

@section('subcontent')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gestion de Impresoras</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('admin.make_print') }}">

                    @csrf
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora">
                            <label for="">Nombre</label>
                            <input type="name" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" id="nombre" value="{{old('nombre')}}">
                            <small id="Help" class="form-text text-muted">Ingresar el nombre identificador de la impresora</small>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Marca</label>
                            <input type="text"  class="form-control @error('nombre') is-invalid @enderror"
                                name="mark" id="mark" value="{{old('mark')}}">
                            @error('mark')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-3" class="form-label">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" >
                                <option selected id= null value= null>Selecciona un tipo de impresora</option>
                                <option id="1" value='Filamento'>Filamento</option>
                                <option id="2" value='Resina'>Resina</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-right">
                            <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                                Enviar
                            </button>
                        </div>

                    </form>

                </div>
                
                <div id="players"></div>

        </div>

    </div>

</div>

@endsection

@section('script')
    <script type="text/javascript">

            var printers = {!! $impresiones !!};

            var table = new Tabulator("#players", {
                height: 500,
                data: printers,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 24,
                tooltips: true,
                columns: [{
                        title: "Nombre",
                        field: "nombre",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                    }, {
                        title: "Marca",
                        field: "marca",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Ultimo Uso",
                        field: "ultimo_uso",
                        sorter: "string",
                        hozAlign: "center",
                    }, {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        hozAlign: "center",
                        editor: "select",
                        headerFilter: true,
                        headerFilterParams: {
                            "Filamento": "Filamento",
                            "Resina": "Resina",
                        }
                    },  {
                        title: "Estado",
                        field: "activo",
                        formatter: "tickCross",  // Esto renderizará un checkbox
                        hozAlign: "center",
                        headerFilter: true,
                        headerFilterParams: {
                            "Activo": "1",
                            "Inactivo": "0",
                        },
                    },  {
                            title: "Acción",
                            field: "accion",
                            formatter: function(cell, formatterParams, onRendered) {
                                return '<button onclick="tuFuncionPersonalizada()">Haz algo</button>';
                            },
                            hozAlign: "center",
                            width: 100,
                        },
                ],  
                //rowClick: function(e, row) {
                //    alert("Row " + row.getData().playerid + " Clicked!!!!");
                //},
            });
            
    </script>
@endsection

