@extends('layouts/admin-layout')

@section('subhead')

    <style>
        .download-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-right: 10px; /* O ajusta el margen según tus necesidades */
        }
    </style>

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresiones</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#cprinters">Registrar Impresoras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#printers">Gestionar Impresoras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#prints">Ver Impresiones</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="cprinters">

            <div class="card card-primary">
                <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Gestión de Impresoras </h3>
            </div>

            <div class="row justify-content-center">
                <form class="from-prevent-multiple-submits" method="POST" action="{{ route('admin.make_print') }}">
                @csrf

                    <div data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora">
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

                    <div data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora"">
                        <label for="input-wizard-3" class="form-label">Marca</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                            name="mark" id="mark" value="{{old('mark')}}">
                        <small id="Help" class="form-text text-muted">Ingresa la marca de la impresora</small>
                        @error('mark')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora"">
                        <label for="input-wizard-3" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" id="tipo" >
                            <option selected id=null value=null>Selecciona un tipo de impresora</option>
                            <option id=1 value='Filamento'>Filamento</option>
                            <option id=2 value='Resina'>Resina</option>
                        </select>
                        <small id="Help" class="form-text text-muted">Selecciona tipo de impresion(resina o filamento)</small>
                    </div>

                    <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                        Enviar
                    </button>

                </form>
            </div>
        </div>

        <div class="tab-pane" id="printers">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Gestionar Impresoras</h3>
            </div>
            
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="players"></div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="prints">
            <div class="card-header">
                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                Ver Impresiones del Area</h3>
            </div>
            <div class="table-controls pl-10">
                <button class="download-button" id="download-json">Download JSON</button>
                <button class="download-button" id="download-csv">Download CSV</button>
                <button class="download-button" id="download-xlsx">Download XLSX</button>
            </div>
            <br>
            <div class="col-span-12 sm:col-span-4">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div id="players2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="height: 65px;"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var printers = {!! $impresoras !!};
            var prints = {!! $impresiones !!};

            function createTabulatorInstance(selector, data, config) {
                return new Tabulator(selector, {
                    ...config,
                    data: data,
                });
            }

            var commonConfig = {
                paginationSize: 20,
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,
                headerFilterPlaceholder: "Buscar..",
                tooltips: true,
            };

            var table = createTabulatorInstance("#players", printers, {
                ...commonConfig,
                columns: [{
                        title: "Nombre",
                        field: "nombre",
                        sorter: "string",
                        width: 150,
                    }, {
                        title: "Marca",
                        field: "marca",
                        sorter: "string",
                        width: 150,
                    }, {
                        title: "Ultimo Uso",
                        field: "ultimo_uso",
                        sorter: "string",
                        width: 200,
                    }, {
                        title: "Tipo",
                        field: "tipo",
                        sorter: "string",
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Filamento": "Filamento",
                            "Resina": "Resina",
                        },
                        width: 150,
                    },  {
                        title: "Estado",
                        field: "estado",
                    }, {
                        title: "",
                        field: "id",
                        formatter: function (cell, formatterParams, onRendered) {

                            var button = document.createElement("button");
                            var row = cell.getRow();
                            var state = row.getData().estado;
                            var nombreCampo = cell.getColumn().getField();
                            console.log(nombreCampo);
                            if(state == 1){
                                button.style = "background-color: red; color: white; border: 1px solid red; padding: 5px 15px; border-radius: 5px; font-size: 12px;";
                                button.textContent = "Desactivar";
                            }else{
                                button.style = "background-color: #4CAF50; color: white; border: 1px solid #4CAF50; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                                button.textContent = "Activar";
                                button.title ="";
                            }
                           
                            button.addEventListener("click", function() {
                                var value = cell.getValue();
                                activarImpresora(value);
                            });
                            return button;
                        }, 
                    },
                ], 
            });

            var table2 = createTabulatorInstance("#players2", prints, {
                ...commonConfig,
                columns: [{
                    title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Impresora",
                        field: "impresora",
                        sorter: "string",
                    }, {
                        title: "Proyecto",
                        field: "proyecto",
                        sorter: "string",
                    }, {
                        title: "Fecha",
                        field: "fecha",
                        sorter: "string",
                    },  {
                        title: "Modelo",
                        field: "nombre_modelo_stl",
                        sorter: "string",
                    }, {
                        title: "Duracion",
                        field: "tiempo_impresion",
                        sorter: "number",
                    },  {
                        title: "Color",
                        field: "color",
                        sorter: "string",
                    },  {
                        title: "Piezas",
                        field: "piezas",
                        sorter: "number",
                    }, {
                        title: "Estado",
                        field: "estado",
                        sorter: "string",
                        headerFilter: "select",
                        headerFilterParams: {
                            "": "", 
                            "Exitoso": "Exitoso",
                            "En Proceso": "En Proceso",
                            "Fallido": "Fallido",
                        },
                        editor: "select",
                        editorParams: {
                            values: {
                                "Exitoso": "Exitoso",
                                "En Proceso": "En Proceso",
                                "Fallido": "Fallido",
                            }
                        },
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            cambiarEstadoImpresion(id, value);
                        }
                    },   {
                        title: "Peso",
                        field: "peso",
                        sorter: "number",
                    },  {
                        title: "Observaciones",
                        field: "observaciones",
                        editor: "input",
                        width: 350,
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var id = row.getData().id;
                            var value = cell.getValue();
                            agregarObservaciones(id, value);
                        },
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

