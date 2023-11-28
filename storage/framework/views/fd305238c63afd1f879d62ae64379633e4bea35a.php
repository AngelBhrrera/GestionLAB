

<?php $__env->startSection('content'); ?>

    <head>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('css/dobletabla.css')); ?>>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    </head>

    <div class="container">

        <?php if(Auth::user()->horario): ?>
            <h1 class="text-center">Horario: <?php echo e(Auth::user()->horario); ?></h1>


        <?php else: ?>
            <h1 class="text-center">No tienes horario</h1>
        <?php endif; ?>



        

    </div>





    </div>
<?php $__env->stopSection(); ?>

<script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>></script>

<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionSSCFE\resources\views//horario.blade.php ENDPATH**/ ?>