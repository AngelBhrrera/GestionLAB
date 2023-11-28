<!DOCTYPE html>
<!--<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class = '.dark'>
 BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="<?php echo e(asset('build/assets/images/inventores.png')); ?>" rel="shortcut icon">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rocketman admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rocketman Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>GESTION LAB INVENTORES</title>

    
    <?php echo $__env->yieldContent('head'); ?>

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="public/css/app.css" />
    <link href="<?php echo e(asset('build/assets/app.c07cb30e.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('build/assets/app.c469cfb8.css')); ?>" rel="stylesheet">
    <!-- END: CSS Assets-->

</head>
<!-- END: Head -->

<?php echo $__env->yieldContent('body'); ?>

</html>
<?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/base.blade.php ENDPATH**/ ?>