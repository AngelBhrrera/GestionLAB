

<?php $__env->startSection('body'); ?>
    <body class="main">
        <?php echo $__env->yieldContent('content'); ?>

        <!-- BEGIN: JS Assets-->
        <link rel="preload" as="style" href="<?php echo e(asset('/build/assets/app.c07cb30e.css')); ?>" />
        <link rel="modulepreload" href="<?php echo e(asset('/build/assets/app.6c589841.js')); ?>" />
        <link rel="modulepreload" href="<?php echo e(asset('build/assets/_commonjsHelpers.712cc82f.js')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('/build/assets/app.c469cfb8.css')); ?>" />
        <script type="module" src="<?php echo e(asset('/build/assets/app.6c589841.js')); ?>"></script>
        <!-- END: JS Assets-->

        <?php echo $__env->yieldContent('script'); ?>
    </body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/main.blade.php ENDPATH**/ ?>