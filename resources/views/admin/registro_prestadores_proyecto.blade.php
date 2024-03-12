@extends('layouts/admin-layout')

@section('subhead')
    <link rel="stylesheet" href="{{asset('build/assets/css/registro_proyecto_actividadess.css')}}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar prestadores</li>
@endsection

@section('subcontent')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
                    @if (session('success'))
                        <div class="alert alert-success w-full px-4">{{session('success')}}</div>
                    @endif
                    @if(session('warning'))
                        <div class="alert alert-warning w-full px-4">{{session('warning')}}</div>
                    @endif
                    @error('nombre')
                        <div class="alert alert-danger w-full px-4">{{$message}}</div>
                    @enderror
                        </div>
                </div>
            </div>
                <div class="card card-primary" id="crear_proyecto">
                    <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Agregar Prestadores a Proyecto </h3>
                </div>
                <div class="card-body pl-10 pr-10" id="crear_proyecto_3">
                    <form id="enviar" method="POST" action="{{route('admin.asign3')}}">
                        @csrf
                        <div class="form-group">
                                <label style="font-weight: bold; font-size: 1.2em;" for="proyecto">Seleccionar proyecto</label>
                                    <select class="form-control" id="proyecto" name="proyecto">
                                    <option value="">Selecciona el area de trabajo donde estará principalmente el proyecto</option>
                                    @foreach ($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->titulo}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="container" id="card_duelist_box">
                            <div class="row justify-content-center">
                                <label style="font-weight: bold; font-size: 1.2em;" for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
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
                            <button id="boton_crear" type="submit" class="btn btn-primary from-prevent-multiple-submits">Agregar a proyecto</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">

        document.getElementById('enviar').addEventListener('submit', function(event) {

            const prestadorSelect = document.getElementById('prestadores_seleccionados');
            const check = document.getElementById('checkbox');

            if (prestadorSelect.selectedOptions.length === 0) {
                
                if(check.checked){
                    event.preventDefault();
                    alert('Por favor, selecciona al menos un prestador.');
                }        
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

    </script>

@endsection