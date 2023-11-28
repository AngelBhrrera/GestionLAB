






<div class="container">

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
                <form method="POST" action="<?php echo e(route('completar_actividad')); ?>">

                    <?php echo csrf_field(); ?>

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

        

        <h1 class="text-center">Actividades Terminadas</h1>

        <h2 class="text-center">ID usuario: <?php echo e($id_usuario); ?>  </h2>
        <h2 class="text-center">Fecha: <?php echo e($fecha); ?></h2>
        <div class="row justify-content-center">
            <?php $__currentLoopData = $actividades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-header text-white bg-secondary mb-3 text-center ">
                        <h4 class="card-title">Nombre: <?php echo e($actividad->nombre_act); ?></h4>
                    </div>

                    <div class="card-body">

                        <label  name="nombre">tipo de actividad:
                            <?php echo e($actividad->tipo_act); ?></label>
                        <br>
                        <label for=""  name="telefono">fecha de entrega: <?php echo e($actividad->fecha); ?></label>
                        <br>
                        <label for="" name="descripcion">Descripcion: <?php echo e($actividad->descripcion); ?></label>
                        <br>

                    </div>

                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalact"
                            onclick="modalActividad(<?php echo e(json_encode($actividad)); ?>)">
                            Mas
                        </button>
                        
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
    <script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
    <!-- AdminLTE App -->
    <script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
          <!-- AdminLTE App -->




    <script type="text/javascript">


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

<?php /**PATH C:\laragon\www\GestionLAB\resources\views/proyectostabla2.blade.php ENDPATH**/ ?>