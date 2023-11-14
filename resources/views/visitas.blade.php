
    <div class="container">
        <div class="mx auto alert alert-warning" role="alert" >
            <i class="bi bi-exclamation-triangle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg></i>
            <p>Por medidas sanitarias respecto al covid19 puede haber cambios respecto a los curso y visitas al laboratorio de invetores favor de estar atento a la pagina y al las redes sociales </p>
            <p>ATTE: La Administracion</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de Visitas</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('cliente.guardarVisita') }}">
                            <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
                            <input id="id" name="name" type="hidden" value="{{ Auth::user()->name }}">
                            @csrf

                            </div>
                            @if(isset(Auth::user()->tipo))
                                <div class="form-group row">
                                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                    <div class="col-md-6">
                                        <input type="radio" name="Curso" id="Curso" value="curso1"> Curso 1 <br>
                                        <input type="radio" name="Curso" id="Curso" value="curso2"> Curso 2 <br>
                                        <input type="radio" name="Curso" id="Curso" value="curso3"> Curso 3 <br>
                                        <input type="radio" name="Curso" id="Curso" value="visitas"> Visitas <br>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Fecha:</label>
                                <div class="col-md-6 input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" id="fecha" name="fecha"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src={{asset('plugins/jquery/jquery.min.js')}}></script>

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var files = Array.from(this.files)
      var fileName = files.map(f =>{return f.name}).join(", ")
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
        </script>
        </div>

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
                format: 'DD/MM/YYYY hh A',
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
