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
    <li class="breadcrumb-item"><a href="{{route('admin.premios')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Premios</li>
@endsection

@section('subcontent')
<form method="POST" action="{{ route('api.guardar_premio') }}">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registrar Premios</h3>
                    </div>
                    @csrf
                    <div class="col-span-12 sm:col-span-4">
                        @csrf
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
                            <label for="tipo" class="form-label"> Tipo *</label>
                            <input id="tipo" type="text" class="form-control @if(old('opc')=='1') @error('tipo') is-invalid @enderror @endif" name="tipo" required autocomplete="off" placeholder="tipo">
                            @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                </div>
            </div>
        </div>
    </div>
</form>
<form>
    <div class="intro-y col-span-12 sm:col-span-6">
        <label for="tipo" class="form-label">Prestadores</label>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card card-primary">
                            <h3 class="text-2xl font-medium leading-none mt-3 pl-10"
                                style="padding-top: 20px; padding-bottom: 10px;"> Asignar Premios </h3>
                        </div>
                        <div class="card-body">
                            <input id="tipo" name="tipo" value="xx" type="hidden">
                            <div class="form-group row">
                                <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Premios</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="premios" name="premios">
                                        @if (isset($premios))
                                            <option value="">Selecciona un premio</option>
                                            @foreach ($premios as $dato)
                                                <option id="{{$dato->nombre}}"value="{{$dato->horas}}">{{$dato->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div>
                                <input type="text" id="busquedaPrestadores" placeholder="Buscar usuarios...">
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                <div class="col-md-6">
                                    <select class="duallistbox" name="prestadores" id="opcionPrestadores"
                                        multiple="multiple" required>
                                        @if(isset($prestadores))
                                            @foreach ($prestadores as $dato)
                                                <option id="{{$dato->tipo}}" value="{{$dato->tipo}}">{{$dato->codigo}} - {{$dato->name}} - {{$dato->apellido}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usuarios_seleccionados" class="col-md-4 col-form-label text-md-right">Prestadores seleccionados</label>
                                <div class="col-md-6">
                                    <select class="duallistbox" name="usuarios_seleccionados[]" id="usuarios_seleccionados" multiple="multiple" required>
                                        <!-- usuarios seleccionados dinámicamente -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 45px;"></div>
        <div class="text-center xl:text-left">
            <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
            Asignar
            </button>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    document.getElementById('opcionPrestadores').addEventListener('change', function() {
    var selectElement = document.getElementById('opcionPrestadores');
    var selectedUsers = [];
    var usuariosSeleccionadosElement = document.getElementById('usuarios_seleccionados');

    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].selected) {
            var option = document.createElement('option');
            option.value = selectElement.options[i].value;
            option.text = selectElement.options[i].text;
            usuariosSeleccionadosElement.add(option);  //se agregan los prestadores al segundo duelistbox
            selectedUsers.push(selectElement.options[i]);
        }
    }
});

document.getElementById('usuarios_seleccionados').addEventListener('change', function() {
    var selectElement = document.getElementById('usuarios_seleccionados');
    var selectedUsers = [];
    var opcionPrestadores = document.getElementById('opcionPrestadores');

    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].selected) {
            var option = document.createElement('option');
            option.value = selectElement.options[i].value;
            option.text = selectElement.options[i].text;
            opcionPrestadores.add(option);
            selectedUsers.push(selectElement.options[i]);
        }
    }
    selectedUsers.forEach(function(user) {
        selectElement.removeChild(user);
    });
});

document.getElementById('busquedaPrestadores').addEventListener('input', function() {
    var busqueda = this.value.toLowerCase();
    var opciones = document.getElementById('opcionPrestadores').options;

    for (var i = 0; i < opciones.length; i++) {
        var textoOpcion = opciones[i].text.toLowerCase();
        if (textoOpcion.includes(busqueda)) {
            opciones[i].style.display = '';
        } else {
            opciones[i].style.display = 'none';
        }
    }
});

</script>
@endsection