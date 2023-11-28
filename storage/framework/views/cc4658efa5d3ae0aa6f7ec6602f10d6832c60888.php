<!DOCTYPE html>
<body>
<link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
<link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/toastr/toastr.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">
<main class="py-5">
<div class="container">
    <?php echo $__env->make('alerta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__($nombre)); ?></div>

                <div class="card-body">
                    <form method="POST" id="envio" action="<?php echo e(route('api.marcar')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Codigo')); ?></label>

                            <div class="col-md-6">
                                <input id="codigo" class="form-control" name="codigo">


                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Marcar')); ?>

                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</body>
<script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
<!-- Bootstrap 4 -->
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->


<script type="text/javascript">
$('#alert').fadeIn();
  setTimeout(function() {
       $("#alert").fadeOut();
  },5000);


</script>
</html>

<?php /**PATH C:\laragon\www\GestionLAB\resources\views/auth/checkin.blade.php ENDPATH**/ ?>