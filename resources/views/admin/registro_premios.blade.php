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
     <link rel="stylesheet" href="{{ asset('build/assets/css/view_premios.css') }}">

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Premios</li>
@endsection

@section('subcontent')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
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
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y col-span-12 sm:col-span-6">
        <div class="container">
            <div class="container">
            <form method="POST" action="{{ route('admin.asignar_premio') }}"  id="form_duelist">
            @csrf
                <div class="card card-primary">
                    <h3 class="text-2xl font-medium leading-none mt-3 px-10 text-center mx-auto"
                    style="padding-top: 20px; padding-bottom: 10px;"> Asignar Premios </h3>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Premios</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="premios" name="premios">
                                        @if (isset($premios))
                                            <option value="">Selecciona un premio</option>
                                            @foreach ($premios as $dato)
                                                <option id="{{$dato->nombre}}"value="{{$dato->id}}">{{$dato->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body"  id="card_body">
                                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                        <div class="col-span-12 sm:col-span-8">
                                            <div class="form-group row justify-content-center"> <!-- Alinea el contenido horizontalmente -->
                                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                                <div class="col-md-8"> <!-- Ancho ajustado para el contenido -->
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <button id="asign" class="btn btn-outline-secondary w-full mt-3" type="submit">
            Asignar
            </button>
            </form>
        </div>
    <div style="height: 65px;"></div>
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
        availableTitle: 'Prestadores',
        selectedTitle: 'Prestadores seleccionados',
        addButtonText: '🡺',
        removeButtonText: '🡸',
        addAllButtonText: '>>',
        removeAllButtonText: '<<',
        searchPlaceholder: 'Buscar prestadores'
    });
    dlb2.addEventListener('added', function(event) {
        console.log(event);
    });
    dlb2.addEventListener('removed', function(event) {
        console.log(event);
    });

</script>
@endsection