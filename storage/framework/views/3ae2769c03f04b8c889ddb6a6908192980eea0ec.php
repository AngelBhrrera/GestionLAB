

<?php if($fecha == ""): ?>
   sin actividad
<?php else: ?>

    <form  method="POST" id="formeliminar" action="<?php echo e(route('api.proyectos_prestador_terminados')); ?>">

        <?php echo csrf_field(); ?>

        <input  name="fecha"  type='hidden' value=<?php echo e($fecha); ?>>
        <input  name="id_usuario"  type='hidden' value=<?php echo e($id); ?>>

        <button type="submit" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" >Ver</button>
    </form>

<?php endif; ?>

<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/columnTable/asistencia/btnver.blade.php ENDPATH**/ ?>