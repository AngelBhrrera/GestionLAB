<head>
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

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
<div class="modal fade" id="modelinfo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Agregar prestadores </h5>

            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" id="formcita" action="{{ route('api.cita_programar_3') }}">
                        <div class="row">

                            <div class="form-group">
                                <label>Prestadores</label>

                                <input id="id_citasinfo" name="id_citas" type='hidden'>
                                <select id="opcionPrestadores" class="duallistbox" name="duallistbox_demo1[]"
                                    multiple="multiple" required>

                                    @if (isset($prestadoresa))
                                        @foreach ($prestadoresa as $prestador)
                                            <option value="{{ $prestador->id }}">{{ $prestador->name." ".$prestador->apellido }}</option>
                                        @endforeach
                                    @endif

                                </select>


                            </div>
                            <!-- /.form-group -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->




                        @csrf
                        <label>ID del Proyecto</label>
                        <p id="idinfo2" name="ida">
                        </p>

                        <label>ID del Solicitante</label>
                        <p id="idinfo" name="id">
                        </p>
                            <label>Titulo</label>
                        <p id="proyectoinfo" name="proyecto">
                        </p>



                        <label>¿Estas seguro de escoger a estos prestadores?    </label>
{{--
                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                            <input name="fechacita" id="fechacita" type="text" class="form-control datetimepicker-input"
                                data-toggle="datetimepicker" data-target="#datetimepicker" autocomplete="off"
                                required />
                            <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div> --}}





                        <input id="nombreinfo" name="nombre" type='hidden' >
                        <input id="correoinfo" name="correo" type='hidden' >
                        <input id="statusinfo" name="status"  type='hidden'>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Aceptar prestadores</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="recargar()">Cerrar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- BOTON --}}

<input name="id" type="hidden" value="{{ $id }}">
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelinfo"
    onclick="modalinfo({{ json_encode($user) }},{{ $prestadores }})">
    Ver
</button>

{{-- /BOTON --}}


{{-- librerias necesarias para que funcione el calendario y el dualist --}}
<script src={{asset('dist/js/adminlte.min.js')}}></script>

<script src={{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}></script>
<script src={{ asset('plugins/moment/moment.min.js') }}></script>
<script src={{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}></script>

<script type="text/javascript">
    $('#modelinfo').modal({
        keyboard: true,
        backdrop: "static",
        show: false,
    });

    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
       removeAllLabel: 'Borrar todo'
    });



    function modalinfo(id, prestadores) {
        document.getElementById("idinfo").innerHTML = id['id'];
        document.getElementById("idinfo2").innerHTML = id['id_citas'];
        document.getElementById("proyectoinfo").innerHTML = id['proyecto'];


        document.getElementById("id_citasinfo").value = id['id_citas'];
        document.getElementById("statusinfo").value = id['status'];
        document.getElementById("nombreinfo").value = id['nombre'];
        document.getElementById("correoinfo").value = id['correo'];


        var seleccionados = document.getElementById("opcionPrestadores");
        var opciones = seleccionados.options;

        for (var o = 0; o < opciones.length; o++) {
            opciones[o].selected = false;

        }

        $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);

    }
    function recargar(){
        window.location.reload(true);
    }
</script>
