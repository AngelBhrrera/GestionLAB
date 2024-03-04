<!DOCTYPE html>
<head>
    <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">


</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro visitas') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('api.registrarVisitas')}}">
                        @csrf
                        <input name="fecha" type="hidden" value={{$fecha}}>
                        <input id="responsable" name="responsable" type="hidden" value="{{Auth::user()->name }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{old('apellido') }}">

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div id="divAlumno" >
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Numero de telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="numero"  class="form-control  @error('numero') is-invalid @enderror " name="numero" value="{{ old('numero') }} " >

                                    @error('numero')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Hora de llegada') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input name="hora_llegada" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#timepicker" autocomplete="off"/>
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    @error('hora_llegada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Motivo de visita') }}</label>

                                <div class="col-md-6">
                                    <textarea name="motivo" class="form-control" id="myTextarea"  maxlength="255">{{old('motivo')}}</textarea>
                                    @error('motivo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                </ul>
                <button type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Registrar') }}</button>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


<script type="text/javascript">
$(function () {
    $('#timepicker').datetimepicker({
    format: 'LT'
    })
})
$(function () {
    $('#timepicker2').datetimepicker({
    format: 'LT'
    })
})
</script>


<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->



</html>


