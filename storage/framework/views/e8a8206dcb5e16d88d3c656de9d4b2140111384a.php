

<?php $__env->startSection('content'); ?>

    <head>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>>
        <link rel="stylesheet" href=<?php echo e(asset('css/dobletabla.css')); ?>>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    </head>

    <div class="container">


        <h1 class="text-center"> Registro de actividad </h1>

        <form method="POST" action="<?php echo e(route('regitro_reporte_guardar')); ?>" enctype="multipart/form-data" >

            <?php echo csrf_field(); ?>

            <div class="row justify-content-center">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">

                        <h5 class="text-center">Titulo</h5>

                        <input id="nombre" type="text" class="form-control" name="nombre"  required autocomplete="nombre" autofocus>

                        <h5 class="text-center">Descripción</h5>

                        <textarea class="form-control" name="descripcion" id="descripcion" rows="5" ></textarea>

                        <h5 class="text-center">Objetivo</h5>

                        <textarea class="form-control" name="objetivo" id="objetivo" required rows="3" ></textarea>


                        <h5 class="text-center">Imagen</h5>

                        <input name="imagen" id="imagen" type='file'  accept="image/jpg, image/jpeg" />

                        <h5 class="text-center">Zip</h5>

                        <input name="zip" id="zip" type='file' accept=".zip"/>

                        <br>
                        <br>

                        <h5 class="text-center">Estimación de tiempo (HH:MM)</h5>
                        <div class="row">
                            <div class="col">
                                <input id="horas" type="number" class="form-control" name="horas"  required min="0" max="23" step="1" placeholder="Horas" autocomplete="off">
                            </div>
                            <div class="col">
                                <input id="minutos" type="number" class="form-control" name="minutos"  required min="0" max="59" step="1" placeholder="Minutos" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="asignado_a">Asignado a</label>
                            <select class="form-control" id="asignado_a" name="asignado_a" required>
                                <option value="">Selecciona un prestador</option>
                                <?php $__currentLoopData = $prestadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($prestador->id); ?>"><?php echo e($prestador->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        

                        <div class="form-group">
                            <label for="tipo_categoria">Categoría</label>
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">
                                <option value="">Selecciona una categoría</option>
                                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tipo_actividad">Tipo de actividad</label>
                            <select class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                                <option value="">Selecciona una actividad</option>
                            </select>
                        </div>

                        <br>
                        <br>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>





    </div>
<?php $__env->stopSection(); ?>

<script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>></script>

<script>
    function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var categoriaId = categoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividades.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        actividadSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '<?php echo e(route('obtenerActividades')); ?>?categoriaId=' + categoriaId);

        xhr.send();
    }
</script>

<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionSSCFE\resources\views//registroReporte.blade.php ENDPATH**/ ?>