<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo e(asset('img/recursos/logo-bowser.png')); ?>">
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Registro de categoría y actividad (<?php echo e($tipo); ?>)
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('api.agregarCategoriaActividad')); ?>">
                            <?php if(isset($tipo)): ?>
                            <input id="tipo" name="tipo" value="<?php echo e($tipo); ?>" type="hidden">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>

                            <!-- Input para el nombre de la categoría -->
                            <div class="form-group row">
                                <label for="nombre_categoria" class="col-md-4 col-form-label text-md-right">Nombre de la
                                    categoría</label>
                                <div class="col-md-6">
                                    <input id="nombre_categoria" name="nombre_categoria" type="text"
                                        class="form-control" required>
                                </div>
                            </div>

                            <!-- Contenedor de actividades -->
                            <div id="actividades-container">
                                <!-- Primer campo de actividad -->
                                <div class="actividad">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Nombre actividad</label>
                                        <div class="col-md-6">
                                            <input name="nombre_actividad[]" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Estimación de tiempo
                                            (HH:MM)</label>
                                        <div class="row">
                                            <div class="col">
                                                <input name="horas_actividad[]" type="number" class="form-control"
                                                    required min="0" max="10" placeholder="Horas">
                                            </div>
                                            <div class="col">
                                                <input name="minutos_actividad[]" type="number" class="form-control"
                                                    required min="0" max="59" placeholder="Minutos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón para agregar más actividades -->
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" id="agregar-actividad" class="btn btn-success">+
                                        Actividad</button>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button style="" type="submit" id="enviar"
                                    class="btn btn-primary from-prevent-multiple-submits">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {
        // Agregar el evento de clic al botón de eliminación
        $('#actividades-container').on('click', '.btn-eliminar-actividad', function () {
            $(this).closest('.actividad').remove();
        });

        // Manejar el evento click del botón "Agregar actividad"
        $('#agregar-actividad').click(function () {
            var actividadHTML = `
                <div class="actividad">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Nombre actividad</label>
                        <div class="col-md-6">
                            <input name="nombre_actividad[]" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Estimación de tiempo (HH:MM)</label>
                        <div class="row">
                            <div class="col">
                                <input name="horas_actividad[]" type="number" class="form-control" required min="0" max="10" placeholder="Horas">
                            </div>
                            <div class="col">
                                <input name="minutos_actividad[]" type="number" class="form-control" required min="0" max="59" placeholder="Minutos">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-eliminar-actividad">Eliminar</button>
                        </div>
                    </div>
                </div>
            `;
            $('#actividades-container').append(actividadHTML);
        });
    });

    </script>
</body>

</html><?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/newCategoriaYActividad.blade.php ENDPATH**/ ?>