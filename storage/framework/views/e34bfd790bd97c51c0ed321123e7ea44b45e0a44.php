

<?php $__env->startSection('subcontent'); ?>
    <div class="container" style="padding: 2em 8em">
        <?php echo $__env->make('table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-footer" style="background-color: white">
                    <h4 class=" float-left">Horas Totales: <?php echo e($horas); ?></h4>
                    <h4 class=" float-right">Horas Pendientes: <?php echo e($horasT); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/prestador-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views/homeP.blade.php ENDPATH**/ ?>