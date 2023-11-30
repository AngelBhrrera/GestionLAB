<!DOCTYPE html>
<head>
    <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Registro de Recompensas') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{isset($ruta) ?  route($ruta) :route('api.create_premios')}}">
                        <input id="id" name="id" type="hidden" value="{{!isset($dV[0]->id) ? old('id') : $dV[0]->id }}">
                        <input  name="TipoOriginal" type="hidden" value="{{isset($dV[0]->tipo) ? $dV[0]->tipo : old('TipoOriginal') }}">
                        @csrf




                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Recompensa') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{isset($dV[0]->nombre) ? $dV[0]->nombre : old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{isset($dV[0]->descripcion) ? $dV[0]->descripcion : old('descripcion') }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>



                        <div id="divcaseHoras" >
                            <div class="form-group row">

                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo Recompensa') }}</label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="tipo" id="tipoV" onchange="cambiarRB()">

                                        <option id="opcionHoras" value='horas' {{isset($dV[0]->tipo) ? $dV[0]->tipo == "horas" ? 'selected="selected"' : '' : old('tipo') }}>horas</option>
                                        <option id="opcionOtros" value='otro' {{isset($dV[0]->tipo) ? $dV[0]->tipo == "premio fisico" ? 'selected="selected"' : '' : old('tipo') }}>Otro</option>

                                    </select>

                                 </div>
                            </div>
                        </div>
                        <div id="divhoras" class="form-group row" style="display: none">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de horas') }}</label>

                            <div class="col-md-6">
                                <input id="horas" type="number" class="form-control @error('horas') is-invalid @enderror " name="horas" value="{{isset($dV[0]->horas) ? $dV[0]->horas : old('horas')}}">

                                @error('horas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Registrar Premio') }}</button>
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

<script>

function cambiarRB(){

    var casehoras = document.getElementById('divcasehoras');
    var horas = document.getElementById('divhoras');



      if(document.getElementById('opcionHoras').selected){
        horas.style.display = "";
      }
      else if(document.getElementById('opcionOtros').selected){
        horas.style.display = "none";
      }
    }

    $(document).ready(function(){

    cambiarRB();
    caseAlumno();
});

<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->
</script>


</html>
