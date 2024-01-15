<!DOCTYPE html>

    <head>
        <?php echo $__env->yieldContent('headertype'); ?>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>GESTION LAB INVENTORES</title>
        <?php echo $__env->yieldContent('head'); ?>
        <link href="<?php echo e(asset('build/assets/images/inventores.png')); ?>" rel="shortcut icon">
        <!-- BEGIN: CSS Assets-->
        <link href="<?php echo e(asset('build/assets/app.c07cb30e.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('build/assets/app.c469cfb8.css')); ?>" rel="stylesheet">
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <?php echo $__env->yieldContent('body'); ?>

</html>
<?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/base.blade.php ENDPATH**/ ?>