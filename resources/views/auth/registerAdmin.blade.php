@extends('layouts/admin-layout')

@section('subhead')
<title>Admin Register</title>
@endsection

@section('breadcrumb')

<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
<li class="breadcrumb-item active" aria-current="page">Registro Usuarios</li>

@endsection


@section('subcontent')
<div style="display: flex;">
    <form method="POST" action="{{ route('registrar') }}">
    @csrf
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            @if(session('alert-type'))
                <div class="alert alert-{{ session('alert-type') }}">
                    {{ session('alert-message') }}
                </div>
            @endif
            <div>
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">Registrar Nuevo Usuario </h3>        

                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" id="tipo" onchange="mostrarCampos(this.value)">
                            @if (isset($users))
                                <option id="0" value="">Selecciona un tipo de usuario</option>
                                    @foreach ($users as $dato )
                                    <option value="{{ $dato['value'] }}" data-nombre="{{ $dato['name'] }}" id="{{ $dato['id'] }}">
                                        {{ $dato['name'] }}
                                    </option>
                                    @endforeach
                            @endif
                        </select>
                    </div>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5" id=form_rest>
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label id="name" for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @if(old('opc')=='1') @error('name') is-invalid @enderror @endif" value="{{old('name')}}"name="name" required autocomplete="off" placeholder="Nombre">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label id="apellido" for="apellido" class="form-label">Apellido</label>
                            <input id="apellido" type="text" class="form-control @if(old('opc')=='1') @error('apellido') is-invalid @enderror @endif" name="apellido" required autocomplete="off" placeholder="Apellido">
                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label  id="correo" for="correo" class="form-label">Correo</label>
                            <input id="correo" type="email" class="form-control @if(old('opc')=='1') @error('correo') is-invalid @enderror @endif" name="correo" required="correo" placeholder="Correo">
                            @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divPW">
                            <label  id="password" for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password" required autocomplete="password" placeholder="Contraseña">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divPW2">
                            <label id="password-confirm" for="password-confirm" class="form-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required autocomplete="new-password" placeholder="Confirmar contraseña">
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6" id="divCode">
                            <label id="codigo" for="codigo" class="form-label">Codigo</label>
                            <input id="codigo" maxlength="10" type="text" class="form-control @if(old('opc')=='1') @error('código') is-invalid @enderror @endif" name="codigo" value="{{ old('opc')=='1' ? old('codigo') : '' }}" placeholder="Código">
                            @if(old('opc')=='1')
                            @error('codigo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @endif
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divTelefono">
                            <label id="telefono" for="telefono" class="form-label">Telefono</label>
                            <input id="telefono" maxlength="10" type="text" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif" name="telefono" placeholder="Telefono">
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divEscuela">
                            <label id="centro" for="centro" class="form-label">Escuela </label>
                            <select class="form-control" name="centro" id="centro">
                                <option selected id="1" value='null'>Seleccione un centro</option>
                                <option id="1" value='CUCEI'>CUCEI</option>
                                <option id="2" value='CUAAD'>CUAAD</option>
                                <option id="3" value='CUCEA'>CUCEA</option>
                                <option id="4" value='CUCBA'>CUCBA</option>
                                <option id="5" value='CUCSH'>CUCSH</option>
                                <option id="6" value='CUCS'>CUCS</option>
                                <option id="7" value='CUNORTE'>CUNORTE</option>
                                <option id="8" value='CULAGOS'>CULAGOS</option>
                                <option id="9" value='CUVALLE'>CUVALLE</option>
                                <option id="10" value='CUALTOS'>CUALTOS</option>
                                <option id="11" value='CUCOSTA'>CUCOSTA</option>
                                <option id="12" value='CUCOSTA'>CUTONALA</option>
                                <option id="13" value='CUCIENEGA'>CUCIENEGA</option>
                                <option id="14" value='CUCSUR'>CUCSUR</option>
                                <option id="15" value='CUSUR'>CUSUR</option>
                                <option id="16" value='CUSUR'>Otro</option>
                            </select>
                            @error('centro')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                            <label  id="carrera" for="carrera" class="form-label">Carrera</label>
                            <input id="carrera" type="text" class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" placeholder="Carrera">
                            @error('carrera')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6" id="divSede">
                            <label  id="sede" for="sede" class="form-label">Sede</label>
                            <select class="form-control" name="sede" id="sedeSelect" onchange="filtroSede()">
                                @if (isset($sedes))
                                <option id="sede" value="">Selecciona una sede</option>
                                    @foreach ($sedes as $dato )
                                        <option id="{{$dato->id_sede}}"  @selected(old('sede') == {{$dato->nombre_sede}}) value="{{$dato->id_sede}}" data-nombre="{{$dato->nombre_sede}}">{{$dato->nombre_sede }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divArea">
                            <label  id="area" for="area" class="form-label">Área de trabajo</label>
                            <select class="form-control" name="area"  id="areaSelect" disabled onchange="filtroArea()">
                                <option id="0" value="">Selecciona una sede primero</option>    
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divTurno">
                            <label id="turno" for="turno" class="form-label">Turno</label>
                            <select class="form-control" name="horario" id="turnoSelect" disabled>
                                <option selected id="0" value="">Selecciona una area primero</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divHoras">
                            <label id="horas" for="horas" class="form-label">Horas de Servicio</label>
                            <input id="horasSelect" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}" placeholder="Horas de servicio">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center xl:text-left">
                <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
                    Registrar
                </button>
            </div>
        </div>
    </form>
</div>

<div style="height: 65px;"></div>

@endsection

@section('script')

<script type="text/javascript">

    window.onload = function() {
        var inputs = document.querySelectorAll('input:not([name="_token"])');
        inputs.forEach(function(input) {
            input.value = '';
        });
        var selects = document.querySelectorAll('select');
        selects.forEach(function(select) {
            select.selectedIndex = 0; 
        });
    };

    function mostrarCampos(tipoUsuario) {
        
        var todosLosCampos = Array.from(document.querySelectorAll('input, select')).map(el => el.id);
        todosLosCampos.forEach(function (campo) {
            var campoElement = document.getElementById(campo);
            if (campoElement) {
                campoElement.disabled = false;
            }
        });

        var asteriscosExistentes = document.querySelectorAll('.asterisco');
        asteriscosExistentes.forEach(function (asterisco) {
            asterisco.remove();
        });

        if (tipoUsuario == 'coordinador' || tipoUsuario == 'voluntario' || tipoUsuario == 'prestador' || tipoUsuario == 'practicante') {
            var camposObligatorios = ['name', 'apellido', 'correo', 'password', 'password-confirm', 'sede', 'area', 'codigo', 'telefono', 'centro', 'carrera', 'turno', 'horas'];
            aplicarCamposObligatorios(camposObligatorios);
        }else if (tipoUsuario == 'jefe area'){
            var camposObligatorios = ['name', 'apellido', 'correo', 'password', 'password-confirm', 'sede', 'area'];
            var camposOpcionales =  ['telefono', 'codigo', 'centro', 'carrera', 'turno', 'horas' ];
            var camposBloqueados = ['turnoSelect', 'horasSelect'];
            aplicarCamposObligatorios(camposObligatorios);
            aplicarCamposOpcionales(camposOpcionales);
            aplicarCamposBloqueados(camposBloqueados);
        }else if (tipoUsuario == 'jefe sede'){
            var camposObligatorios = ['name', 'apellido', 'correo', 'password', 'password-confirm', 'sede'];
            var camposOpcionales =  ['telefono', 'codigo', 'centro', 'carrera', 'area', 'horas', 'turno' ];
            var camposBloqueados = ['turnoSelect', 'horasSelect', 'areaSelect'];
            aplicarCamposObligatorios(camposObligatorios);
            aplicarCamposOpcionales(camposOpcionales);
            aplicarCamposBloqueados(camposBloqueados);
        }else{
            var camposObligatorios = ['name', 'apellido', 'correo', 'password', 'password-confirm',  'telefono'];
            var camposOpcionales =  ['codigo', 'centro', 'carrera', 'area', 'horas', 'turno', 'sede'];
            var camposBloqueados = ['turnoSelect', 'horasSelect', 'sedeSelect', 'areaSelect'];
            aplicarCamposObligatorios(camposObligatorios);
            aplicarCamposOpcionales(camposOpcionales);
            aplicarCamposBloqueados(camposBloqueados);
        }
    }

    function aplicarCamposObligatorios(camposObligatorios){
        camposObligatorios.forEach(function (campo) {
            document.getElementById(campo).required = true;
            document.getElementById(campo).classList.add('font-bold');
            var labelElement = document.querySelector("label[for='" + campo + "']");
            if (labelElement) {
                var asteriscoElement = document.createElement('span');
                asteriscoElement.textContent = '*';
                asteriscoElement.classList.add('asterisco'); 
                labelElement.appendChild(asteriscoElement);
            }
        });
    }

    function aplicarCamposBloqueados(camposBloqueados){
        camposBloqueados.forEach(function (campo) {
            document.getElementById(campo).value = '';
            document.getElementById(campo).disabled = true;
            document.getElementById(campo).classList.remove('font-bold');
        });
    }

    function aplicarCamposOpcionales(camposOpcionales){
        camposOpcionales.forEach(function (campo) {
            document.getElementById(campo).value = ''; 
            document.getElementById(campo).classList.remove('font-bold');
            var asteriscoElement = document.getElementById(campo).parentNode.querySelector('.asterisco');
            if (asteriscoElement) {
                asteriscoElement.remove();
            }
        });
    }

    function filtroSede() {
        var sedeSelect = document.getElementById('sedeSelect');
        var areaSelect = document.getElementById('areaSelect');
        var turnoSelect = document.getElementById('turnoSelect');

        var sedeId = sedeSelect.value;
        areaSelect.innerHTML = '<option value=""> Selecciona un área de trabajo</option>';

        if (sedeId === '') {
            areaSelect.innerHTML = '<option value=""> Selecciona una sede primero</option>';
            areaSelect.disabled = true;
            turnoSelect.innerHTML = '<option value="">Selecciona una area primero</option>';
            turnoSelect.disabled = true;
            return;
        }else{
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var areas = JSON.parse(xhr.responseText);
                        areaSelect.disabled = false;
                        areas.forEach(function(area) {
                            var option = document.createElement('option');
                            option.value = area.id_area;
                            option.text = area.nombre_area;
                            areaSelect.appendChild(option);
                        });
                    } else {
                        console.error('Error al obtener las sedes');
                    }
                }
            }
        };
        xhr.open('GET', 'sede/' + sedeId);
        xhr.send();
    }

    function filtroArea() {
        var areaSelect = document.getElementById('areaSelect');
        var turnoSelect = document.getElementById('turnoSelect');
        var tipoSelect = document.getElementById('tipo');
        var tipo = tipoSelect.value;
        var area = areaSelect.value;
        turnoSelect.innerHTML = '<option value="">Selecciona un horario</option>';

        var turnoMapping = {
            'turnoMatutino': 'Matutino',
            'turnoMediodia': 'Mediodia',
            'turnoVespertino': 'Vespertino',
            'turnoSabatino': 'Sabatino',
            'turnoTiempoCompleto': 'TC'
        };

        if (area === '') {
            turnoSelect.innerHTML = '<option value="">Selecciona una area primero</option>';
            turnoSelect.disabled = true;
        } else {
            if(tipo != 'jefe area' && tipo != 'jefe sede'){
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var turnoArea = JSON.parse(xhr.responseText);
                            turnoSelect.disabled = false;
                            //console.log(turnoArea);
                            if (turnoArea[0].turnoMatutino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Matutino';
                                option1.text = 'Matutino';
                                turnoSelect.appendChild(option1);
                            }
                            if (turnoArea[0].turnoMediodia === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Mediodia';
                                option1.text = 'Mediodia';
                                turnoSelect.appendChild(option1);
                            }
                            if (turnoArea[0].turnoVespertino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Vespertino';
                                option1.text = 'Vespertino';
                                turnoSelect.appendChild(option1);
                            }
                            if (turnoArea[0].turnoSabatino === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'Sabatino';
                                option1.text = 'Sabatino';
                                turnoSelect.appendChild(option1);
                            }
                            if (turnoArea[0].turnoTiempoCompleto === 1) {
                                var option1 = document.createElement('option');
                                option1.value = 'TC';
                                option1.text = 'TC';
                                turnoSelect.appendChild(option1);
                            }
                        } else {
                            console.error('Error al obtener turno');
                        }
                    }
                };
                xhr.open('GET', 'area/' + area); 
                xhr.send();
            }else{
                turnoSelect.innerHTML = '<option value="">Los jefes de area / sede no requieren turno</option>';
            }
        }
    }


</script>
@endsection