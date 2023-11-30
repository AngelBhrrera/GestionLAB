<head>
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
</head>
<div class="modal fade" id="modelinfo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Información </h5>

            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" id="formcita" action="{{ route('api.cita_programar') }}">
                        <div class="row">

                            <div class="form-group">


                                <input id="id_citasinfo" name="id_citas"  type="hidden">
                                {{-- <select id="opcionPrestadores" class="duallistbox" name="duallistbox_demo1[]"
                                    multiple="multiple" required>

                                    @if (isset($prestadoresa))
                                        @foreach ($prestadoresa as $prestador)
                                            <option value="{{ $prestador->id }}">{{ $prestador->name }}</option>
                                        @endforeach
                                    @endif

                                </select> --}}


                            </div>

                        </div>




                        @csrf
                        <label>ID del Solicitante</label>
                        <p id="idinfo" name="id">
                        <p>
                            <label>Titulo</label>
                        <p id="proyectoinfo" name="proyecto">
                        <p>
                            <label>Palabras Clave</label>
                        <p id="palabrasinfo" name="palabrasClave"></p>
                        <label>Resumen</label>
                        <p id="observacionesinfo" name="observaciones"></p>
                        <label>Introducción</label>
                        <p id="introduccioninfo" name="introduccion"></p>
                        <label>Trabajos Relacionados</label>
                        <p id="trabajosinfo" name="trabajosRelacionados"></p>
                        <label>Propuesta</label>
                        <p id="propuestainfo" name="propuesta"></p>
                        <label>Conclusión</label>
                        <p id="conclusioninfo" name="conclusion"></p>








                        <input id="nombreinfo" name="nombre" type="hidden">
                        <input id="correoinfo" name="correo" type="hidden">

                        <input id="statusinfo" name="status" type="hidden">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Aceptar Proyecto</button>
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

{{-- /BOTON --}}


{{-- librerias necesarias para que funcione el calendario y el dualist --}}

<script src={{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

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
        document.getElementById("observacionesinfo").innerHTML = id['observaciones'];
        document.getElementById("palabrasinfo").innerHTML = id['palabrasClave'];
        document.getElementById("introduccioninfo").innerHTML = id['introduccion'];
        document.getElementById("trabajosinfo").innerHTML = id['trabajosRelacionados'];
        document.getElementById("propuestainfo").innerHTML = id['propuesta'];
        document.getElementById("conclusioninfo").innerHTML = id['conclusion'];
        //document.getElementById("fechacita").value = id['fechacita'];
        //$('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);
        document.getElementById("id_citasinfo").value = id['id_citas'];
        document.getElementById("statusinfo").value = id['status'];
        document.getElementById("nombreinfo").value = id['nombre'];
        document.getElementById("correoinfo").value = id['correo'];
        var seleccionados = document.getElementById("opcionPrestadores");
        var opciones = seleccionados.options;
        //esto es para verificar si el trabajo tiene prestadores asignados
        // if (prestadores != undefined) {
        //     //reinicia las opciones seleccionadas a false
        //     for (var o = 0; o < opciones.length; o++) {
        //         opciones[o].selected = false;

        //     }
        //     //verifica si el id de la opcion coincide con el del prestador asignado
        //     for (var i = 0; i < prestadores.length; i++) {
        //         //alert(prestadores[i]["id_prestador"]);
        //         for (var o = 0; o < opciones.length; o++) {
        //             //si coincide pus lo selecciona
        //             if (opciones[o].value == prestadores[i]["id_prestador"]) {

        //                 opciones[o].selected = true;
        //             }
        //         }
        //     }
        // } else {
        //     //reinicia las opciones seleccionadas a false
        //     for (var o = 0; o < opciones.length; o++) {
        //         opciones[o].selected = false;
        //     }
        // }
        // //refresca la duallist para que sean visibles los cambios uwu
        // $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);



    }
</script>
