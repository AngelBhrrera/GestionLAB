<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" >
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="<?php echo e(asset('build/assets/images/Cico.svg')); ?>" rel="shortcut icon">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php echo $__env->yieldContent('head'); ?>

    <!-- BEGIN: CSS Assets-->
    <link rel="preload" as="style" href="<?php echo e(asset('/build/assets/app.c07cb30e.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('/build/assets/app.c07cb30e.css')); ?>" />    
    <!-- END: CSS Assets-->

</head>
<!-- END: Head -->

<?php echo $__env->yieldContent('body'); ?>

</html>
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views////layouts/base.blade.php ENDPATH**/ ?>