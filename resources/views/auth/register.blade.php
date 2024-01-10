@extends('layouts/login-layout')


@section('head')
    <title>Registro</title>
@endsection


@section('content')

    <div class="w-full min-h-screen md:p-10 flex items-center justify-center">
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-30  mt-">

            <div style="display: flex;">
                <img class="mx-auto my-auto" alt="Inventores" width="80px" height="80px" src="{{ asset('build/assets/logosinventores/InventoresLogoHDWhiteborder.png') }}">
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
                                        <input id="codigo" type="text" class="form-control @if(old('opc')=='1') @error('código') is-invalid @enderror @endif"  name="codigo"  value="{{ old('opc')=='1' ? old('codigo') : '' }}" placeholder="Código">    
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
                                        <input id="telefono" type="text" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif" name="telefono" placeholder="Telefono" >
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
                                        <label for="input-wizard-3" class="form-label">Sede *</label>
                                        <select class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" id="sede"  onchange="sedeNavs()">
                                            @if (isset($sede))
                                                <option id="sede" value="{{null}}" {{isset($dV[0]->sede) ? $dV[0]->sede == null ? 'selected="selected"' : '' : ''}}>Selecciona una sede</option>
                                                @foreach ($sede as $dato )
                                                    <option id="{{$dato->id_Sede}}" value="{{$dato->nombre_Sede}}"   {{old('sede') == $dato->id_Sede ? 'selected="selected"' : '' }}>{{$dato->nombre_Sede }} </option>
                                                @endforeach
                                            @endif
                                        
                                        </select>
                                        @if(old('opc')=='1')
                                            @error('sede')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        @endif      
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divTurno" style="display:none">
                                        <label for="input-wizard-4" class="form-label">Turno</label>
                                        <select class="form-control" name="horario" id="horarios" onchange="filtroEncargados()">
                                            <option selected id="1" value='null'>Seleccione un turno</option> 
                                            <option id="100" value='Matutino'>Matutino (8-12) </option>
                                            <option id="101" value='Mediodia'>Mediodia (12-4)</option>
                                            <option id="102" value='Vespertino'>Vespertino (4-8)</option>
                                            <option id="103" value='Sabatino' >Sabados</option>
                                            <option id="104" value='TC'>Tiempo completo</option>                    
                                            
                                        </select>
                                            @error('horario')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                    
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divEncargado" style="display:none">
                                        <label for="input-wizard-4" class="form-label">Encargado *</label>
                                        <select class="form-control @if(old('opc')=='1') @error('id_encargado') is-invalid @enderror @endif" name="id_encargado" id="id_encargado" disabled >
                                            @if (isset($encargado))
                                                <option id="prede" value="prede" {{isset($dV[0]->id_encargado) ? $dV[0]->id_encargado == null ? 'selected="selected"' : '' : ''}}>Seleccione un encargado</option>
                                                @foreach ($encargado as $dato )
                                                    <option id= "{{$dato->sede}}" value="{{$dato->horario}}" {{old('id_encargado') == $dato->id ? 'selected="selected"' : '' }}> {{$dato->name }} {{$dato->apellido}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if(old('opc')=='1')
                                            @error('encargado')
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

        function sedeNavs(){  // Filtros de los select (sedes)
            window.sedeDinamico = @json($sede);
            var optionSelect = document.getElementById("horarios"); 
            var optionSelect2 = document.getElementById("id_encargado");
            var sedeSelect = document.getElementById("sede").value;
            reiniciarEncargado(optionSelect);
            reiniciarTurno(optionSelect2); // reinicia los select y coloca la opcion determinada
            sedeDinamico.forEach(function(campo){                      
                if (sedeSelect === campo.nombre_Sede){
                    deshabilitarOpcion(optionSelect, "Matutino", campo.turnoMatutino === 0);
                    habilitarOpcion(optionSelect, "Matutino", campo.turnoMatutino === 1);
                    deshabilitarOpcion(optionSelect, "Mediodia", campo.turnoMediodia === 0);
                    habilitarOpcion(optionSelect, "Mediodia", campo.turnoMediodia === 1);
                    deshabilitarOpcion(optionSelect, "Vespertino", campo.turnoVespertino === 0);
                    habilitarOpcion(optionSelect, "Vespertino", campo.turnoVespertino === 1);
                    deshabilitarOpcion(optionSelect, "Sabatino", campo.turnoSabatino === 0);
                    habilitarOpcion(optionSelect, "Sabatino", campo.turnoSabatino === 1);
                    deshabilitarOpcion(optionSelect, "TC", campo.turnoTiempoCompleto === 0);
                    habilitarOpcion(optionSelect, "TC", campo.turnoTiempoCompleto === 1);
                } 
            });
        }

        function deshabilitarOpcion(select, opcion, condicion) {
            for (var k = 0; k < select.options.length; k++) {
                if (select.options[k].value === opcion && condicion){ // filtros
                    select.options[k].disabled = true;
                }
            }
        }

        function habilitarOpcion(select, opcion, condicion) {
            for (var k = 0; k < select.options.length; k++) {
                if (select.options[k].value === opcion && condicion) { // filtros
                    select.options[k].disabled = false;
                }
            }
        }

        function filtroEncargados(){ // Filtros de encargados en relacion al horario y sede
           window.encargadosql = @json($encargado);
           var optionSelect = document.getElementById("id_encargado"); // valor de las opciones de encargados
           var turnoSelect = document.getElementById("horarios").value; // valor de las opciones de turnos
           var sedeEncargado = document.getElementById("sede");
           var indiceSeleccionado = sedeEncargado.selectedIndex;
           var opcionSeleccionada = sedeEncargado.options[indiceSeleccionado];
           var valorId = opcionSeleccionada.id;    
           optionSelect.disabled = false;
           encargadosql.forEach(function(campo){
                if(turnoSelect === campo.horario){
                    if(campo.sede == valorId){
                        deshabilitartodo(optionSelect);
                        deshabilitarEncargado(optionSelect, turnoSelect, valorId, campo.sede);
                    }
                }
           }); 
        }

        function deshabilitarEncargado(select, opcion, id, sede){ // filtros
            for (var k = 1; k < select.options.length; k++){
                if(select.options[k].value === opcion){
                    if (select.options[k].id == id ){
                        select.options[k].disabled = false;
                    }
                }
                if(select.options[k].value === "prede"){
                    select.options[k].disabled = false;
                }
            }
        }

        function reiniciarEncargado(select){ // filtros
            select.selectedIndex = 0;
        }

        function reiniciarTurno(select){ // filtros
            select.selectedIndex = 0;
        }

        function deshabilitartodo(select) {
            for (var k = 0; k < select.options.length; k++) {
                select.options[k].disabled = true;
                if(select.options[k].value === "prede"){ // filtros
                    select.options[k].disabled = false;
                }
            }
        }

        function habilitarTodasLasOpciones(select) {
            for (var k = 0; k < select.options.length; k++) { // filtros
                select.options[k].disabled = false;
            }
        }

        function ValidarCorreo(){
            var correo = document.getElementById("correo").value;
            var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // exprecion regular de validacion
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

            var step1 =  document.getElementById('stepOne');
            var step2 =  document.getElementById('stepTwo');

            var divBasic = document.getElementById('formOne');
            var divAcad = document.getElementById('formTwo');
            var divPrest = document.getElementById('formThree');

            var divAlt1 = document.getElementById('btn-next1'); //siguiente 1
            var divAlt2 = document.getElementById('btn-prev1'); //anterior disabled
            var divAlt3 = document.getElementById('btn-reg');  //registrarse
            var divAlt4 = document.getElementById('btn-prev2'); //anterior 1

            var input1 = document.getElementById('divTelefono');
            var input2 = document.getElementById('divEscuela');
            var input3 = document.getElementById('divCarrera');
            var input4 = document.getElementById('divHoras');
            var input5 = document.getElementById('divSede');
            var input6 = document.getElementById('divEncargado');
            var input7 = document.getElementById('divCode');
            var input8 = document.getElementById('divPW');
            var input9 = document.getElementById('divPW2');
            var input10 = document.getElementById('divTurno');

            if(index =='1'){
               
                step2.style.display = "";
                divAlt3.style.display = "";
                divAlt4.style.display = "";

                input7.style.display = "";
                input1.style.display = "";
                input2.style.display = "";
                input3.style.display = "";


                divBasic.style.display = "none";
                step1.style.display = "none";
                divAlt1.style.display = "none";
                divAlt2.style.display = "none";

                if ((document.getElementById('RBprestador').selected) || (document.getElementById('RBvoluntario').selected) || (document.getElementById('RBpracticante').selected)){
                    divPrest.style.display = "";
                    input4.style.display = "";
                    input5.style.display = "";
                    input6.style.display = "";
                    input10.style.display= "";
                }else{
                    divAcad.style.display = "";
                }

                input8.style.display = "";
                input9.style.display = "";

            }else if(index == '2'){

                    divBasic.style.display = "";
                    step1.style.display = "";
                    divAlt1.style.display = "";
                    divAlt2.style.display = "";

                    divAcad.style.display = "none";
                    divPrest.style.display = "none";
                    step2.style.display = "none";
                    divAlt3.style.display = "none";
                    divAlt4.style.display = "none";

                    input1.style.display = "none";
                    input2.style.display = "none";
                    input3.style.display = "none";
                    input4.style.display = "none";
                    input5.style.display = "none";
                    input6.style.display = "none";
                    input7.style.display = "none";
                    input8.style.display = "none";
                    input9.style.display = "none";
                    input10.style.display = "none";
            }
        }

    </script>
@endsection