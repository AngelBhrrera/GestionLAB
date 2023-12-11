@extends('../layouts/admin-layout')


@section('head')
<html class='dark'>
    <title>Admin Register</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Administrador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="w-full min-h-screen md:p-10 flex items-center justify-center">

            <div id="divBase" style="display: flex;"> 
                <form method="POST" action="{{ route('registrar') }}"> 
                    <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? '' : $dV[0]->id }}">
                    <input id="opc" name="opc" type="hidden" value="1">
                    <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : '' }}">
                    @csrf

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
                                            <select class="form-control" name="tipo" id="tipo" onchange="filtroVisitantes()">
                                                <option selected id="RBprestador" value='prestadorp'>Prestador Servicio Social</option>
                                                <option id="RBpracticante" value='practicantep'>Practicas Profesionales</option>
                                                <option id="RBvoluntario" value='voluntariop'>Voluntario</option>
                                                <option id="clientA" value='alumno' >Visitante Alumno</option>
                                                <option id="clientM" value='maestro'>Visitante Maestro</option>             
                                            </select>
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6"  id="divCode" >
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

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divTelefono" > 
                                        <label for="input-wizard-2" class="form-label" >Telefono *</label>
                                        <input id="telefono" type="text" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif" name="telefono" placeholder="Telefono" >
                                                @error('telefono') 
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divEscuela">
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

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                                        <label for="input-wizard-4" class="form-label">Carrera</label>
                                            <input id="carrera" type="text" class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" placeholder="Carrera" >
                                            @error('carrera')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divSede">
                                        <label for="input-wizard-3" class="form-label">Sede *</label>
                                        <select class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" id="sede" onchange="sedeNavs()" >
                                            @if (isset($sede))
                                                <option id="sede" value="{{null}}" {{isset($dV[0]->sede) ? $dV[0]->sede == null ? 'selected="selected"' : '' : ''}}>Selecciona una sede</option>
                                                @foreach ($sede as $dato )
                                                    <option id="{{$dato->nombre_Sede}}" value="{{$dato->nombre_Sede}}" {{old('sede') == $dato->id_Sede ? 'selected="selected"' : '' }}>{{$dato->nombre_Sede }} </option>
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

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divTurno">
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

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divHoras">
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
                                    
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divEncargado">
                                        <label for="input-wizard-4" class="form-label">Encargado *</label>
                                        <select class="form-control @if(old('opc')=='1') @error('id_encargado') is-invalid @enderror @endif" name="id_encargado" id="id_encargado" >
                                            @if (isset($encargado))
                                                <option id="prede" value="prede" {{isset($dV[0]->id_encargado) ? $dV[0]->id_encargado == null ? 'selected="selected"' : '' : ''}}>Seleccione un encargado</option>
                                                @foreach ($encargado as $dato )
                                                    <option id= "{{$dato->id}}" value="{{$dato->horario}}" {{old('id_encargado') == $dato->id ? 'selected="selected"' : '' }}> {{$dato->name }} {{$dato->apellido}}</option>
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

                                    <div class="intro-y col-span-12 sm:col-span-6" id="divPW">
                                        <label for="input-wizard-4" class="form-label">Contraseña *</label>
                                            <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password" required autocomplete="password" placeholder="Contraseña">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6" id="divPW2">
                                        <label for="input-wizard-6" class="form-label">Confirmar Contraseña *</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required autocomplete="new-password" placeholder="Confirmar contraseña">
                                    </div>

                            </div>
                        </div>

                        <div class="text-center xl:text-left" style="margin: 0 30% 10px 30%;">
                                <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
                                   Registrar
                                </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    <!-- END: Wizard Layout -->
@endsection

@section('script')
    <script type="text/javascript">

        function sedeNavs(){
            window.sedeDinamico = @json($sede);
            var optionSelect = document.getElementById("horarios");
            var optionSelect2 = document.getElementById("id_encargado");
            var sedeSelect = document.getElementById("sede").value;
            reiniciarEncargado(optionSelect);
            reiniciarTurno(optionSelect2);
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
                    deshabilitarOpcion(optionSelect, "NA", campo.no_Aplica === 0);
                    habilitarOpcion(optionSelect, "NA", campo.no_Aplica === 1);
                }
            });
        }

        function deshabilitarOpcion(select, opcion, condicion) {
            for (var k = 0; k < select.options.length; k++) {
                if (select.options[k].value === opcion && condicion) {
                    select.options[k].disabled = true;
                }
            }
        }
        function habilitarOpcion(select, opcion, condicion) {
            for (var k = 0; k < select.options.length; k++) {
                if (select.options[k].value === opcion && condicion) {
                    select.options[k].disabled = false;
                }
            }
        }

        function filtroEncargados(){
           window.encargadosql = @json($encargado);
           var optionSelect = document.getElementById("id_encargado");
           var turnoSelect = document.getElementById("horarios").value;
           encargadosql.forEach(function(campo){
                if(turnoSelect === campo.horario){
                    habilitarTodasLasOpciones(optionSelect);
                    deshabilitarEncargado(optionSelect, turnoSelect);
                }else{
                    deshabilitartodo(optionSelect);
                    reiniciarEncargado(optionSelect);
                }
           }); 
        }

        function deshabilitarEncargado(select, opcion){
            for (var k = 0; k < select.options.length; k++){
                if(select.options[k].value !== opcion){
                    select.options[k].disabled = true;
                }
                if(select.options[k].value === "prede"){
                    select.options[k].disabled = false;
                }
            }
        }

        function reiniciarEncargado(select){
            select.selectedIndex = 0;
        }

        function reiniciarTurno(select){
            select.selectedIndex = 0;
        }

        function deshabilitartodo(select) {
            for (var k = 0; k < select.options.length; k++) {
                select.options[k].disabled = true;
                if(select.options[k].value === "prede"){
                    select.options[k].disabled = false;
                }
            }
        }

        function habilitarTodasLasOpciones(select) {
            for (var k = 0; k < select.options.length; k++) {
                select.options[k].disabled = false;
            }
        }


    </script>
@endsection