<?php if(Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <i class="fa fa-check" style="margin-right: 10px"></i>
        <strong><?php echo e(session('success')); ?></strong>
    </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <i class="fa fa-exclamation-triangle" style="margin-right: 10px"></i>
        <strong><?php echo e(session('error')); ?></strong>
    </div>
<?php endif; ?>



<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/alerta.blade.php ENDPATH**/ ?>