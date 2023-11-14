@extends('layouts/login-layout')


@section('head')
    <title>CFE Registro</title>
@endsection


@section('content')

    <div class="w-full min-h-screen md:p-10 flex items-center justify-center">

        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-30  mt-">

            <div style="display: flex;">
                <img class="mx-auto w-40" alt="CFE" src="{{ asset('build/assets/images/cfe.svg') }}">
                <img class="mx-auto w-32" src="{{ asset('build/assets/images/logo-UDG.png') }}">
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
                            <div class="w-10 h-10 rounded-full btn btn-primary" style="background-color:#00724E;">1</div>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Ingresa Datos Basicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class=" w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400" >2</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400 ">Ingresa Datos Academicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Concluye tu registro</div>
                        </div>
                    </div>

                    <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20" id="stepTwo" style= "display:none">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Ingresa Datos Basicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn btn-primary" style="background-color:#00724E;" >2</div>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Ingresa Datos Academicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Concluye tu registro</div>
                        </div>
                    </div>

                    <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20"  id="stepThree" style= "display:none">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Ingresa Datos Basicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</div>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Ingresa Datos Academicos</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <div class="w-10 h-10 rounded-full btn btn-primary" style="background-color:#00724E;">3</div>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Concluye tu registro</div>
                        </div>
                    </div>

                <!-- END: TOP -->


                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div id="formOne"> 

                        <div class="font-medium text-base" >Ajustes de Perfil</div> 
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-1" class="form-label">Nombre</label>
                                    <input id="name" type="text" class="form-control @if(old('opc')=='1') @error('name') is-invalid @enderror @endif" name="name" required autocomplete="name" placeholder="Nombre">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-2" class="form-label">Apellido</label>
                                    <input id="apellido" type="text" class="form-control @if(old('opc')=='1') @error('apellido') is-invalid @enderror @endif" name="apellido" required autocomplete="apellido" placeholder="Apellido">
                                            @error('apellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-2" class="form-label">Correo</label>
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
                                            <option selected id="RBprestador" value='prestadorp'>Prestador</option>
                                            <option id="clientA" value='alumno' >Visitante Alumno</option>
                                            <option id="clientM" value='maestro'>Visitante Maestro</option>                    
                                            <option id="clientO" value='otro' >Visitante Otro</option>
                                            <option id="RBvoluntario" value='voluntariop'>Voluntario</option>
                                        </select>
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-4" class="form-label">Contraseña</label>
                                        <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password" required autocomplete="password" placeholder="Contraseña">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-6" class="form-label">Confirmar Contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required autocomplete="new-password" placeholder="Confirmar contraseña">
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
                                    <select class="form-control @if(old('opc')=='1') @error('centro') is-invalid @enderror @endif" name="centro" id="centro" >
                                                            @if (isset($centros))
                                                                <option id="centronull" value="{{null}}" {{isset($dV[0]->centro) ? $dV[0]->centro == null ? 'selected="selected"' : '' : ''}}>Seleccione un centro</option>
                                                                @foreach ($centros as $dato )
                                                                <option id="{{$dato->centro}}" value="{{$dato->centro}}" {{old('centro') == $dato->centro ? 'selected="selected"' : '' }}>{{$dato->centro}}</option>
                                                                @endforeach
                                                            @endif
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
                                <div class="intro-y col-span-12 sm:col-span-6" id="divHoras" style="display:none">
                                    <label for="input-wizard-2" class="form-label">Horas de Servicio</label>
                                    <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}"  placeholder="Horas de servicio">
                                                        @if(old('opc')=='1')
                                                            @error('horas')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6" id="divSede" style="display:none">
                                    <label for="input-wizard-3" class="form-label">Sede *</label>
                                    <input id="sede" type="text" class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" placeholder="Sede" >
                                        @error('sede')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                
                                <div class="intro-y col-span-12 sm:col-span-6" id="divEncargado" style="display:none">
                                    <label for="input-wizard-4" class="form-label">Encargado</label>
                                    <select class="form-control @if(old('opc')=='1') @error('id_encargado') is-invalid @enderror @endif" name="id_encargado" id="id_encargado" >
                                                            @if (isset($encargado))
                                                            <option id="encargadonull" value="{{null}}" {{isset($dV[0]->id_encargado) ? $dV[0]->id_encargado == null ? 'selected="selected"' : '' : ''}}>Seleccione un encargado</option>
                                                            @foreach ($encargado as $dato )
                                                            <option id="{{$dato->id}}" value="{{$dato->id}}" {{old('id_encargado') == $dato->id ? 'selected="selected"' : '' }}>{{$dato->name }}  {{$dato->apellido}}</option>
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
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- END: BOTTOM -->

                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">

                        <button id="div1C" class="btn btn-secondary w-24" disabled>Anterior</button>
                        <button id="div1B" class="btn btn-primary w-24 ml-2" style="background-color:#00724E;" onclick="travel(1)" type="button">Siguiente</button>
                        <button id="div2A" class="btn btn-secondary w-24" style= "display:none" onclick="travel(2)" type="button">Anterior</button>
                        <button id="div2B" class="btn btn-primary w-24 ml-2" style="background-color:#00724E; display:none" onclick="travel(3)" type="button">Siguiente</button>
                        <button id="div3" class="btn btn-secondary w-24" style= "display:none" onclick="travel(1)" type="button">Anterior</button>
                        
                        <a id="btn-login" class="navbar-brand" style= "display:none">
                            <button  type="submit" class="btn btn-primary w-24 ml-2"  style="background-color:#00724E; border-color:#006646">{{ __('Registrar') }}</button>
                            </form>
                        </a>

                    </div>

                    <div class="text-center xl:text-left">
                        <a class="navbar-brand" href="{{route('login')}}">
                        <button class="btn btn-outline-secondary w-full mt-3">
                                Iniciar sesión
                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script type="text/javascript">

    function changeCase($var){

        var ref = $var; 

        var divAlt1 = document.getElementById('div1B'); //siguiente 1
        var divAlt2 = document.getElementById('div1C'); //anterior disabled
        var divAlt6 = document.getElementById('btn-login');  //registrarse

        if(ref == '1'){

            divAlt1.style.display = "none";
            divAlt2.style.display = "";
            divAlt6.style.display = "";

        }else {
            divAlt6.style.display = "none";
            divAlt1.style.display = "";
            divAlt2.style.display = "";
        }
    }

        
        function usrNav(){

            if(document.getElementById('clientO').selected) {
                changeCase(1);
            }else if ((document.getElementById('RBprestador').selected) || (document.getElementById('RBvoluntario').selected)) {
                changeCase(2);
            }else{
                changeCase(3);
            }
        }

        
        function travel($var){

            var index = $var; 

            var step1 =  document.getElementById('stepOne');
            var step2 =  document.getElementById('stepTwo');
            var step3 =  document.getElementById('stepThree');

            var divBasic = document.getElementById('formOne');
            var divAcad = document.getElementById('formTwo');
            var divPrest = document.getElementById('formThree');

            var divAlt1 = document.getElementById('div1B'); //siguiente 1
            var divAlt2 = document.getElementById('div1C'); //anterior disabled
            var divAlt3 = document.getElementById('div2A'); //anterior 1
            var divAlt4 = document.getElementById('div2B'); //siguiente 2
            var divAlt5 = document.getElementById('div3'); //anterior 2
            var divAlt6 = document.getElementById('btn-login');  //registrarse

            var input1 = document.getElementById('divTelefono');
            var input2 = document.getElementById('divEscuela');
            var input3 = document.getElementById('divCarrera');
            var input4 = document.getElementById('divHoras');
            var input5 = document.getElementById('divSede');
            var input6 = document.getElementById('divEncargado');
            var input7 = document.getElementById('divCode');

            if(index =='1'){
                divAcad.style.display = "";
                step2.style.display = "";

                input7.style.display = "";
                input1.style.display = "";
                input2.style.display = "";
                input3.style.display = "";


                divBasic.style.display = "none";
                step1.style.display = "none";
                divAlt1.style.display = "none";
                divAlt2.style.display = "none";
                divPrest.style.display = "none";
                step3.style.display = "none";
                
                input4.style.display = "none";
                input5.style.display = "none";
                input6.style.display = "none";

                if ((document.getElementById('RBprestador').selected) || (document.getElementById('RBvoluntario').selected)){
                    divAlt3.style.display = "";
                    divAlt4.style.display = "";
                    divAlt5.style.display = "none";
                    divAlt6.style.display = "none";
                }else{
                    divAlt3.style.display = "";
                    divAlt4.style.display = "none";
                    divAlt5.style.display = "none";
                    divAlt6.style.display = "";
                }
            }else if(index == '2'){
                    divBasic.style.display = "";
                    step1.style.display = "";
                    divAlt1.style.display = "";
                    divAlt2.style.display = "";

                    divAcad.style.display = "none";
                    step2.style.display = "none";
                    divAlt3.style.display = "none";
                    divAlt4.style.display = "none";
                    divPrest.style.display = "none";

                    divAlt6.style.display = "none";

                    input1.style.display = "none";
                    input2.style.display = "none";
                    input3.style.display = "none";
                    input7.style.display = "none";
            }else if(index == '3'){

                    divPrest.style.display = "";
                    step3.style.display = "";
                    divAlt5.style.display = "";
                    divAlt6.style.display = "";
                    input4.style.display = "";
                    input5.style.display = "";
                    input6.style.display = "";

                    divAcad.style.display = "none";
                    step2.style.display = "none";
                    divAlt3.style.display = "none";
                    divAlt4.style.display = "none";
                    divAcad.style.display = "none";
                    input1.style.display = "none";
                    input2.style.display = "none";
                    input3.style.display = "none";
            }
        }

    </script>
@endsection