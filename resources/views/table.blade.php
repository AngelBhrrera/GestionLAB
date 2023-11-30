<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- DataTables -->
        

        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- Theme style -->


    </head>



        <!-- Modal -->
        <div class="modal fade" id="modelIda" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reporte </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('nota') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input id="modalid" name="id" type="hidden">
                            <textarea name="nota" class="form-control" id="myTextarea" maxlength="255" required
                                {{Auth::user()->tipo != "Superadmin" ? 'disabled' : ""}}>
                    </textarea>
                            <label class='flex flex-col hover:bg-green-7000 hover:border-green-600 group'>
                                <div class='flex flex-col items-center justify-center pt-7'>
                                    <div id="divimage">
                                        <img id="imagenSeleccionada"
                                            style="max-height: 200px;max-width: 290px;min-height: 200px;min-width: 290px;"
                                            class="py-2 px-3 rounded-lg border-2 border-green-600 mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent hover:bg-green-7000 hover:border-green-600">
                                    </div>

                                    </p>

                                    <input name="imagen" id="imagen" type='file' class="hidden" {{Auth::user()->tipo !=
                                    "Superadmin" ? 'disabled' : ""}}/>
                                </div>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            @if(Auth::user()->tipo == "Superadmin" )
                            <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- eliminar --}}
        <div class="modal fade" id="modeldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>


                    <form method="POST" id="formeliminar" action="{{ route('api.eliminar') }}">

                        <input id="opcionEliminar" name="opcion" type="hidden">
                        <input id="idEliminar" name="id" type="hidden">
                        <input id="tipoEliminar" name="TipoOriginal" type="hidden">

                        @csrf

                        <p id="txtmodalEliminar">Hello World!</p>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            <button type="submit" class="btn btn-danger">borrar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalprestadoresact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('api.activar_prestadores') }}">
                        <div class="modal-body">
                            @csrf
                            <input id="idusuarioactivar" name="idusuarioactivar" type="hidden">
                            <h5>¿estas seguro de realizar esta accion?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Activar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- liberar servicio --}}

        <div class="modal fade" id="modal_liberar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('api.terminar_prestadores') }}">
                        <div class="modal-body">
                            @csrf
                            <input id="id_usuario" name="id_usuario" type='hidden'>
                            <h5>¿estas seguro de liberar servicio de este usuario?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Terminar servicio</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.terminar_actividad') }}">

                        @csrf
                        <input id="id_actividad2" name="id" value="" type='hidden'>

                        <div class="modal-header">
                            <h5 class="modal-title">Advertencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            estas seguro que quieres completar la actividad?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- Modal asignar horas-->
        <div class="modal fade" id="modalhoras" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Asignar horas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formhoras" action="{{ route('api.afirmas') }}">
                            <input id="responsable" name="responsable" type="hidden" value="{{Auth::user()->name }}">
                            <h5 id="txtmodalhoras"></h5>
                            <input id="Mhid" name="id" type="hidden">
                            <h5>Horas</h5>
                            <input class="form-control" type="number" id="Mhhoras" name="horas"><br>
                            <h5>Justificacion</h5>
                            <textarea class="form-control" id="Mhnota" name="nota"></textarea><br>
                            <label for="pdf">Archivo PDF:</label>
                            <input type="file" id="Mhpdf" name="pdf" required><br>
                            @csrf
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id='eli' class="btn btn-success">Aceptar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal desactivar prestador -->

        <div class="modal fade" id="modalprestadores" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('api.desactivar_prestadores') }}">
                        <div class="modal-body">
                            @csrf
                            <input id="iddesc" name="iddesc" type="hidden">
                            <h5>¿estas seguro de realizar esta accion?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Desactivar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal active-->
        <div class="modal fade" id="modelvalidar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activar</h5>

                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formactivar" action="{{ route('api.activar') }}">

                            <input id="idvalidar" name="id" type="hidden">

                            @csrf
                            <p id="txtmodalActivar">¿esta seguro de activar este prestador?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id='eli' class="btn btn-success">Activar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal informacion y aceptar proyectos-->


        {{-- modal actividades --}}
        <div class="modal fade" id="modelact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Informacion de actividad </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <label>id actividad</label>
                        <p id="idinfoact" name="idact">
                        <p>
                            <label>Asignado a prestador:</label>
                        <p id="asignado_a" name="asignado_a">
                        <p>
                            <label>Categoria</label>
                        <p id="nombre_categoria" name="nombre_categoria"></p>
                        <label>Actividad</label>
                        <p id="nombre_actividad" name="nombre_actividad"></p>
                        <label>nombre de la actividad</label>
                        <p id="nombreinfoact" name="nombreact">
                        <p>
                            {{-- <label>tipo de actividad</label>
                        <p id="tipoinfoact" name="tipoact"></p> --}}
                        <label>descripcion</label>
                        <p id="descinfoact" name="descact"></p>
                        <label>objetivo</label>
                        <p id="objinfoact" name="objact"></p>
                        <label>fecha</label>
                        <p id="fechainfo" name="fecha"></p>
                        <label>status</label>
                        <p id="statusact" name="statusact"></p>
                        <label>Estimacion de tiempo (usuario)</label>
                        <p id="estimacion_tiempo" name="estimacion_tiempo"></p>

                        <label>Duración de la actividad</label>
                        <p id="duracion" name="duracion"></p>

                        {{-- <p id="experiencia_obtenida" name="experiencia_obtenida" style="display:none;"></p>
                        <script>
                        var experiencia_obtenida = "{{ $experiencia_obtenida }}";
                        if(experiencia_obtenida){
                            document.getElementById("experiencia_obtenida").innerHTML = experiencia_obtenida;
                            document.getElementById("experiencia_obtenida").style.display = "block";
                        }
                        </script> --}}


                        <div id="divimagenactividad">
                            <label>imagen</label><br>
                            <img id="imagenreporte"
                                style="max-height: 200px;max-width: 290px;min-height: 200px;min-width: 290px;"
                                class="py-2 px-3 rounded-lg border-2 border-green-600 mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent hover:bg-green-7000 hover:border-green-600">
                        </div>
                        <div id="divzipactividad">
                            <br><label>zip</label><br>
                            <a href="#" id="enlaceZip">Archivo</a>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.participantes') }}">
                            @csrf
                            <input id="ida" name="idact" type="hidden">
                            <button type="submit" class="btn btn-primary">ver participante</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>

        </div>

        <div class="content">
            @include('alerta')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$titulo}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-hover display"
                                        style="overflow-x:auto;">
                                        <thead>
                                            <tr>
                                                @foreach ($datos as $dato )
                                                <th>{{$dato}}</th>

                                                @endforeach


                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                        @isset($id)
                        <h3 class="card-title">{{$id}}</h3>
                        @endisset

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>



        <script type="text/javascript">
            $('#alert').fadeIn();
    setTimeout(function() {
        $("#alert").fadeOut();
    },5000);

    $(function () {
        tabla = $("#example1").DataTable({
            "order": [[ 0, 'desc' ]],
            serverSide: true,
            buttons:true,
            ajax: {
                url:'{{route($ajaxroute)}}',
                data:{


                        "_token": "{{ csrf_token() }}",

                },
            },
            columns:{!!$columnas!!},
            pageLength: 9,
            ordering: true,

            "responsive": true, "lengthChange": true, "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                {extend: 'copy', text: 'Copiar'},
                {extend: 'print', text: 'Imprimir'},
                "csv",
                "excel",
                "pdf",
                ],
            "oLanguage": {
                "sSearch": "Buscar:",
                "sEmptyTable": "No hay informacion que mostrar",
                "sInfo": "Mostrando  del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Showing 0 to 0 of 0 records",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                },


        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('.dataTables_length').addClass('bs-select');

        $('.duallistbox').bootstrapDualListbox()
        $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-calendar' },
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY',
                minDate:new Date(),
                });



        });


    //actualizar horas
        function actualizarb(src, responsable){

        var url = '{{route('api.actualizarb')}}';
        var horas = src.value;
        var nombre = src.name;

    //alert(responsable.id+" "+responsable.name+" "+responsable.apellido);

        if(src.value == ""){
            horas = 0;
        }
        $.ajax({
            type:"POST",
            url: url,
            data:{
                    "_token": "{{ csrf_token() }}",
                    "id":src.name,
                    "horas":horas,
                    "responsable":responsable.id+" "+responsable.name+" "+responsable.apellido

            },
            }
            );
        }


        function actualizarstatus(src){

        var url = '{{route('api.actualizarstatus')}}';

        $.ajax({
            type:"POST",
            url: url,
            data:{
                    "_token": "{{ csrf_token() }}",
                    "id":src.name,
                    "status":src.value,
            },
            }
            );
        }




    function modalhoras(id,nombre){
        $('#modeldelete').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })
        document.getElementById("Mhid").value = id;
        document.getElementById("txtmodalhoras").innerHTML ='Usuario: ' + nombre;

    }


    function modelId(id) {
            $('#modalcomp').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })
            //alert(id);
            document.getElementById("id_actividad2").value = id;


        }

    function modalvalidar(id){
        $('#modeldelete').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })
        document.getElementById("idvalidar").value = id;
        document.getElementById("tipoEliminar").value = "admin.prestadoresPendientes";
    }

    function modalact(actividad){
        $('#modelact').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })

        document.getElementById("ida").value = actividad["id_actividad"];
        document.getElementById("idinfoact").innerHTML = actividad['id_actividad'];
        document.getElementById("nombreinfoact").innerHTML = actividad['nombre_act'];
        // document.getElementById("tipoinfoact").innerHTML = actividad['tipo_act'];
        document.getElementById("descinfoact").innerHTML = actividad['descripcion'];
        document.getElementById("objinfoact").innerHTML = actividad['objetivo'];
        document.getElementById("fechainfo").innerHTML = actividad['fecha'];
        document.getElementById("statusact").innerHTML = actividad['status'];
        // document.getElementById("enlaceZip").href =  "../imagen/registros/zips/"+actividad['archivo'];
        document.getElementById("imagenreporte").src = "../imagen/registros/imagenes/"+actividad['imagen'];
        // document.getElementById("asignado_a").innerHTML = actividad['asignado_a'];
        document.getElementById("estimacion_tiempo").innerHTML = actividad['estimacion_tiempo'];

        document.getElementById("duracion").innerHTML = actividad['duracion'];
        document.getElementById("nombre_categoria").innerHTML = actividad['nombre_categoria'];
        document.getElementById("nombre_actividad").innerHTML = actividad['nombre_actividad'];

        document.getElementById("asignado_a").innerHTML = actividad['nombre_prestador'];


        if(actividad['archivo']){
            document.getElementById("divzipactividad").style.display = "block";
        }else{
            document.getElementById("divzipactividad").style.display = "none";
        }
        if(actividad['imagen']){
            document.getElementById("divimagenactividad").style.display = "block";
        }else{
            document.getElementById("divimagenactividad").style.display = "none";
        }

        // if(actividad['experiencia_obtenida']){
        //     document.getElementById("experiencia_obtenida").innerHTML = actividad['experiencia_obtenida'];
        // }else{
        //     document.getElementById("experiencia_obtenida").innerHTML = "";
        // }

        if (actividad['experiencia_obtenida'] && actividad['experiencia_obtenida'].trim().length > 0) {
            document.getElementById("divexperienciaobtenida").style.display = "block";
            document.getElementById("experiencia_obtenida").innerHTML = actividad['experiencia_obtenida'];
        } else {
            document.getElementById("divexperienciaobtenida").style.display = "none";
        }
    }
        </script>


</html>