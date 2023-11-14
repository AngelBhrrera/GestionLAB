<!DOCTYPE html>
<head>
    <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/>

</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $nombre }}</div>
                <div class="card-body">
                    <form method="POST" action="{{isset($ruta) ?  route($ruta) :route('registrar')}}">
                        <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? old('id') : $dV[0]->id }}">
                        <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : old('TipoOriginal') }}">
                        @csrf
                        <div class="form-check row">
                            <input type="checkbox" style="opacity:0; position:absolute;" class="form-check-input" type="hidden" id="alumnoCheck" name="alumnoCheck" value="1" onchange="caseAlumno()" >
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($dV[0]->name) ? $dV[0]->name : old('name')}}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{isset($dV[0]->apellido) ? $dV[0]->apellido : old('apellido')}}"  autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control  @error('correo') is-invalid @enderror "  name="correo" value="{{isset($dV[0]->correo) ? $dV[0]->correo : old('correo')}}" >
                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror



                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="tipo" id="tipo" onchange="cambiarRB()">

                                    <option id="RBcliente" value='clientes' {{(old('tipo',isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "clientes") ? "selected" : ''}}>Visitante</option>

                                    <option id="RBprestador" value='prestador' {{old('tipo', isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "prestador" ? "selected": ''}}>Prestador</option>
                                    <option id="RBadmin" value='admin' {{ old('tipo',isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "admin" ? "selected": ''}}>Administrador</option>

                                </select>

                             </div>
                        </div>
                        <div id="divcaseVisitante" style="display: none">
                            <div class="form-group row">

                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo de visitante') }}</label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="tipo_cliente" id="tipoV" onchange="cambiarRB()">

                                        <option id="RBCAlumno" value='Alumno' {{(old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Alumno") ? "selected" : ''}}>Alumno</option>

                                        <option id="RBCMaistro" value='Maestro' {{(old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Maestro") ? "selected" : ''}}>Maestro</option>
                                        <option id="RBCOtro" value='Otro' {{(old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Otro") ? "selected" : ''}}>Otro</option>

                                    </select>

                                 </div>
                            </div>
                        </div>

                        <div id="divAlumno" >
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>

                                <div class="col-md-6">
                                    <input id="codigo"  class="form-control  @error('codigo') is-invalid @enderror " name="codigo" value="{{isset($dV[0]->codigo) ? $dV[0]->codigo : old('codigo')}}" >

                                    @error('codigo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Centro') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('centro') is-invalid @enderror" name="centro" id="centro" >
                                        @if (isset($centros))
                                        <option id="centronull" value="{{null}}" {{(old('centro',isset($dV[0]->centro) ? $dV[0]->centro : '') == null) ? "selected" : ''}}>Seleccione un centro</option>
                                        @foreach ($centros as $dato )
                                        <option id="{{$dato->centro}}" value="{{$dato->centro}}" {{(old('centro',isset($dV[0]->centro) ? $dV[0]->centro : '') == $dato->centro) ? "selected" : ''}}>{{$dato->centro}}</option>

                                        @endforeach

                                        @endif

                                    </select>
                                    @error('centro')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                                <div class="col-md-6">
                                    <input id="carrera" type="text" class="form-control @error('carrera') is-invalid @enderror" name="carrera" value="{{isset($dV[0]->carrera) ? $dV[0]->carrera : old('carrera')}}"  autocomplete="carrera">
                                    @error('carrera')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{isset($dV[0]->telefono) ? $dV[0]->telefono : old('telefono')}}"  autocomplete="telefono">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('carrera') is-invalid @enderror" name="carrera" id="carrera" >
                                        @if (isset($carreras))
                                        <option id="carreranull" value="{{null}}" {{(old('carrera',isset($dV[0]->carrera) ? $dV[0]->carrera : '') == null) ? "selected" : ''}}></option>
                                        @foreach ($carreras as $dato )
                                        <option id="{{$dato->carrera}}" value="{{$dato->carrera}}" {{(old('carrera',isset($dV[0]->carrera) ? $dV[0]->carrera : '') == $dato->carrera) ? "selected" : ''}}>{{$dato->carrera}}</option>

                                        @endforeach

                                        @endif

                                    </select>
                                    @error('carrera')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div> --}}
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Puede ser admin') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('can_admin') is-invalid @enderror" name="can_admin" id="can_admin" >
                                        <option value="0" {{(old('can_admin',isset($dV[0]->can_admin) ? $dV[0]->can_admin : '') == 0) ? "selected" : ''}}>No</option>
                                        <option value="1" {{(old('can_admin',isset($dV[0]->can_admin) ? $dV[0]->can_admin : '') == 1) ? "selected" : ''}}>Si</option>
                                    </select>
                                    @error('can_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @if(old('opc')=='1') @error('encargado_id') is-invalid @enderror @endif" name="encargado_id" id="encargado_id">
                                        @if (isset($encargado))
                                        <option id="encargadonull" value="{{null}}" {{isset($dV[0]->encargado_id) ? $dV[0]->encargado_id == null ? 'selected="selected"' : '' : ''}}></option>
                                        @foreach ($encargado as $dato )
                                                <option id="{{ $dato->id }}" value="{{ $dato->id }}" {{ old('encargado_id', $dV[0]->encargado_id) == $dato->id ? 'selected="selected"' : '' }}>
                                                    {{ $dato->name }} {{ $dato->apellido }}
                                                </option>                                        @endforeach
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
                        <div id="divhoras" class="form-group row" style="display: none">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Horas') }}</label>

                            <div class="col-md-6">
                                <input id="horas" type="number" class="form-control @error('horas') is-invalid @enderror " name="horas" value="{{isset($dV[0]->horas) ? $dV[0]->horas : old('horas')}}" >
                                @error('horas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>
                        </div>

                        @if (@isset($nombre))

                            @if($nombre != 'Modificar')

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>
                            @endif

                        @endif

                <button type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Registrar') }}</button>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<!-- AdminLTE App -->
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<script type="text/javascript">
$(document).ready(function(){
    caseAlumno();
    cambiarRB();
});
function caseAlumno(){
    var divalumno = document.getElementById('divAlumno');
    var horas = document.getElementById('horas');

    if(document.getElementById('alumnoCheck').checked ){
        divalumno.style.display = "";

        document.getElementById('codigo').value = "{{isset($dV[0]->codigo) ? $dV[0]->codigo : ''}}";
    }else{
        divalumno.style.display = "none";


    }
}
function cambiarRB(){
    var divhoras = document.getElementById('divhoras');
    var horas = document.getElementById('horas');
    var caseV = document.getElementById('divcaseVisitante');
    var caseVOtro = document.getElementById('RBCOtro');
    var divalumno = document.getElementById('divAlumno');
    if(document.getElementById('RBprestador').selected) {
        document.getElementById("alumnoCheck").checked = true;
        divhoras.style.display = "";
        caseV.style.display = 'none';
        caseAlumno();
      }else {
        divhoras.style.display = "none";
        caseV.style.display = '';
        horas.value = null;

        if(caseVOtro.selected){
            divalumno.style.display = "none";

        }else{
            divalumno.style.display = "";

        }
      }
      if(document.getElementById('RBCAlumno').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
      if(document.getElementById('RBCMaistro').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
      if(document.getElementById('RBadmin').selected){
        divalumno.style.display = "none";
        caseV.style.display = 'none';

      }
}
</script>


<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->



</html>


