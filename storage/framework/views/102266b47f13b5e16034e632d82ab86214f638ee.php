

<?php $__env->startSection('subcontent'); ?>

    <div class="container">

        

        <h1 class="text-center">Horario: Matutino</h1>

        <form method="POST" action="<?php echo e(route('horario_guardar')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row justify-content-center">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">
                        <h5 class="text-center">Selecciona tu horario</h5>
                        <select class="form-control" name="horario">
                            <option value="matutino">Matutino (8-12) </option>
                            <option value="matutino"> Mediodia (12-4) </option>
                            <option value="vespertino">Vespertino (4-8) </option>
                            <option value="sabados">Sabatino</option>
                            <option value="tiempo_completo">Tiempo Completo</option>
                        </select>

                        <br>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/prestador-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views//prestador/horario.blade.php ENDPATH**/ ?>