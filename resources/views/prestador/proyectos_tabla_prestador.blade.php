@extends('layouts/prestador-layout')

@section('subcontent')

<div class="container">
        <!-- ---------------------------------------------------------------------------->
        <!-- MODALS-->

        <!-- Modal de info-->


        <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Información</h5>

                        <input id="id_proyecto" name="id" type="hidden" >

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>Nombre del cliente:</p>
                        <p  id="nombre_cliente" name="nombre_cliente" value="dsdas"></p>
                        <br>
                        <p>Correo cliente:</p>
                        <p  id="correo_cliente" name="correo_cliente"></p>
                        <br>
                        <p>Telefono cliente:</p>
                        <p  id="telefono_cliente" name="telefono_cliente"></p>
                        <br>
                        <p>Nombre del Proyecto:</p>
                        <p  id="Nombre_Proyecto" name="Nombre_Proyecto"></p>
                        <br>
                        <p>Enlace Drive:</p>
                        <p  id="enlaceDrive" name="enlaceDrive"></p>
                        <br>
                        <p>Propuesta:</p>
                        <p  id="propuesta" name="propuesta"></p>
                        <br>
                        <p>Introducción:</p>
                        <p  id="introduccion" name="introduccion"></p>
                        <br>
                        <p>Observaciones:</p>
                        <p  id="observaciones" name="observaciones"></p>
                        <br>
                        <p>Palabras Clave:</p>
                        <p  id="palabras_clave" name="palabrasClave"></p>
                        <br>
                        <p>Numero de Piezas:</p>
                        <p  id="N_piezas" name="N_piezas"></p>
                        <br>
                        <p>Trabajos Relacionados:</p>
                        <p  id="trabajosRelacionados" name="trabajosRelacionados"></p>
                        <br>
                        <p>Conclusión:</p>
                        <p  id="conclusion" name="conclusion"></p>
                        <br>
                        <p>Fecha de entrega del material:</p>
                        <p  id="fechacita" name="fechacita"></p>
                        <br>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de completado -->
        <div class="modal fade" id="modalcomp" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('completar_impresion') }}">

                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Advertencia</h5>

                            <input id="id_proyecto2" name="id" type="hidden" value="">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea completar el trabajo?
                            <br>
                            <br>
                            En caso de estar en un equipo,
                            solo un miembro del equipo debe aceptar el trabajo
                            ya que al aceptar afecta al proyecto en general.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                            <button type="summit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODALS END-->

        <!------------------------------------------------------------------------->

        <!-- MODAL ACT-->

        <div class="modal fade" id="modalact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Información</h5>

                        <input id="id_actividad" name="id" type="hidden" >

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>nombre de la actividad:</p>
                        <p  id="nombre_actividad" name="nombre_actividad"></p>
                        <br>
                        <p>tipo de actividad:</p>
                        <p  id="tipo_actividad" name="tipo_actividad"></p>
                        <br>
                        <p>prestadores asignados:</p>
                        <p  id="prestadores_asignados" name="prestadores_asignados"></p>
                        <p  id="prestadores_asignadosa" name="prestadores_asignados"></p>
                        <br>
                        <p>descripcion de la actividad:</p>
                        <p  id="descripcion" name="descripcion"></p>
                        <br>
                        <p>objetivo de la actividad:</p>
                        <p  id="objetivo" name="objetivo"></p>
                        <br>
                        <p>fecha de entrega:</p>
                        <p  id="fecha" name="fecha"></p>
                        <br>
                        <p>status:</p>
                        <p  id="status" name="status"></p>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalcompact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('completar_actividad') }}">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>

                        <input id="id_actividad2" name="id" type="hidden" value="">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Desea completar el trabajo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                        <button type="summit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <!--BODY CARDS -->
        <h1 class="text-center">Impresiones Asignadas</h1>
        <div class="row justify-content-center">
            @foreach ($impresiones as $impresion)
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-header text-white bg-secondary mb-3 text-center ">
                        <h4 class="card-title">Nombre: {{ $impresion->Nombre_Proyecto }}</h4>
                    </div>
                    <div class="card-body">

                        <label for="" id="nombre" name="nombre">Nombre del cliente:
                            {{ $impresion->nombre_cliente }}</label>
                        <br>
                        <label for="" id="telefono" name="telefono">telefono: {{ $impresion->telefono_cliente }}</label>
                        <br>
                        <label for="" id="correo" name="correo">Correo: {{ $impresion->correo_cliente }} </label>
                        <br>
                        <label for="" id="url" name="url">Drive: </label>
                        <a href="{{ url($impresion->enlaceDrive) }}"> {{ $impresion->enlaceDrive }}</a>
                        <br>

                    </div>
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalInfo"
                            onclick="modalInformacion({{json_encode($impresion)}})">
                            Mas
                        </button>

                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalcomp"
                            onclick="modalCompletado('{{ $impresion->id_proyecto }}')">
                            Completado
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- actividades --}}

        <h1 class="text-center">Actividades Asignadas</h1>
        <div class="row justify-content-center">
            @foreach ($actividades as $actividad)
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-header text-white bg-secondary mb-3 text-center ">
                        <h4 class="card-title">Nombre: {{ $actividad->nombre_act }}</h4>
                    </div>

                    <div class="card-body">

                        <label for="" id="nombre" name="nombre">tipo de actividad:
                            {{ $actividad->tipo_act }}</label>
                        <br>
                        <label for="" id="telefono" name="telefono">fecha de entrega: {{ $actividad->fecha}}</label>
                        <br>

                    </div>

                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalact"
                            onclick="modalActividad({{json_encode($actividad)}})">
                            Mas
                        </button>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalcompact"
                        onclick="modalComAct('{{ $actividad->id_actcreada }}')">
                            Completado
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
    <script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('dist/js/adminlte.min.js') }}></script>
          <!-- AdminLTE App -->




    <script type="text/javascript">
        // --------------------------------------------------------------------------
        //MODALS

        function modalInformacion(impresion) {
            $('#modalInfo').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })

           //alert(JSON.stringify(impresion));

            document.getElementById("id_proyecto").value = impresion["id_proyecto"];
            document.getElementById("nombre_cliente").innerHTML = impresion["nombre_cliente"];
            document.getElementById("correo_cliente").innerHTML = impresion["correo_cliente"];
            document.getElementById("telefono_cliente").innerHTML = impresion["telefono_cliente"];
            document.getElementById("Nombre_Proyecto").innerHTML = impresion["Nombre_Proyecto"];
            document.getElementById("enlaceDrive").innerHTML = impresion["enlaceDrive"];
            document.getElementById("N_piezas").innerHTML = impresion["N_piezas"];
            document.getElementById("palabras_clave").innerHTML = impresion["palabrasClave"];
            document.getElementById("introduccion").innerHTML = impresion["introduccion"];
            document.getElementById("observaciones").innerHTML = impresion["observaciones"];
            document.getElementById("trabajosRelacionados").innerHTML = impresion["trabajosRelacionados"];
            document.getElementById("propuesta").innerHTML = impresion["propuesta"];
            document.getElementById("conclusion").innerHTML = impresion["conclusion"];
            document.getElementById("fechacita").innerHTML = impresion["fechacita"];

        }

        function modalCompletado(id) {
            $('#modalcomp').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })

            //alert(id);

            document.getElementById("id_proyecto2").value = id;


        }
        //MODALS END
        // --------------------------------------------------------------------------
        //BOTONES






        //-----------------------------------------------------------------------------------

        //actividades

        function modalActividad(actividad) {
            $('#modalact').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })

            document.getElementById("id_actividad").value = actividad["id_actividad"];
            document.getElementById("nombre_actividad").innerHTML = actividad["nombre_act"];
            document.getElementById("tipo_actividad").innerHTML = actividad["tipo_act"];
            document.getElementById("prestadores_asignados").innerHTML = actividad["nombre_prestador"];
            document.getElementById("prestadores_asignadosa").innerHTML = actividad["apellido_prestador"];
            document.getElementById("descripcion").innerHTML = actividad["descripcion"];
            document.getElementById("objetivo").innerHTML = actividad["objetivo"];
            document.getElementById("fecha").innerHTML = actividad["fecha"];
            document.getElementById("status").innerHTML = actividad["status"];

        }
        function modalComAct(id) {
            $('#modalcomp').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })
            //alert(id);
            document.getElementById("id_actividad2").value = id;


        }

    </script>

@endsection
