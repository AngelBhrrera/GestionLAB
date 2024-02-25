@extends('layouts/login-layout')


@section('head')
    <title>Registro</title>
@endsection


@section('content')

    <div class="w-full min-h-screen md:p-10 flex items-center justify-center">
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-30  mt-">

            <div style="display: flex;">
                <img class="mx-auto my-auto" alt="Inventores" width="80px" height="80px" src="{{ asset('build/assets/images/logosinventores/InventoresLogoHDWhiteborder.png') }}">
            </div>

            <div id="divBase" style="display: flex;"> 
                <form method="POST" action="{{ route('registrar') }}"> 
                    <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? '' : $dV[0]->id }}">
                    <input id="opc" name="opc" type="hidden" value="1">
                    <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : '' }}">
                    @csrf

                    <!-- START: TOP -->

                    <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20" id="stepOne">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn btn-primary" >1</div>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Ingresa Datos Basicos</div>
                        </div>

                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Concluye tu registro</div>
                        </div>
                    </div>

                    <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20" id="stepTwo" style= "display:none">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Ingresa Datos Basicos</div>
                        </div>

                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn btn-primary">2</div>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Concluye tu registro</div>
                        </div>
                    </div>

                    <!-- END: TOP -->


                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div id="formOne"> 

                            <div class="font-medium text-base" >Ajustes de Perfil</div> 
                                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="input-wizard-1" class="form-label">Nombre *</label>
                                        <input id="name" type="text" class="form-control @if(old('opc')=='1') @error('name') is-invalid @enderror @endif" name="name" required autocomplete="name" placeholder="Nombre">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="input-wizard-2" class="form-label">Apellido *</label>
                                        <input id="apellido" type="text" class="form-control @if(old('opc')=='1') @error('apellido') is-invalid @enderror @endif" name="apellido" required autocomplete="apellido" placeholder="Apellido">
                                                @error('apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="input-wizard-2" class="form-label">Correo *</label>
                                        <input id="correo" type="email" class="form-control @if(old('opc')=='1') @error('correo') is-invalid @enderror @endif" name="correo" required="correo" placeholder="Correo">
                                                @error('correo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="input-wizard-3" class="form-label">Tipo</label>
                                            <select class="form-control" name="tipo" id="tipo" onchange="usrNav()">
                                                <option selected id="RBprestador" value='prestadorp'>Prestador Servicio Social</option>
                                                <option id="RBpracticante" value='practicantep'>Practicas Profesionales</option>
                                                <option id="RBvoluntario" value='voluntariop'>Voluntario</option>
                                                <option id="clientA" value='alumno' >Visitante Alumno</option>
                                                <option id="clientM" value='maestro'>Visitante Maestro</option>                    
                                                <option id="clientO" value='externo' >Visitante Externo</option>
                                            </select>
                                    </div>
                            </div>
                        </div>

                        <div> 
                            <div id="formTwo" style="display:none" class="font-medium text-base">Ajustes para Visitantes</div> 
                            <div id="formThree" style="display:none" class="font-medium text-base">Ajustes para Prestadores del Servicio Social y Voluntarios</div> 
                                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                    

                                    <div class="intro-y col-span-12 sm:col-span-6"  id="divCode" style="display:none">
                                        <label for="input-wizard-1" class="form-label"  >Codigo</label>
                                        <input id="codigo" type="text" class="form-control @if(old('opc')=='1') @error('código') is-invalid @enderror @endif"  name="codigo"  value="{{ old('opc')=='1' ? old('codigo') : '' }}" placeholder="Código"  maxlength="9">    
                                            @if(old('opc')=='1')
                                                @error('codigo')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            @endif
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divTelefono" style="display:none"> 
                                        <label for="input-wizard-2" class="form-label" >Telefono *</label>
                                        <input id="telefono" type="text" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif" name="telefono" placeholder="Telefono" maxlength="10">
                                                @error('telefono') 
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divEscuela" style="display:none">
                                        <label for="input-wizard-3" class="form-label">Escuela *</label>
                                            <select class="form-control" name="centro" id="centro">
                                            <option selected id="1" value='null'>Seleccione un centro</option>
                                                <option id="1" value='CUCEI'>CUCEI</option>
                                                <option id="2" value='CUAAD'>CUAAD</option>
                                                <option id="3" value='CUCEA'>CUCEA</option>
                                                <option id="4" value='CUCBA' >CUCBA</option>
                                                <option id="5" value='CUCSH'>CUCSH</option>                    
                                                <option id="6" value='CUCS' >CUCS</option>
                                                <option id="7" value='CUNORTE' >CUNORTE</option>
                                                <option id="8" value='CULAGOS'>CULAGOS</option>                    
                                                <option id="9" value='CUVALLE' >CUVALLE</option>
                                                <option id="10" value='CUALTOS' >CUALTOS</option>
                                                <option id="11" value='CUCOSTA'>CUCOSTA</option>                    
                                                <option id="12" value='CUCOSTA' >CUTONALA</option>
                                                <option id="13" value='CUCIENEGA' >CUCIENEGA</option>
                                                <option id="14" value='CUCSUR'>CUCSUR</option>                    
                                                <option id="15" value='CUSUR' >CUSUR</option>
                                                <option id="16" value='Otro' >Otro</option>
                                            </select>
                                            @if(old('opc')=='1')
                                                @error('centro')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            @endif
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera" style="display:none">
                                        <label for="input-wizard-4" class="form-label">Carrera</label>
                                            <input id="carrera" type="text" class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" placeholder="Carrera" >
                                            @error('carrera')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divSede" style="display:none">
                                        <label for="input-wizard-3" class="form-label">Sede</label>
                                        <select class="form-control" name="sede" id="sedeSelect"  onchange="filtroSede()">
                                            @if (isset($sede))
                                                <option id="sede" value="" >Selecciona una sede</option>
                                                @foreach ($sede as $dato )
                                                    <option id="{{$dato->id_sede}}" value="{{$dato->id_sede}}" data-nombre="{{$dato->nombre_sede}}">{{$dato->nombre_sede }} </option>
                                                @endforeach
                                            @endif
                                        </select>  
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divArea" style="display:none">
                                        <label for="input-wizard-3" class="form-label">Área de trabajo</label>
                                        <select class="form-control" id="area" name="area" required disabled  onchange="filtroArea()">
                                            <option id="0" value="">Selecciona un área de trabajo</option>
                                        </select>
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divTurno" style="display:none">
                                        <label for="input-wizard-4" class="form-label">Turno</label>
                                        <select class="form-control" name="horario" id="horarios" onchange="filtroTurno()" disabled>
                                            <option selected id="0" value="">Seleccione un turno</option> 
                                        </select>
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divHoras" style="display:none">
                                        <label for="input-wizard-2" class="form-label">Horas de Servicio *</label>
                                        <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}"  placeholder="Horas de servicio">
                                                            @if(old('opc')=='1')
                                                                @error('horas')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            @endif
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divPW" style="display:none">
                                        <label for="input-wizard-4" class="form-label">Contraseña *</label>
                                            <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password" required autocomplete="password" placeholder="Contraseña">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divPW2" style="display:none">
                                        <label for="input-wizard-6" class="form-label">Confirmar Contraseña *</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required autocomplete="new-password" placeholder="Confirmar contraseña">
                                    </div>

                                </div>
                            </div>
                        </div>     
                        <div class="text-center" style="margin: 10px 30% 10px 30%;">
                            <button id="btn-prev1" class="btn btn-secondary w-24" disabled>Anterior</button>
                            <button id="btn-next1" class="btn btn-primary w-24 ml-2" onclick="travelValid(1)" type="button">Siguiente</button>
                            <button id="btn-prev2" class="btn btn-secondary w-24" style= "display:none" onclick="travel(2)" type="button">Anterior</button>
                            <a id="btn-reg" class="navbar-brand" style= "display:none">
                                <button  type="submit" class="btn btn-primary w-24 ml-2" >{{ __('Registrar') }}</button>
                            </a>
                        </div>

                        <div class="text-center xl:text-left" style="margin: 0 30% 10px 30%;">
                            <a class="navbar-brand" href="{{route('login')}}">
                                <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="button">
                                    Iniciar sesión
                                </button>
                            </a>
                        </div>
                        
                    </div>
                    <!-- END: BOTTOM -->
                </form>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script type="text/javascript">
        //Encargado = Coordinador :)

    function changeCase($var){

        var ref = $var; 

        var next = document.getElementById('btn-next1'); //siguiente 1
        var reg = document.getElementById('btn-reg');  //registrarse

        if(ref == '1'){
            next.style.display = "none";
            reg.style.display = "";
        }else {
            reg.style.display = "none";
            next.style.display = "";
        }
    }

        function usrNav(){

            if(document.getElementById('clientO').selected) {
                changeCase(1);
            }else{
                changeCase(2);
            }
        }

        function ValidarCorreo(){
            var correo = document.getElementById("correo").value;
            var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // expresion regular de validacion
            if(!regexCorreo.test(correo)){
                alert("ingresa un correo valido");
                return false;
            }
            return true;
        }

        function travelValid($var){ // validacion antes de continuar con el registro
            if(ValidarCorreo()){
                travel($var);
            }
        }

        function travel($var){

            var index = $var; 

            if(index =='1'){
               
                document.getElementById('stepTwo').style.display = "";
                document.getElementById('btn-reg').style.display = "";
                document.getElementById('btn-prev2').style.display = "";
                document.getElementById('divCode').style.display = "";
                document.getElementById('divTelefono').style.display = "";
                document.getElementById('divEscuela').style.display = "";
                document.getElementById('divCarrera').style.display = "";

                document.getElementById('formOne').style.display = "none";
                document.getElementById('stepOne').style.display = "none";
                document.getElementById('btn-next1').style.display = "none";
                document.getElementById('btn-prev1').style.display = "none";

                if ((document.getElementById('RBprestador').selected) || (document.getElementById('RBvoluntario').selected) || (document.getElementById('RBpracticante').selected)){

                    document.getElementById('formThree').style.display = "";
                    document.getElementById('divHoras').style.display = "";
                    document.getElementById('divSede').style.display = "";
                    document.getElementById('divTurno').style.display= "";
                    document.getElementById('divArea').style.display="";

                    document.getElementById('sedeSelect').value ="";
                    document.getElementById('horarios').disabled= true;
                    document.getElementById('area').disabled=true;
                    document.getElementById('id_encargado').disabled = true;
                }else{
                    document.getElementById('formTwo').style.display = "";
                }
                document.getElementById('divPW').style.display = "";
                document.getElementById('divPW2').style.display = "";

            }else if(index == '2'){

                document.getElementById('formOne').style.display = "";
                document.getElementById('stepOne').style.display = "";
                document.getElementById('btn-next1').style.display = "";
                document.getElementById('btn-prev1').style.display = "";

                document.getElementById('formTwo').style.display = "none";
                document.getElementById('formThree').style.display = "none";
                document.getElementById('stepTwo').style.display = "none";
                document.getElementById('btn-reg').style.display = "none";
                document.getElementById('btn-prev2').style.display = "none";

                document.getElementById('divTelefono').style.display = "none";
                document.getElementById('divEscuela').style.display = "none";
                document.getElementById('divCarrera').style.display = "none";
                document.getElementById('divHoras').style.display = "none";
                document.getElementById('divSede').style.display = "none";
                document.getElementById('divCode').style.display = "none";
                document.getElementById('divPW').style.display = "none";
                document.getElementById('divPW2').style.display = "none";
                document.getElementById('divTurno').style.display = "none";
                document.getElementById('divArea').style.display = "none";
            }
        }

        function filtroSede() {
        var sedeSelect = document.getElementById('sedeSelect');
        var areaSelect = document.getElementById('area');
        
        var sedeId = sedeSelect.value;
        areaSelect.innerHTML = '<option value=""> Selecciona un área de trabajo</option>';

        if (sedeId === '') {
            areaSelect.disabled = true;
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
        var areaSelect = document.getElementById('area');
        var horarioSelect = document.getElementById('horarios');

        var area = areaSelect.value;
        horarioSelect.innerHTML = '<option value="">Selecciona un horario</option>';

        var horariosMapping = {
            'turnoMatutino': 'Matutino',
            'turnoMediodia': 'Mediodia',
            'turnoVespertino': 'Vespertino',
            'turnoSabatino': 'Sabatino',
            'turnoTiempoCompleto': 'TC'
        };

        if (area === '') {
            horarioSelect.disabled = true;
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var horariosArea = JSON.parse(xhr.responseText);
                        horarioSelect.disabled = false;
                        console.log(horariosArea);
                        if (horariosArea[0].turnoMatutino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Matutino';
                            option1.text = 'Matutino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoMediodia === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Mediodia';
                            option1.text = 'Mediodia';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoVespertino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Vespertino';
                            option1.text = 'Vespertino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoSabatino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Sabatino';
                            option1.text = 'Sabatino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoTiempoCompleto === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'TC';
                            option1.text = 'TC';
                            horarioSelect.appendChild(option1);
                        }
                    } else {
                        console.error('Error al obtener horarios');
                    }
                }
            };
            xhr.open('GET', 'area/' + area); // Asumiendo que 'sede' y 'horario' deben ser parámetros
            xhr.send();
        }
    }

    function filtroTurno() {

        var horarioSelect = document.getElementById('horarios');
        var encargadoSelect = document.getElementById('id_encargado');
        var horario = horarioSelect.value;
        var area = document.getElementById('area').value;
        encargadoSelect.innerHTML = '<option value=""> Selecciona un encargado</option>';
        if (horario === '') {
            encargadoSelect.disabled = true;
        }else{
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
                        console.error('Error al obtener coordinadores de turno');
                    }
                }
            };
            xhr.open('GET', 'turno/' + horario + '/' + area);
            xhr.send();
        }
    }
    </script>

@endsection