

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('homeP')); ?>">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <?php echo $__env->make($opcion, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.1
    </div>
    <strong>Copyright &copy; 2023 <a href="https://www.cfe.mx/">Laboratorio de Inventores</a>.</strong> All rights reserved.
  </footer>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views//admin/homeA.blade.php ENDPATH**/ ?>