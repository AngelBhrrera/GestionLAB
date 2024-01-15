@extends('layouts/visitante-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresion</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Impresión</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('crearImpresion') }}"  enctype="multipart/form-data">

                    @csrf
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de ingresar el correo institucional">
                            <label for="">Correo</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                name="correo" id="correo" aria-describedby="emailHelpId" value="{{ auth()->check() ? auth()->user()->correo : 'Texto predeterminado' }}">
                            <small id="Help" class="form-text text-muted">Favor de ingresar el correo institucional</small>
                            @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de ingresar tu nombre completo iniciando por los apellidos">
                            <label for="">Nombre Completo</label>
                            <input type="text"  class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" id="nombre" aria-describedby="helpId" value="{{ auth()->check() ? auth()->user()->name . ' ' . auth()->user()->apellido : 'Texto predeterminado' }}">
                                <small id="Help" class="form-text text-muted">Favor de ingresar tu nombre completo iniciando por los apellidos</small>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de ingresar un numero de telefono valido">
                            <label for="">Teléfono</label>
                            <input type="tel"class="form-control @error('telefono') is-invalid @enderror"
                            name="telefono" id="telefono" aria-describedby="helpId" value="{{ auth()->check() ? auth()->user()->telefono : 'Texto predeterminado' }}">
                            <small id="Help" class="form-text text-muted">Favor de ingresar un numero de telefono valido</small>
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="Favor de ingresar la carrera">
                            <label for="">Carrera</label>
                                    @if(auth()->check())
                                        @if(auth()->user()->tipo === 'maestro')
                                        <textarea class="form-control @error('carrera') is-invalid @enderror"
                                        name="carrera" id="carrera" rows="3" disabled>{{ old('carrera') }}</textarea>
                                        @elseif(auth()->user()->tipo === 'alumno')
                                        <textarea class="form-control @error('carrera') is-invalid @enderror"
                                        name="carrera" id="carrera" rows="3">{{ old('carrera') }}</textarea> 
                                        @endif
                                    @endif
                            <small id="Help" class="form-text text-muted">Ingresa tu carrera</small>
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner tus comclusiones y opniones de la impresion">
                            <label for="">Semestre</label>
                            @if(auth()->check())
                                        @if(auth()->user()->tipo === 'maestro')
                                        <textarea class="form-control @error('carrera') is-invalid @enderror"
                                        name="carrera" id="carrera" rows="3" disabled>{{ old('carrera') }}</textarea>
                                        @elseif(auth()->user()->tipo === 'alumno')
                                        <textarea class="form-control @error('carrera') is-invalid @enderror"
                                        name="carrera" id="carrera" rows="3">{{ old('carrera') }}</textarea> 
                                        @endif
                                    @endif
                            @error('semestre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de propocionar acceso de visualizacion y descarga a la carpeta de drive">
                            <label for="">Enlace Drive</label>
                            <input type="url" class="form-control @error('enlaceDrive') is-invalid @enderror"
                            name="enlaceDrive" id="enlaceDrive" aria-describedby="helpId" value="{{ old('enlaceDrive') }}">
                            <small id="Help" class="form-text text-muted">favor de propocionar acceso de visualizacion y descarga a la carpeta de drive</small>
                                @error('enlaceDrive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>


                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner el numerode piezas igual al numerode archivos STL que esten el en drive">
                            <label for="">Número de Piezas</label>
                            <input type="number" class="form-control @error('N_piezas') is-invalid @enderror"
                            name="N_piezas" id="N_piezas" aria-describedby="helpId" value="{{ old('N_piezas') }}">
                            <small id="Help" class="form-text text-muted">favor de poner el numerode piezas igual al numerode archivos STL que esten el en drive</small>
                                @error('N_piezas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner el titulo igual al nombre de la carpeta o archivo STL que tenga en drive">
                            <label for="">Título del Proyecto</label>
                            <input type="text"class="form-control @error('proyecto') is-invalid @enderror"
                            name="proyecto" id="proyecto" aria-describedby="helpId" value="{{ old('proyecto') }}">
                            <small id="Help" class="form-text text-muted">favor de poner el titulo igual al nombre de la carpeta que tenga en drive</small>
                                @error('proyecto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>




                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner como palabras calve el tipo de impresion que se va a ahacer y el nombre de los archivos STL">
                            <label for="">Palabras Clave</label>
                            <textarea class="form-control @error('palabrasClave') is-invalid @enderror"
                            name="palabrasClave" id="palabrasClave" rows="3" >{{ old('palabrasClave') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner como palabras calve el tipo de impresion que se va a ahacer y el nombre de los archivos STL</small>
                            @error('palabrasClave')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner una breve descripcion de la impresion">
                            <label for="">Introducción del Proyecto</label>
                            <textarea class="form-control @error('introduccion') is-invalid @enderror"
                            name="introduccion" id="introduccion" rows="3" >{{ old('introduccion') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner una breve descripcion de la impresion</small>
                            @error('introduccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner el nombre de otras impresiones que hallas solicitado o que esten realcioanad a la impresion que se desea realizar">
                            <label for="">Trabajos Relacionados al Proyecto</label>
                            <textarea class="form-control @error('trabajosRelacionados') is-invalid @enderror"
                            name="trabajosRelacionados" id="trabajosRelacionados" rows="3" >{{ old('trabajosRelacionados') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner el nombre de otras impresiones que hallas solicitado o que esten realcioanad a la impresion que se desea realizar</small>
                                @error('trabajosRelacionados')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner un resumen  de lo que quieres imprimir">
                            <label for="">Resumen del Proyecto (De 150 a 300 palabras)</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror"
                            name="observaciones" id="observaciones" rows="10" >{{ old('observaciones') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner un resumen  de lo que quieres imprimir</small>
                            @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>


                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner una pqueña descrpcion de tu impresion">
                            <label for="">Propuesta de Diseño del Proyecto</label>
                            <textarea class="form-control @error('propuesta') is-invalid @enderror"
                            name="propuesta" id="propuesta" rows="3" >{{ old('propuesta') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner un resumen  de lo que quieres imprimir</small>
                            @error('propuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="favor de poner tus comclusiones y opniones de la impresion">
                            <label for="">Conclusión del Proyecto</label>
                            <textarea class="form-control @error('conclusion') is-invalid @enderror"
                            name="conclusion" id="conclusion" rows="3" >{{ old('conclusion') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner tus comclusiones y opniones de la impresion</small>
                            @error('conclusion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="col-md-12 text-right">
                            <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                                Enviar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection




<script>
    $('#alert').fadeIn();
      setTimeout(function() {
           $("#alert").fadeOut();
      },5000);
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var files = Array.from(this.files)
  var fileName = files.map(f =>{return f.name}).join(", ")
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
(function(){
$('.from-prevent-multiple-submits').on('submit', function(){
    $('.from-prevent-multiple-submits').attr('disabled','true');
})
})();
</script>

<script type="text/javascript">
    $(document).ready(function(){
        cambiar();
    });
    function cambiar(){
        var divAlumno = document.getElementById('divAlumno');
        if(document.getElementById('opcMaestro').selected){
            divalumno.style.display = "none";
        }else{
            divalumno.style.display = "";
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#enviar').click(function(){
            var correo = document.getElementById("correo").value;
            var nombre = document.getElementById("nombre").value;
            var telefono = document.getElementById("telefono").value;
            var enlaceDrive = document.getElementById("enlaceDrive").value;
            var N_piezas = document.getElementById("N_piezas").value;
            var proyecto = document.getElementById("proyecto").value;
            var palabrasClave = document.getElementById("palabrasClave").value;
            var introduccion = document.getElementById("introduccion").value;
            var trabajosRelacionados = document.getElementById("trabajosRelacionados").value;
            var observaciones = document.getElementById("observaciones").value;
            var propuesta = document.getElementById("propuesta").value;
            var conclusion = document.getElementById("conclusion").value;

            localStorage.setItem("correo", correo);
            localStorage.setItem("nombre", nombre);
            localStorage.setItem("telefono", telefono);
            localStorage.setItem("enlaceDrive", enlaceDrive);
            localStorage.setItem("N_piezas", N_piezas);
            localStorage.setItem("proyecto", proyecto);
            localStorage.setItem("palabrasClave", palabrasClave);
            localStorage.setItem("introduccion", introduccion);
            localStorage.setItem("trabajosRelacionados", trabajosRelacionados);
            localStorage.setItem("observaciones", observaciones);
            localStorage.setItem("propuesta", propuesta);
            localStorage.setItem("conclusion", conclusion);

            // document.getElementById("correo").value = "";
            // document.getElementById("nombre").value = "";
            // document.getElementById("telefono").value = "";
            // document.getElementById("enlaceDrive").value = "";
            // document.getElementById("N_piezas").value = "";
            // document.getElementById("proyecto").value = "";
            // document.getElementById("palabrasClave").text = "";
            // document.getElementById("introduccion").text = "";
            // document.getElementById("trabajosRelacionados").text = "";
            // document.getElementById("observaciones").text = "";
            // document.getElementById("propuesta").text = "";
            // document.getElementById("conclusion").text = "";

        });
    });

    
</script>

    <!-- Bootstrap 4 -->

    <!-- Page specific script -->
    <script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date picker
          $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY hh:mm A',
            icons: { time: 'far fa-clock' }

          });

          //Timepicker
          $('#timepicker').datetimepicker({
            format: 'LT'
          })

          //Bootstrap Duallistbox
          $('.duallistbox').bootstrapDualListbox()

          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()

          $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
          })

          $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })

        })
    </script>
