<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Impresión</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('cliente.cita') }}"  enctype="multipart/form-data">

                    @csrf
                        <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" id="correo" aria-describedby="emailHelpId"  value="{{old('correo',Auth::user()->correo)  }}">
                            @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nombre Completo</label>
                            {{ $nombre_completo = Auth::user()->nombre}}
                            <input type="text"
                            class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" aria-describedby="helpId" value="{{ Auth::user()->name . " ". Auth::user()->apellido }}">
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="tel"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" aria-describedby="helpId" value="{{ old('telefono') }}">
                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="">credencial</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('credencial') is-invalid @enderror" name="credencial" id="credencial"  aria-describedby="fileHelpId" >
                                    <label for="" class="custom-file-label"> Elige una imagen</label>

                                </div>

                            </div>
                            <label for="" >Solo permite imagenes jpg, jpeg o png y un tamaño maximo de 5MB </label>

                        </div>

                        <div class="form-group">
                            <label for="">Render</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('render') is-invalid @enderror" name="render" id="render"  aria-describedby="fileHelpId">
                                    <label for="" class="custom-file-label"> Elige un Archivo</label>
                                </div>

                            </div>
                            <label for="" >Solo permite archivoSTLs zip (Solo Imagenes) y un tamaño maximo de 20MB</label>
                        </div>
                        <div class="form-group">
                            <label for="">ArchivoSTL STL</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('ArchivoSTL') is-invalid @enderror" name="ArchivoSTL" id="ArchivoSTL" aria-describedby="fileHelpId">
                                    <label for="" class="custom-file-label"> Elige un Archivo</label>
                                </div>
                            </div>
                            <label for="" >Solo permite archivoSTLs zip y un tamaño maximo de 100MB </label>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Enlace Drive</label>
                            <input type="url"
                                class="form-control @error('enlaceDrive') is-invalid @enderror" name="enlaceDrive" id="enlaceDrive" aria-describedby="helpId" value="{{ old('enlaceDrive') }}">
                                @error('enlaceDrive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Numero de piezas</label>
                            <input type="number"
                                class="form-control @error('N_piezas') is-invalid @enderror" name="N_piezas" id="N_piezas" aria-describedby="helpId" value="{{ old('N_piezas') }}">
                                @error('N_piezas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Titulo del proyecto</label>
                            <input type="text"
                                class="form-control @error('proyecto') is-invalid @enderror" name="proyecto" id="proyecto" aria-describedby="helpId" value="{{ old('proyecto') }}">
                                @error('proyecto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>




                        <div class="form-group">
                            <label for="">Palabras clave</label>
                            <textarea class="form-control @error('palabrasClave') is-invalid @enderror" name="palabrasClave" id="palabrasClave" rows="3" >{{ old('palabrasClave') }}</textarea>
                            @error('palabrasClave')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Introducción del proyecto</label>
                            <textarea class="form-control @error('introduccion') is-invalid @enderror" name="introduccion" id="introduccion" rows="3" >{{ old('introduccion') }}</textarea>
                            @error('introduccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="">trabajos relacionados al proyecto</label>
                            <textarea class="form-control @error('trabajosRelacionados') is-invalid @enderror" name="trabajosRelacionados" id="trabajosRelacionados" rows="3" >{{ old('trabajosRelacionados') }}</textarea>
                                @error('trabajosRelacionados')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Resumen del proyecto (De 150 a 300 letras)</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones" rows="10" >{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Propuesta de diseño del proyecto</label>
                            <textarea class="form-control @error('propuesta') is-invalid @enderror" name="propuesta" id="propuesta" rows="3" >{{ old('propuesta') }}</textarea>
                            @error('propuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Conclusión del proyecto</label>
                            <textarea class="form-control @error('conclusion') is-invalid @enderror" name="conclusion" id="conclusion" rows="3" >{{ old('conclusion') }}</textarea>
                            @error('conclusion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>





                        <div class="col-md-12 text-right" >
                            <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




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

<script>
    function cargarInfo (){

        var correo = localStorage.getItem("correo");
        var nombre = localStorage.getItem("nombre");
        var telefono = localStorage.getItem("telefono");
        var enlaceDrive = localStorage.getItem("enlaceDrive");
        var N_piezas = localStorage.getItem("N_piezas");
        var proyecto = localStorage.getItem("proyecto");
        var palabrasClave = localStorage.getItem("palabrasClave");
        var introduccion = localStorage.getItem("introduccion");
        var trabajosRelacionados = localStorage.getItem("trabajosRelacionados");
        var observaciones = localStorage.getItem("observaciones");
        var propuesta = localStorage.getItem("propuesta");
        var conclusion = localStorage.getItem("conclusion");

        document.getElementById("correo").value = correo;
        document.getElementById("nombre").value = nombre;
        document.getElementById("telefono").value = telefono;
        document.getElementById("enlaceDrive").value = enlaceDrive;
        document.getElementById("N_piezas").value = N_piezas;
        document.getElementById("proyecto").value = proyecto;
        document.getElementById("palabrasClave").text = palabrasClave;
        document.getElementById("introduccion").text = introduccion;
        document.getElementById("trabajosRelacionados").text = trabajosRelacionados;
        document.getElementById("observaciones").text = observaciones;
        document.getElementById("propuesta").text = propuesta;
        document.getElementById("conclusion").text = conclusion;
    }
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
