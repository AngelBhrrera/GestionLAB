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
                <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Gestión de Impresoras </h3>
            </div>   
            <div class="px-5 sm:px-20 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <form class="from-prevent-multiple-submits" method="POST" action="{{ route('admin.make_print') }}">
                    @csrf

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <!-- Sección 1 -->
                        <div class="col-span-12 sm:col-span-4">
                            <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora">
                                <label for="input-wizard-3" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    name="nombre" id="nombre" value="{{old('nombre')}}">
                                <small id="Help" class="form-text text-muted">Ingresar el nombre identificador de la impresora</small>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Sección 2 -->
                        <div class="col-span-12 sm:col-span-4">
                            <div class="intro-y col-span-12 sm:col-span-6 data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora"">
                                <label for="input-wizard-3" class="form-label">Marca</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    name="mark" id="mark" value="{{old('mark')}}">
                                @error('mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Sección 3 -->
                        <div class="col-span-12 sm:col-span-4">
                            <div class="intro-y col-span-12 sm:col-span-6 data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora"">
                                <label for="input-wizard-3" class="form-label">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" >
                                    <option selected id=null value=null>Selecciona un tipo de impresora</option>
                                    <option id=1 value='Filamento'>Filamento</option>
                                    <option id=2 value='Resina'>Resina</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                            <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                                Enviar
                            </button>
                    </div>
            </form>
            <div id="players"></div>
            </div>
        </div>
    </div>
</div>
<div style="height: 65px;"></div>

@endsection

@section('script')
    <script type="text/javascript">

            var printers = {!! $impresiones !!};

            var table = new Tabulator("#players", {
                height: "100%",
                data: printers,
                pagination: "local",
                paginationSize: 7,
                tooltips: true,
                columns: [{
                        title: "Nombre",
                        field: "nombre",
                        sorter: "string",
                        headerFilter: "input",
                        hozAlign: "center",
                        width: 150,
                    }, {
                        title: "Marca",
                        field: "marca",
                        sorter: "string",
                        hozAlign: "center",
                        width: 150,
                    }, {
                        title: "Ultimo Uso",
                        field: "ultimo_uso",
                        sorter: "string",
                        hozAlign: "center",
                        width: 200,
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
                        },
                        width: 150,
                    },  {
                        title: "Estado",
                        field: "estado",
                        formatter: function(cell, formatterParams, onRendered) {
                            var estado = cell.getValue();
                            var icono = "";
                            if (estado == "1") {
                                icono = "✔️";
                            } else if (estado == "0") {
                                icono = "❌";
                            }
                            return icono;
                        },
                        hozAlign: "center",
                        width: 100,
                    }, {
                        title: "Activar",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: #4CAF50; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Activar";
                            button.addEventListener("click", function() {
                                activarImpresora(value);
                            });
                            return button;
                        }, 
                        hozAlign: "center",
                    },
                ],  
            });

            function activarImpresora(value) {
                const token = document.head.querySelector('meta[name="csrf-token"]').content;
                fetch(`activar_impresora/${value}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                })
                .then(response => response.json())
                .then(data => {

                    console.log('Impresora activado:', data);

                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error al activar impresora:', error);
                });
            } 

    </script>
@endsection

