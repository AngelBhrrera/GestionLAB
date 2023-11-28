

<form method="POST" id="formcita" action="<?php echo e(route('admin.actividad_modificar')); ?>">

    <?php echo csrf_field(); ?>

    <button type="submit" class="btn btn-info">
        Editar
    </button>
    <input id="id" name="id"  value=<?php echo e($id_actcreada); ?> type="hidden">


</form>




<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/columnTable/actividades/acciones_actividades.blade.php ENDPATH**/ ?>