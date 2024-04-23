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
        .tab-scroll {
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>
     <link rel="stylesheet" href="{{ asset('build/assets/css/view_premios.css') }}">

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Premios</li>
@endsection

@section('subcontent')

    <div class="container" style="padding-top: 20px; padding-left: 20px;">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('nombre')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>

        <div class="tab-scroll">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#reg">Registrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#asi">Asignar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#adm">Administrar</a>
                </li>
            </ul>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane active" id="reg">
                
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3  class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> Registrar Premios</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.guardar_premio') }}" id="form_premio_register">
                        @csrf
                        <div class="col-span-12 sm:col-span-4">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="name" class="form-label">Nombre *</label>
                                <input id="name" type="text" class="form-control @if(old('opc')=='1') @error('name') is-invalid @enderror @endif" name="nombre" required autocomplete="off" placeholder="Nombre">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="descripcion" class="form-label"> Descripcion *</label>
                                <input id="descripcion" type="text" class="form-control @if(old('opc')=='1') @error('descripcion') is-invalid @enderror @endif" name="descripcion" required autocomplete="off" placeholder="Descripcion">
                                @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="tipo" class="form-label">Tipo *</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option id="1" value='horas'>Horas</option>
                                        <option id="2" value='insignias'>Insignia</option>
                                        <option id="3" value='otro'>Otro</option>
                                    </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="horas" class="form-label"> Horas *</label>
                                <input id="horas" type="text" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif" name="horas" required autocomplete="off" placeholder="horas">
                                @error('horas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="text-center xl:text-left">
                                <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
                                    Registrar
                                </button>
                            </div>
                        </div>
                        </form> 
                    </div>
            </div>
            <div class="tab-pane" id="asi">             
                    <div class="container">
                        <form method="POST" action="{{ route('admin.asignar_premio') }}"  id="form_duelist">
                        @csrf
                            <div class="card card-primary">
                                <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto"
                                style="padding-top: 20px; padding-bottom: 10px;"> Asignar Premios </h3>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group row">
                                    <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Premios</label>
                                    <select class="form-control" id="premios" name="premios" required>
                                        @if (isset($premios))
                                            <option value="">Selecciona un premio</option>
                                            @foreach ($premios as $dato)
                                                <option id="{{$dato->nombre}}"value="{{$dato->id}}">{{$dato->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group row justify-content-center"> 
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                    <div class="col-md-8"> 
                                        <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                            @if (isset($prestadores)) 
                                                @foreach ($prestadores as $prestador) 
                                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                                @endforeach 
                                            @endif 
                                        </select>
                                    </div>
                                </div>
                                <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                            </div>
                            <button id="asign" class="btn btn-outline-secondary w-full mt-3" type="submit">
                                Asignar
                            </button>
                        </form>
                    </div>
            </div>
            <div class="tab-pane" id="adm">
                    <div class="card-header">
                        <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto" style="padding-top: 20px; padding-bottom: 20px;"> 
                        Administrar Premios Asignados</h3>
                    </div>
                    <br>
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <div id="players_premios"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        document.getElementById('asign').addEventListener('submit', function(event) {
            
            const prestadorSelect = document.getElementById('prestadores_seleccionados');

            if (prestadorSelect.selectedOptions.length === 0) {
                    event.preventDefault();
                    alert('Por favor, selecciona al menos un prestador.');
                }
        });


        let dlb2 = new DualListbox('.select2', {
            availableTitle: 'Prestadores disponibles',
            selectedTitle: 'Prestadores seleccionados',
            addButtonText: '<span style="color:black;">Agregar</span>',
            removeButtonText: '<span style="color:black;">Quitar</span>',
            addAllButtonText: '<span style="color:black;">Agregar todos</span>',
            removeAllButtonText: '<span style="color:black;">Quitar todos</span>',
            searchPlaceholder: 'Buscar prestadores'
        });
        dlb2.addEventListener('added', function(event) {
            console.log(event);
        });
        dlb2.addEventListener('removed', function(event) {
            console.log(event);
        });

        let searchInputs = document.querySelectorAll('.dual-listbox__search');
        if (searchInputs) {
            searchInputs.forEach(function(searchInput) {
                searchInput.style.color = 'black';
            });
        }
        
    </script>

    <script type="text/javascript">
        var premios = {!! $datos !!};
        var table = new Tabulator("#players_premios", {

            data: premios,
            layout: "fitColumns",
            pagination: "local",
            resizableColumns: false,  
            paginationSize: 24,

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
                    sorter: "string",
                }, {
                    title: "IDENTIFICADOR",
                    field: "id",
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

                console.log('Premio eliminado:');

                //window.location.reload(); 
            })
            .catch(error => {
                console.error('Error al eliminar premio:', error);
            });
        } 
    </script>
@endsection
