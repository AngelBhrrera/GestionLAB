<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}" />
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

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Registro de Actividades ({{ $tipo }})
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{route('api.actividad_reasignada')}}">

                            @if (isset($tipo))

                            <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                            @endif



                            @if (isset($id_actividad))
                            <input id="id_actividad" name="id_actividad" value={{ $id_actividad }} type="hidden">
                            @endif

                            <input id="id" name="id" type="hidden"
                                value="{{!isset($actm[0]->id) ? old('id') : $actm[0]->id }}">
                            <input name="TipoOriginal" type="hidden"
                                value="{{isset($actm[0]->tipo) ? $actm[0]->tipo : old('TipoOriginal') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">prestadores</label>
                                <div class="col-md-6">

                                    <select class="duallistbox" name="duallistbox_demo1[]" id="opcionPrestadores"
                                        multiple="multiple" required>
                                        @if (isset($prestadores))
                                        @foreach ($prestadores as $prestador)
                                        <option value="{{$prestador->id}}"> {{$prestador->name."
                                            ".$prestador->apellido}} </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 text-right">
                                <button style="" type="submit" id='enviar'
                                    class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

{{-- para que funcione todo, nota: este debe importarse primero si no, todo se chinga xd --}}

<script src={{asset('plugins/jquery/jquery.min.js')}}></script>

<!-- AdminLTE App -->
{{-- para que funcionen los componentes de adminlte como los botones laterales xd --}}
<script src={{asset('dist/js/adminlte.min.js')}}></script>

{{-- componentes necesarios para que funcione el dualistbox --}}
<script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
       removeAllLabel: 'Borrar todo'
    });


  $(function () {

    //alert(JSON.stringify(id));

    $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);

        var seleccionados = document.getElementById("opcionPrestadores");
        var opciones = seleccionados.options;
        var prestadores = {!!$llaves!!};
        //esto es para verificar si el trabajo tiene prestadores asignados
        if (prestadores != undefined ) {
            //reinicia las opciones seleccionadas a false

            //alert ("hay prestadores");

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
            //alert ("no hay prestadores");

            //reinicia las opciones seleccionadas a false
            for (var o = 0; o < opciones.length; o++) {
                opciones[o].selected = false;
            }
        }
        //refresca la duallist para que sean visibles los cambios uwu
        $('[name="duallistbox_demo1[]"]').bootstrapDualListbox('refresh', true);


            $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-calendar' },
                date: "{{$actm[0]->fecha}}",
                minDate:new Date(),
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY HH:mm:ss'});
        });

</script>