<?php if(isset(Auth::user()->tipo)): ?>
    <?php if((Auth::user()->tipo =='Superadmin' || Auth::user()->tipo =='admin')): ?>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-danger <?php echo e($estado == "denegado" ? 'active' : ''); ?>" >
                <input
                    type="radio"
                    value="denegado"
                    name="<?php echo e($id); ?>"
                    onchange="actualizar(this,<?php echo e(Auth::user()); ?>)"
                    autocomplete="off"
                    <?php echo e($estado == "denegado" ? 'checked' : ''); ?>

                    <?php echo e((Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin')  ? 'disabled' : ''); ?>

                    >
                Denegado
            </label>
            <label class="btn btn-outline-warning <?php echo e($estado == "pendiente" ? 'active' : ''); ?>">
                <input type="radio"
                    value="pendiente"
                    name="<?php echo e($id); ?>"
                    onchange="actualizar(this,<?php echo e(Auth::user()); ?>)"
                    autocomplete="off"
                    <?php echo e($estado == "pendiente" ? 'checked' : ''); ?>

                    <?php echo e((Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''); ?>

                    >
                Pendiente
                </label>
                <label class="btn btn-outline-success <?php echo e($estado == "autorizado" ? 'active' : ''); ?>">
                <input type="radio"
                    value="autorizado"
                    name="<?php echo e($id); ?>"
                    onchange="actualizar(this,<?php echo e(Auth::user()); ?>)"
                    autocomplete="off"
                    <?php echo e($estado == "autorizado" ? 'checked' : ''); ?>

                    <?php echo e((Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''); ?>

                    >
                    Autorizado
                </label>
        </div>

        <script type="text/javascript">
            //actualizar estado

            function actualizar(src, responsable){

                var url = '<?php echo e(route('api.actualizar')); ?>';


                $.ajax({
                    type:"POST",
                    url: url,
                    data:{
                            "_token": "<?php echo e(csrf_token()); ?>",
                            "id":src.name,
                            "estado":src.value,
                            "responsable": responsable.id+" "+responsable.name+" "+responsable.apellido

                    },
                    }
                    );
            }

        </script>
    <?php endif; ?>
<?php endif; ?>

<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/columnTable/asistencia/radioButton.blade.php ENDPATH**/ ?>