

<?php $__env->startSection('body'); ?>
    <body class="login">
    <style>
        /* unvisited link */
        a:link {
        color: rgb(255,92,40);
        }
        /* visited link */
        a:visited {
        color: rgb(255,92,40);
        }
        /* mouse over link */
        a:hover {
        color: rgb(147,36,0);
        }
        /* selected link */
        a:active {
        color: blue;
        }
        .btn-primary{
        background-color:#FF3E00; 
        border-color:#FF3E00;
        }
        .btn-primary:hover{
            color: rgb(147,36,0);
        }
    </style>
    <?php echo $__env->yieldContent('content'); ?>
    <script type="module" src="<?php echo e(asset('/build/assets/js/app.6c589841.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
    </body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/login-layout.blade.php ENDPATH**/ ?>