<head>
    <!-- Select2 -->

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
                <h5 class="modal-title">Información </h5>

            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" id="formcita" action="{{ route('api.cita_programar_2') }}">
                        <div class="row">

                            <div class="form-group">
                                <label>Prestadores</label>

                                <input id="id_citasinfo" name="id_citas" type="hidden">
                                {{-- <select id="opcionPrestadores" class="duallistbox" name="duallistbox_demo1[]"
                                    multiple="multiple" required>

                                    @if (isset($prestadoresa))
                                        @foreach ($prestadoresa as $prestador)
                                            <option value="{{ $prestador->id }}">{{ $prestador->name }}</option>
                                        @endforeach
                                    @endif

                                </select> --}}


                            </div>
                            <!-- /.form-group -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->




                        @csrf
                        <label>ID del Solicitante</label>
                        <p id="idinfo" name="id">
                        </p>
                            <label>Titulo</label>
                        <p id="proyectoinfo" name="proyecto">
                        </p>



                        <label>Fecha entrega de material</label>

                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                            <input name="fechacita" id="fechacita" type="text" class="form-control datetimepicker-input"
                                data-toggle="datetimepicker" data-target="#datetimepicker" autocomplete="off"
                                required />
                            <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>





                        <input id="nombreinfo" name="nombre" type="hidden">
                        <input id="correoinfo" name="correo" type="hidden">

                        <input id="statusinfo" name="status" type="hidden">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Agendar Cita</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- BOTON --}}

<input name="id" type="hidden" value="{{ $id }}">
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modelinfo"
    onclick="modalinfo({{ json_encode($user) }},{{ $prestadores }})">
    Ver
</button>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modeldelete"
    onclick="modaleliminar('{{ $id_citas }}','proyecto','{{ $proyecto }}','proyecto')">borrar</button>

{{-- /BOTON --}}


{{-- librerias necesarias para que funcione el calendario y el dualist --}}


<script src={{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script type="text/javascript">
    $('#modelinfo').modal({
        keyboard: true,
        backdrop: "static",
        show: false,
    })

    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
        nonSelectedListLabel: 'Prestadores seleccionables',
        selectedListLabel: 'Prestadores seleccionados',
        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
        removeAllLabel: 'Borrar todo'
    });


    function modalinfo(id, prestadores) {

        //alert(JSON.stringify(id));

        document.getElementById("idinfo").innerHTML = id['id'];
        document.getElementById("proyectoinfo").innerHTML = id['proyecto'];



        //document.getElementById("conclusioninfo").innerHTML = id['conclusion'];
        document.getElementById("fechacita").value = id['fechacita'];
        $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);
        document.getElementById("id_citasinfo").value = id['id_citas'];
        document.getElementById("statusinfo").value = id['status'];
        document.getElementById("nombreinfo").value = id['nombre'];
        document.getElementById("correoinfo").value = id['correo'];
        var seleccionados = document.getElementById("opcionPrestadores");
        var opciones = seleccionados.options;
        //esto es para verificar si el trabajo tiene prestadores asignados
        if (prestadores != undefined) {
            //reinicia las opciones seleccionadas a false

            alert ("hay prestadores");

            for (var o = 0; o < opciones.length; o++) {
                opciones[o].selected = false;

            }
            //verifica si el id de la opcion coincide con el del prestador asignado
            for (var i = 0; i < prestadores.length; i++) {
                //alert(prestadores[i]["id_prestador"]);
                for (var o = 0; o < opciones.length; o++) {
                    //si coincide pus lo selecciona
                    if (opciones[o].value == prestadores[i]["id_prestador"]) {

                        opciones[o].selected = true;
                    }
                }
            }
        } else {


            //reinicia las opciones seleccionadas a false
            for (var o = 0; o < opciones.length; o++) {
                opciones[o].selected = false;
            }
        }
        //refresca la duallist para que sean visibles los cambios uwu
        $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('destroy', true);



    }
    $(function () {

              $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-clock' },
                minDate:new Date(),
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY HH:mm',
                disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 14, 15, 21, 22, 23]});
          });
</script>
