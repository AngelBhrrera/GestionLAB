@extends('../layout/' . $layout)

@section('head')
    <title>REGISTRO CONFIRMACIÓN CONTRASEÑA</title>
@endsection

@section('content')
    <div class="container">
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-64" alt="CFE" src="{{ asset('build/assets/images/cfe.png') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-14">{{ __('Registro') }}</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                <form method="POST" >
                    <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? '' : $dV[0]->id }}">
                    <input id="opc" name="opc" type="hidden" value="1">
                    <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : '' }}">
                    @csrf
                <div class="form-check row">
                    <input type="checkbox" style="opacity:0; position:absolute;" class="form-check-input" type="hidden" id="alumnoCheck" name="alumnoCheck" value="1" onchange="caseAlumno()" >
                </div>
                <div class="form-group row">
                    <label for="name" class="xl:mt-8 col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{!isset($dV[0]->name) ? old('name') : $dV[0]->name }}" autocomplete="name">
                        @if(old('opc')=='1')
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                    <div class="col-md-6">
                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('opc')=='1' ? old('apellido') : '' }}" required autocomplete="apellido" >
                        @if(old('opc')=='1')
                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>
                    <div class="col-md-6">
                        <input id="correo" type="email" class="form-control @if(old('opc')=='1') @error('correo') is-invalid @enderror @endif"  name="correo" value="{{ old('opc')=='1' ? old('correo') : '' }}" >
                        @if(old('opc')=='1')
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @endif


                    </div>
                </div>

                <div class="form-group row">

                    <label  class="col-md-4 col-form-label xl:mt-8 text-md-right">{{ __('Tipo de usuario') }}</label>
                    <div class="col-md-6">
                        <select  class="form-control" name="tipo" id="tipo" onchange="cambiarRB()">

                            <option id="RBcliente" value='clientes' {{old('tipo') == "clientes" ? 'selected="selected"' : '' }}>Visitante</option>

                            <option id="RBprestador" value='prestadorp' {{old('tipo') == "prestadorp" ? 'selected="selected"' : '' }}>Prestador</option>

                        </select>

                     </div>
                </div>
                <div id="divcaseVisitante" style="display: none">
                    <div class="form-group row">

                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo de visitante') }}</label>
                        <div class="col-md-6">
                            <select  class="form-control" name="tipo_cliente" id="tipoV" onchange="cambiarRB()">

                                <option id="RBCAlumno" value='Alumno' {{old('tipo_cliente') == "Alumno" ? 'selected="selected"' : '' }}>Alumno</option>

                                <option id="RBCMaistro" value='Maestro' {{old('tipo_cliente') == "Maestro" ? 'selected="selected"' : '' }}>Maestro</option>
                                <option id="RBCOtro" value='Otro' {{old('tipo_cliente') == "Otro" ? 'selected="selected"' : '' }}>Otro</option>

                            </select>

                         </div>
                    </div>
                </div>

                <div id="divAlumno" >
                    <div class="form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>

                        <div class="col-md-6">
                            <input id="codigo"  class="form-control @if(old('opc')=='1') @error('codigo') is-invalid @enderror @endif" name="codigo" value="{{ old('codigo') }} " >
                            @if(old('opc')=='1')
                            @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                        <div class="col-md-6">
                            <select class="form-control @if(old('opc')=='1') @error('carrera') is-invalid @enderror @endif" name="carrera" id="carrera" >
                                @if (isset($carreras))
                                <option id="carreranull" value="{{null}}" {{isset($dV[0]->carrera) ? $dV[0]->carrera == null ? 'selected="selected"' : '' : ''}}></option>
                                @foreach ($carreras as $dato )
                                <option id="{{$dato->carrera}}" value="{{$dato->carrera}}" {{old('carrera') == $dato->carrera ? 'selected="selected"' : '' }}>{{$dato->carrera}}</option>

                                @endforeach

                                @endif

                            </select>
                            @if(old('opc')=='1')
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Centros') }}</label>

                        <div class="col-md-6">
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
                    </div>

                    <div class="form-group row">
                        <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>
    
                        <div class="col-md-6">
                            <input id="carrera" type="text" class="form-control @error('carrera') is-invalid @enderror" name="carrera" value="{{ old('opc')=='1' ? old('carrera') : '' }}" required autocomplete="carrera" >
                            @if(old('opc')=='1')
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{isset($dV[0]->telefono) ? $dV[0]->telefono : old('telefono')}}"  autocomplete="telefono">
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="xl:mt-8 form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
    
                        <div class="col-md-6">
                            <input id="telefono" type="text" max="10" class="form-control @if(old('opc')=='1') @error('telefono') is-invalid @enderror @endif"  name="telefono" value="{{ old('opc')=='1' ? old('telefono') : '' }}" >
                            @if(old('opc')=='1')
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif
    
    
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Encargados') }}</label>
                    
                        <div class="col-md-6">
                            <select class="form-control @if(old('opc')=='1') @error('encargado') is-invalid @enderror @endif" name="encargado" id="encargado">
                                <option value="">Selecciona un encargado</option>
                                @foreach ($encargados as $encargado)
                                    <option value="{{ $encargado->id }}" {{ old('encargado') == $encargado->id ? 'selected' : '' }}>{{ $encargado->nombre }}</option>
                                @endforeach
                            </select>
                    
                            @if(old('opc')=='1')
                                @error('encargado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @endif
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label  class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>

                        <div class="col-md-6">
                            <select class="form-control @if(old('opc')=='1') @error('encargado_id') is-invalid @enderror @endif" name="encargado_id" id="encargado_id">
                                @if (isset($encargado))
                                <option id="encargadonull" value="{{null}}" {{isset($dV[0]->encargado_id) ? $dV[0]->encargado_id == null ? 'selected="selected"' : '' : ''}}></option>
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
                    </div>

                </div>
                <div id="divhoras" class="xl:mt-8 form-group row" style="display: none">
                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Horas de servicio') }}</label>

                    <div class="col-md-6">
                        <input id="horas" type="number" class="form-control @if(old('opc')=='1') @error('horas') is-invalid @enderror @endif " name="horas" value="{{old('horas')}}">
                        @if(old('opc')=='1')
                            @error('horas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @endif

                    </div>
                </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @if(old('opc')=='1') @error('password') is-invalid @enderror @endif" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <input type="text" class="form-control py-3 px-4 block mt-4" placeholder="Password Confirmation">
                    <div class="flex items-center text-slate-500 mt-4 text-xs sm:text-sm">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                        <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
                    </div>
                        </div>
        </ul>
        <div class="mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary w-full xl:mr-3">Register</button>
                        <button class="btn btn-outline-secondary w-full mt-3">Sign in</button>
        </div>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
