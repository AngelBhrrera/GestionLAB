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
        <link rel="stylesheet" href="<?php echo e(asset('build/assets/css/dual-listbox.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('build/assets/css/app.c07cb30e.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('build/assets/css/app.c469cfb8.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
        
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <?php echo $__env->yieldContent('body'); ?>

</html>
<?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/base.blade.php ENDPATH**/ ?>