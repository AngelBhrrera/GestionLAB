@extends('../layouts/base')


@section('body')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Impresión</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('inventores.formulariop') }}"  enctype="multipart/form-data">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-3" class="form-label">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                <option selected id="1" value='null'>Selecciona una opcion</option>
                                    <option id="clientA" value='alumno' >Alumno</option>
                                    <option id="clientM" value='maestro'>Maestro</option>                    
                                    <option id="clientO" value='externo' >Externo</option>
                                </select>
                        </div>
                    @csrf
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de ingresar tu nombre completo iniciando por los apellidos">    
                        <label for="name">Nombre</label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" aria-describedby="helpId" value="{{old('name')}}">
                                <small id="Help" class="form-text text-muted">Favor de ingresar tu nombre completo iniciando por los apellidos</small>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de ingresar tu apellido">
                            <label for="apellido">Apellido</label>
                            <input type="text"  class="form-control @error('apellido') is-invalid @enderror"
                                name="apellido" id="apellido" aria-describedby="helpId" value="{{old('apellido')}}">
                                <small id="Help" class="form-text text-muted">Favor de ingresar tu apellido</small>
                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de ingresar un numero de telefono valido">
                            <label for="telefono">Teléfono</label>
                            <input type="tel"class="form-control @error('telefono') is-invalid @enderror"
                            name="telefono" id="telefono" aria-describedby="helpId" value="{{old('apellido')}}">
                            <small id="Help" class="form-text text-muted">Favor de ingresar un numero de telefono valido</small>
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de ingresar tu codigo">
                            <label for="codigo">Codigo</label>
                            <input type="text"  class="form-control @error('codigo') is-invalid @enderror"
                                name="codigo" id="codigo" aria-describedby="helpId" value="{{old('codigo')}}">
                                <small id="Help" class="form-text text-muted">Favor de ingresar tu codigo</small>
                            @error('codigo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de ingresar el correo institucional">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                name="correo" id="correo" aria-describedby="emailHelpId" value="{{old('correo')}}">
                            <small id="Help" class="form-text text-muted">Favor de ingresar el correo institucional</small>
                            @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="Favor de ingresar la carrera">
                            <label for="carrera">Carrera/Departamento</label>
                                <textarea class="form-control @error('carrera') is-invalid @enderror"
                                name="carrera" id="carrera" rows="3">{{ old('carrera') }}</textarea>
                            <small id="Help" class="form-text text-muted">Ingresa tu carrera o Departamento</small>
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="ingresa tu semestre">
                            <label for="semestre" >Semestre</label>
                                <textarea class="form-control @error('semestre') is-invalid @enderror"
                                name="semestre" id="semestre" rows="3" >{{ old('semestre') }}</textarea>
                            @error('semestre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner el titulo igual al nombre de la carpeta o archivo STL que tenga en drive">
                            <label for="proyecto" >Título del Proyecto</label>
                            <input type="text"class="form-control @error('proyecto') is-invalid @enderror"
                            name="proyecto" id="proyecto" aria-describedby="helpId" value="{{ old('proyecto') }}">
                            <small id="Help" class="form-text text-muted">favor de poner el titulo igual al nombre de la carpeta que tenga en drive</small>
                                @error('proyecto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner una breve descripcion de la impresion">
                            <label for="introduccion" >Introducción del Proyecto</label>
                            <textarea class="form-control @error('introduccion') is-invalid @enderror"
                            name="introduccion" id="introduccion" rows="3" >{{ old('introduccion') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner una breve descripcion de la impresion</small>
                            @error('introduccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner como palabras calve el tipo de impresion que se va a ahacer y el nombre de los archivos STL">
                            <label for="palabrasClave" >Palabras Clave</label>
                            <textarea class="form-control @error('palabrasClave') is-invalid @enderror"
                            name="palabrasClave" id="palabrasClave" rows="3" >{{ old('palabrasClave') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner como palabras calve el tipo de impresion que se va a ahacer y el nombre de los archivos STL</small>
                            @error('palabrasClave')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner una pqueña descrpcion de tu impresion">
                            <label for="propuesta" >Propuesta de Diseño del Proyecto</label>
                            <textarea class="form-control @error('propuesta') is-invalid @enderror"
                            name="propuesta" id="propuesta" rows="3" >{{ old('propuesta') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner un resumen  de lo que quieres imprimir</small>
                            @error('propuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        
                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner un resumen  de lo que quieres imprimir">
                            <label for="observaciones">Observaciones (De 150 a 300 palabras)</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror"
                            name="observaciones" id="observaciones" rows="10" >{{ old('observaciones') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner un resumen  de lo que quieres imprimir</small>
                            @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner el nombre de otras impresiones que hallas solicitado o que esten realcioanad a la impresion que se desea realizar">
                            <label for="trabajosRelacionados">Trabajos Relacionados al Proyecto</label>
                            <textarea class="form-control @error('trabajosRelacionados') is-invalid @enderror"
                            name="trabajosRelacionados" id="trabajosRelacionados" rows="3" >{{ old('trabajosRelacionados') }}</textarea>
                            <small id="Help" class="form-text text-muted">favor de poner el nombre de otras impresiones que hallas solicitado o que esten realcioanad a la impresion que se desea realizar</small>
                                @error('trabajosRelacionados')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner el numerode piezas igual al numerode archivos STL que esten el en drive">
                            <label for="N_piezas">Número de Piezas</label>
                            <input type="number" class="form-control @error('N_piezas') is-invalid @enderror"
                            name="N_piezas" id="N_piezas" aria-describedby="helpId" value="{{ old('N_piezas') }}">
                            <small id="Help" class="form-text text-muted">favor de poner el numerode piezas igual al numerode archivos STL que esten el en drive</small>
                                @error('N_piezas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de propocionar acceso de visualizacion y descarga a la carpeta de drive">
                            <label for="enlaceDrive">Enlace Drive</label>
                            <input type="url" class="form-control @error('enlaceDrive') is-invalid @enderror"
                            name="enlaceDrive" id="enlaceDrive" aria-describedby="helpId" value="{{ old('enlaceDrive') }}">
                            <small id="Help" class="form-text text-muted">favor de propocionar acceso de visualizacion y descarga a la carpeta de drive</small>
                                @error('enlaceDrive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6" data-toggle="tooltip" data-placement="top" title="favor de poner tus comclusiones y opniones de la impresion">
                            <label for="conclusion">Conclusión del Proyecto</label>
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




<script src="https://code.jquery.com/jquery-3.6.4.min.js">
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js">
    $(document).ready(function(){
        $('#enviar').click(function(){
            var correo = document.getElementById("correo").value;
            var nombre = document.getElementById("name").value;
            var telefono = document.getElementById("telefono").value;
            var carrera = document.getElementById("carrera").value;
            var semestre = document.getElementById("semestre").value;
            var enlaceDrive = document.getElementById("enlaceDrive").value;
            var N_piezas = document.getElementById("N_piezas").value;
            var proyecto = document.getElementById("proyecto").value;
            var palabrasClave = document.getElementById("palabrasClave").value;
            var introduccion = document.getElementById("introduccion").value;
            var trabajosRelacionados = document.getElementById("trabajosRelacionados").value;
            var observaciones = document.getElementById("observaciones").value;
            var propuesta = document.getElementById("propuesta").value;
            var conclusion = document.getElementById("conclusion").value;
            var password = document.getElementById("password").value;
            var apellido = document.getElementById("apellido").value;
            var codigo = document.getElementById("codigo").value;
            var tipo = document.getElementById("tipo").value;
            var centro = document.getElementById("centro").value;
            

            localStorage.setItem("correo", correo);
            localStorage.setItem("name", nombre);
            localStorage.setItem("telefono", telefono);
            localStorage.setItem("carrera", carrera);
            localStorage.setItem("semestre", semestre);
            localStorage.setItem("enlaceDrive", enlaceDrive);
            localStorage.setItem("N_piezas", N_piezas);
            localStorage.setItem("proyecto", proyecto);
            localStorage.setItem("palabrasClave", palabrasClave);
            localStorage.setItem("introduccion", introduccion);
            localStorage.setItem("trabajosRelacionados", trabajosRelacionados);
            localStorage.setItem("observaciones", observaciones);
            localStorage.setItem("propuesta", propuesta);
            localStorage.setItem("conclusion", conclusion);
            localStorage.setItem("password", password);
            localStorage.setItem("apellido", apellido);
            localStorage.setItem("codigo", codigo);
            localStorage.setItem("tipo", tipo);
            localStorage.setItem("centro", centro);

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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js">
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
