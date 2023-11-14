@extends('layouts/login-layout')
@section('head')
    <title>CFE Registro</title>
@endsection
@section('content')

<div class="w-full min-h-screen md:p-10 flex items-center justify-center">

<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10  mt-5">

    <div style="display: flex;">
        <img class="mx-auto w-40" alt="CFE" src="{{ asset('build/assets/images/cfe.svg') }}">
        <img class="mx-auto w-32" src="{{ asset('build/assets/images/logo-UDG.png') }}">
    </div>
    <form method="POST" action="{{ route('registrar') }}"> 
            <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? '' : $dV[0]->id }}">
            <input id="opc" name="opc" type="hidden" value="1">
            <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : '' }}">
            @csrf
    <div id="divBase">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
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
        <!-- END: A -->
        
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="font-medium text-base">Ajustes de Perfil</div> 
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-1" class="form-label">Nombre</label>
                    <input id="input-wizard-1" type="text" class="form-control" placeholder="Nombre">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label">Apellido</label>
                    <input id="input-wizard-2" type="text" class="form-control" placeholder="Apellido">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label">Correo</label>
                    <input id="input-wizard-3" type="text" class="form-control" placeholder="Correo">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-4" class="form-label">Tipo</label>
                        <select  class="form-control" name="tipo" id="tipo" onchange="usrNav()">
                            <option id="clientA" value='Alumno' {{old('tipo') == "Alumno" ? 'selected="selected"' : '' }}>Visitante Alumno</option>
                            <option id="clientM" value='Maestro' {{old('tipo') == "Maestro" ? 'selected="selected"' : '' }}>Visitante Maestro</option>                    
                            <option id="clientO" value='Otro' {{old('tipo') == "Otro" ? 'selected="selected"' : '' }}>Visitante Otro</option>
                            <option id="RBprestador" value='prestadorp' {{old('tipo') == "prestadorp" ? 'selected="selected"' : '' }}>Prestador</option>
                            <option id="RBvoluntario" value='voluntariop' {{old('tipo') == "voluntariop" ? 'selected="selected"' : '' }}>Voluntario</option>
                        </select>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-5" class="form-label">Contraseña</label>
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

            <div id="div1B"  class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button class="btn btn-secondary w-24" disabled>Anterior</button>
                <button class="btn btn-primary w-24 ml-2" style="background-color:#00724E;" id="btn-adv1" onclick="next()">Siguiente</button>
            </div>

            <div id="div1A" style="display: none" class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button class="btn btn-secondary w-24" disabled>Anterior</button>
                <button id="btn-login" type="submit" class="btn btn-primary w-24 ml-2"  style="background-color:#00724E; border-color:#006646">{{ __('Registrar') }}</button>                                     
            </div>
            </div>
    </div>


    <div id="div2" style="display: none">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</div>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Ingresa Datos Basicos</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn btn-primary" style="background-color:#00724E;" >2</div>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400 ">Ingresa Datos Academicos</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</div>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Concluye tu registro</div>
            </div>
        </div>
        <!-- END: B -->
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="font-medium text-base">Ajustes de Perfil para Visitante</div> 
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label">Telefono</label>
                    <input id="input-wizard-2" type="text" class="form-control" placeholder="example@gmail.com">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label">Escuela</label>
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
            <div class="intro-y col-span-12 sm:col-span-6">
                <label for="input-wizard-6" class="form-label">Carrera</label>
                <input id="input-wizard-2" type="text" class="form-control" placeholder="Carrera">
            </div>
            <div id="div2B" class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button class="btn btn-secondary w-24" onclick="back()" >Anterior</button>
                <button class="btn btn-primary w-24 ml-2" style="background-color:#00724E;" id="btn-adv1" onclick="next2()">Siguiente</button>
            </div>

            <div id="div2A" class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button class="btn btn-secondary w-24" onclick="back()" >Anterior</button>
                <button id="btn-login" type="submit" class="btn btn-primary w-24 ml-2"  style="background-color:#00724E; border-color:#006646">{{ __('Registrar') }}</button>                   
            </div>
            </div>

        </div>
    </div>


    <div id="div3" style="display: none">
    <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</div>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Ingresa Datos Basicos</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</div>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400 ">Ingresa Datos Academicos</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <div class="w-10 h-10 rounded-full btn btn-primary" style="background-color:#00724E;">3</div>
                <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Concluye tu registro</div>
            </div>
        </div>
        <!-- END: C -->
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="font-medium text-base">Ajustes de Perfil para Prestador o Voluntario</div> 
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label">Codigo</label>
                    <input id="codigo" type="text" class="form-control @if(old('opc')=='1') @error('código') is-invalid @enderror @endif"  name="codigo" required autocomplete="codigo" value="{{ old('opc')=='1' ? old('codigo') : '' }}" placeholder="Código">    
                                            @if(old('opc')=='1')
                                                @error('codigo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            @endif
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label">Horas de Servicio</label>
                    <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}" required autocomplete="horas" placeholder="Horas de servicio">
                                        @if(old('opc')=='1')
                                            @error('horas')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label">Sede</label>
                    <input id="input-wizard-3" type="text" class="form-control" placeholder="Important Meeting">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="input-wizard-6" class="form-label">Encargado</label>
                    <select class="form-control @if(old('opc')=='1') @error('encargado_id') is-invalid @enderror @endif" name="encargado_id" id="encargado_id">
                                            @if (isset($encargado))
                                            <option id="encargadonull" value="{{null}}" {{isset($dV[0]->encargado_id) ? $dV[0]->encargado_id == null ? 'selected="selected"' : '' : ''}}>Seleccione un encargado</option>
                                            @foreach ($encargado as $dato )
                                            <option id="{{$dato->id}}" value="{{$dato->id}}" {{old('encargado_id') == $dato->id ? 'selected="selected"' : '' }}>{{$dato->name }}  {{$dato->apellido}}</option>
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
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button class="btn btn-secondary w-24" onclick="back2()">Anterior</button>
                    <a class="navbar-brand" >
                        <button id="btn-login" type="submit" class="btn btn-primary w-24 ml-2"  style="background-color:#00724E; border-color:#006646">{{ __('Registrar') }}</button>
                        </button>
                    </a>
            </div>
        </div>
        </div>
    </div>
    
    <div class="text-center xl:text-left">
        <a class="navbar-brand" href="{{route('login')}}">
            <button class="btn btn-outline-secondary w-full mt-3">
                Iniciar sesión
            </button>
        </a>
                        
    </div>
    </form>
    
       
</div>

    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script type="text/javascript">

    function changeCase($var){

        var ref = $var; 

        var divBasic = document.getElementById('divBase');
        var divAlt1 = document.getElementById('div1A');
        var divAlt2 = document.getElementById('div1B');
        var divAcad = document.getElementById('div2');
        var divAlt3 = document.getElementById('div2A');
        var divAlt4 = document.getElementById('div2B');
        var divPrest = document.getElementById('div3');

        divBasic.style.display = "";

        if(ref == '1'){
            divAlt1.style.display = "";
            divAlt2.style.display = "none";
            divAlt3.style.display = "none";
            divAlt4.style.display = "none";
            divAcad.style.display = "none";
            divPrest.style.display = "none";
        }else if(ref == '2'){

            divAlt1.style.display = "none";
            divAlt2.style.display = "";
            divAlt3.style.display = "none";
            divAlt4.style.display = "none";
            divAcad.style.display = "none";
            divPrest.style.display = "none";
        }else if(ref == '3'){
            divAlt1.style.display = "none";
            divAlt2.style.display = "";
            divAlt3.style.display = "none";
            divAlt4.style.display = "none";
            divAcad.style.display = "none";
            divPrest.style.display = "none";
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

        
        function next(){

            var divBasic = document.getElementById('divBase');
            var divAcad = document.getElementById('div2');
            var divAlt3 = document.getElementById('div2A');
            var divAlt4 = document.getElementById('div2B');
            var divPrest = document.getElementById('div3');
                divBase.style.display = "none";
                divAcad.style.display = "";
                divPrest.style.display = "none";
            if ((document.getElementById('RBprestador').selected) || (document.getElementById('RBvoluntario').selected)){
                divAlt3.style.display = "none";
                divAlt4.style.display = "";
            }else{
                divAlt3.style.display = "";
                divAlt4.style.display = "none";
            }
        }

        function back(){

        var divBasic = document.getElementById('divBase');
        var divAcad = document.getElementById('div2');
        var divAlt1 = document.getElementById('div1A');
        var divAlt2 = document.getElementById('div1B');
        var divPrest = document.getElementById('div3');
            divBase.style.display = "";
            divAcad.style.display = "none";
            divPrest.style.display = "none";
        }

        function next2(){

            var divBasic = document.getElementById('divBase');
            var divAcad = document.getElementById('div2');
            var divPrest = document.getElementById('div3');
                divBase.style.display = "none";
                divAcad.style.display = "none";
                divPrest.style.display = "";
        }

        function back2(){

        var divBasic = document.getElementById('divBase');
        var divAcad = document.getElementById('div2');
        var divPrest = document.getElementById('div3');
        var divAlt3 = document.getElementById('div2A');
        var divAlt4 = document.getElementById('div2B');

            divAlt3.style.display = "none"; 
            divAlt4.style.display = "";
            divBase.style.display = "none";
            divAcad.style.display = "";
            divPrest.style.display = "none";
        }


    </script>
@endsection