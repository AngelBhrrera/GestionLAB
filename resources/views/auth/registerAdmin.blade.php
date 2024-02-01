@extends('layouts/admin-layout')

@section('subhead')
<title>Admin Register</title>
@endsection

@section('breadcrumb')

<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a>Registro</a></li>
<li class="breadcrumb-item active" aria-current="page">Usuarios</li>

@endsection


@section('subcontent')
<div style="display: flex;">
    <form method="POST" action="{{ route('registrar') }}">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div id="formOne">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">Ajustes de Perfil </h3>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    @csrf
                    <!-- Sección 1 -->
                    @csrf
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="name" class="form-label">Nombre *</label>
                            <input id="name" type="text" class="form-control @if(old('opc')=='1') @error('name') is-invalid @enderror @endif" name="name" required autocomplete="off" placeholder="Nombre">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="apellido" class="form-label">Apellido *</label>
                            <input id="apellido" type="text" class="form-control @if(old('opc')=='1') @error('apellido') is-invalid @enderror @endif" name="apellido" required autocomplete="off" placeholder="Apellido">
                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="correo" class="form-label">Correo *</label>
                            <input id="correo" type="email" class="form-control @if(old('opc')=='1') @error('correo') is-invalid @enderror @endif" name="correo" required="correo" placeholder="Correo">
                            @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" onchange= "filtroTipo()">
                                <option id="admin" value='admin'>Administrador</option>
                                <option id="encargados" value='encargado'>Encargado</option>
                                <option selected id="RBprestador" value='prestador'>Prestador Servicio Social</option>
                                <option id="RBpracticante" value='practicante'>Practicas Profesionales</option>
                                <option id="RBvoluntario" value='voluntario'>Voluntario</option>
                                <option id="clientA" value='alumno'>Visitante Alumno</option>
                                <option id="clientM" value='maestro'>Visitante Maestro</option>
                                <option id="ext" value='maestro'>Visitante Externo</option>
                                
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divPW">
                            <label for="password" class="form-label">Contraseña *</label>
                            <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password" required autocomplete="password" placeholder="Contraseña">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <!-- Sección 2 -->
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6" id="divCode">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input id="codigo" type="text" class="form-control @if(old('opc')=='1') @error('código') is-invalid @enderror @endif" name="codigo" value="{{ old('opc')=='1' ? old('codigo') : '' }}" placeholder="Código">
                            @if(old('opc')=='1')
                            @error('codigo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @endif
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divTelefono">
                            <label for="telefono" class="form-label">Telefono *</label>
                            <input id="telefono" type="text" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif" name="telefono" placeholder="Telefono">
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divEscuela">
                            <label for="centro" class="form-label">Escuela *</label>
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
                            @if(old('opc')=='1')
                            @error('centro')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @endif
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                            <label for="carrera" class="form-label">Carrera</label>
                            <input id="carrera" type="text" class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" placeholder="Carrera">
                            @error('carrera')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divPW2">
                            <label for="password-confirm" class="form-label">Confirmar Contraseña *</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required autocomplete="new-password" placeholder="Confirmar contraseña">
                        </div>

                    </div>
                    <!-- Sección 3 -->
                    <div class="col-span-12 sm:col-span-4" id="ajustesPrestador">
                        <div class="intro-y col-span-12 sm:col-span-6" id="divSede">
                            <label for="sedeSelect" class="form-label">Sede</label>
                            <select class="form-control" name="sede" id="sedeSelect" onchange="filtroSede()">
                                @if (isset($sede))
                                <option id="sede" value="">Selecciona una sede</option>
                                    @foreach ($sede as $dato )
                                        <option id="{{$dato->id_sede}}" value="{{$dato->id_sede}}" data-nombre="{{$dato->nombre_sede}}">{{$dato->nombre_sede }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divArea">
                            <label for="area" class="form-label">Área de trabajo</label>
                            <select class="form-control" id="area" name="area" disabled>
                                <option id="0" value="">Selecciona un área de trabajo</option>
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divTurno">
                            <label for="horarios" class="form-label">Turno</label>
                            <select class="form-control" name="horario" id="horarios" onchange="filtroTurno()" disabled>
                                <option selected id="0" value="">Seleccione un turno</option>
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divEncargado">
                            <label for="id_encargado" class="form-label">Encargado *</label>
                            <select class="form-control @if(old('opc')=='1') @error('id_encargado') is-invalid @enderror @endif" name="id_encargado" id="id_encargado" disabled>
                                <option id="0" value="" {{isset($dV[0]->id_encargado) ? $dV[0]->id_encargado == null ? 'selected="selected"' : '' : ''}}>Seleccione un encargado</option>
                            </select>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" id="divHoras">
                            <label for="horas" class="form-label">Horas de Servicio *</label>
                            <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}" placeholder="Horas de servicio">
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-center xl:text-left">
                <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
                    Registrar
                </button>
    </form>
</div>
</div>

</div>
<div style="height: 65px;"></div>

@endsection

@section('script')

<script type="text/javascript">
    function filtroSede() {
        var sedeSelect = document.getElementById('sedeSelect');
        var areaSelect = document.getElementById('area');
        var horarioSelect = document.getElementById('horarios');

        var sedeId = sedeSelect.value;
        areaSelect.innerHTML = '<option value=""> Selecciona un área de trabajo</option>';
        horarioSelect.innerHTML = '<option value=""> Selecciona un turno </option>';
        if (sedeId === '') {
            areaSelect.disabled = true;
            horarioSelect.disabled = true;
            return;
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var areas = JSON.parse(xhr.responseText);
                        areaSelect.disabled = false;
                        horarioSelect.disabled = false;
                        areas.forEach(function(area) {
                            var option = document.createElement('option');
                            option.value = area.area_id;
                            option.text = area.nombre_area;
                            areaSelect.appendChild(option);
                        });
                        var horariosSede = areas[0];
                        if (horariosSede.turnoMatutino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Matutino';
                            option1.text = 'Matutino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosSede.turnoMediodia === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Mediodia';
                            option1.text = 'Mediodia';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosSede.turnoVespertino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Vespertino';
                            option1.text = 'Vespertino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosSede.turnoSabatino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Sabatino';
                            option1.text = 'Sabatino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosSede.turnoTiempoCompleto === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'TC';
                            option1.text = 'TC';
                            horarioSelect.appendChild(option1);
                        }
                    } else {
                        console.error(xhr)
                        console.error('Error al obtener las actividades');
                    }
                }
            }
        };
        xhr.open('GET', 'sede/' + sedeId);
        xhr.send();
    }

    function filtroTipo(){

        if ((document.getElementById('clientA').selected) || (document.getElementById('clientM').selected) || (document.getElementById('ext').selected)){
            document.getElementById('sedeSelect').disabled = true;
            document.getElementById('area').disabled = true;
            document.getElementById('horarios').disabled = true;
            document.getElementById('id_encargado').disabled = true;
            document.getElementById('horas').disabled = true;

            var divAjustesPrestador = document.getElementById('ajustesPrestador');
            var inputs = divAjustesPrestador.getElementsByTagName('select');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = "";
            }
            document.getElementsById('horas').value = "";

        }else{
            
            document.getElementById('sedeSelect').disabled = false;
            document.getElementById('area').disabled = false;
            document.getElementById('horarios').disabled = false;
            document.getElementById('id_encargado').disabled = false;
            document.getElementById('horas').disabled = false;

        }


    }

    function filtroTurno() {

        var horarioSelect = document.getElementById('horarios');
        var encargadoSelect = document.getElementById('id_encargado');
        var horario = horarioSelect.value;
        var sede = sedeSelect.value;
        encargadoSelect.innerHTML = '<option value=""> Selecciona un encargado</option>';
        if (horario === '') {
            encargadoSelect.disabled = true;
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        encargadoSelect.disabled = false;
                        var encargados = JSON.parse(xhr.responseText);
                        encargados.forEach(function(encargado) {
                            var option = document.createElement('option');
                            option.value = encargado.id;
                            option.text = encargado.name + ' ' + encargado.apellido;
                            encargadoSelect.appendChild(option);
                        });
                    } else {
                        console.error('Error al obtener encargados');
                    }
                }
            };
            xhr.open('GET', 'turno/' + horario + '/' + sede);
            xhr.send();
        }
    }
</script>
@endsection