

<?php $__env->startSection('breadcrumb'); ?>
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('homeP')); ?>">Prestador</a></li>
            <?php if(isset($breadcrumb)): ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($breadcrumb); ?></li>
            <?php endif; ?>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>

<head>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('css/dobletabla.css')); ?>>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>

<div class="container">
    <h1 class="text-center">
        <?php if(isset($title)): ?>
            <?php echo e($title); ?>

        <?php else: ?>
            Mis Actividades
        <?php endif; ?>
    </h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Listado de Actividades</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Objetivo</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Estimación Tiempo</th>
                  
                  <?php if($actividades->where('status', 'terminado_revisado')->count() > 0): ?>
                    <th scope="col">Duración</th>
                    <th scope="col">Experiencia obtenida</th>
                  <?php elseif($actividades->where('status', 'terminado')->count() > 0): ?>
                    <th scope="col">Duración</th>
                  <?php elseif($actividades->where('status', 'cancelado')->count() > 0 || $actividades->where('status', 'cancelado_permitido')->count() > 0): ?>
                    <th scope="col">Nota de error</th>
                  <?php elseif($actividades->where('status', 'creado')->count() > 0): ?>
                    <th scope="col">Solicitar cancelación</th>
                  <?php endif; ?>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $actividades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                        <?php if($actividad->status == 'creado'): ?>
                            <td><?php echo e($actividad->nombre_act); ?></td>
                            <td><?php echo e($actividad->descripcion); ?></td>
                            <td><?php echo e($actividad->objetivo); ?></td>
                            <td><?php echo e($actividad->fecha); ?></td>
                            <td><?php echo e($actividad->status); ?></td>
                            <td><?php echo e($actividad->estimacion_tiempo); ?></td>
                            <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelacionModal<?php echo e($actividad->id_actividad); ?>">
                                        Solicitar cancelación
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelacionModal<?php echo e($actividad->id_actividad); ?>" tabindex="-1" role="dialog" aria-labelledby="cancelacionModalLabel<?php echo e($actividad->id_actividad); ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelacionModalLabel<?php echo e($actividad->id_actividad); ?>">Solicitud de cancelación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo e(route('cancelacion_prestador')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="id_actividad" value="<?php echo e($actividad->id_actividad); ?>">
                                                        <div class="form-group">
                                                            <label for="motivo_cancelacion<?php echo e($actividad->id_actividad); ?>">Motivo de cancelación</label>
                                                            <textarea class="form-control" id="motivo_cancelacion<?php echo e($actividad->id_actividad); ?>" name="motivo_cancelacion" rows="3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                            <td>
                                <?php if($actividad->status == 'creado'): ?>
                                <form action="<?php echo e(route('enProcesoActividad', $actividad->id_actividad)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="btn btn-success">Comenzar</button>
                                </form>
                                <?php endif; ?>

                            </td>
                        <?php elseif($actividad->status == 'en_proceso'): ?>
                            <td><?php echo e($actividad->nombre_act); ?></td>
                            <td><?php echo e($actividad->descripcion); ?></td>
                            <td><?php echo e($actividad->objetivo); ?></td>
                            <td><?php echo e($actividad->fecha); ?></td>
                            <td><?php echo e($actividad->status); ?></td>
                            <td><?php echo e($actividad->estimacion_tiempo); ?></td>
                            <td>
                                <?php if($actividad->status == 'en_proceso'): ?>
                                <form action="<?php echo e(route('terminarActividad', $actividad->id_actividad)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="btn btn-primary">Terminar</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        <?php elseif($actividad->status == 'terminado'): ?>
                            <td><?php echo e($actividad->nombre_act); ?></td>
                            <td><?php echo e($actividad->descripcion); ?></td>
                            <td><?php echo e($actividad->objetivo); ?></td>
                            <td><?php echo e($actividad->fecha); ?></td>
                            <td><?php echo e($actividad->status); ?></td>
                            <td><?php echo e($actividad->estimacion_tiempo); ?></td>
                            <td><?php echo e($actividad->duracion); ?></td>
                        <?php elseif($actividad->status == 'terminado_revisado'): ?>
                            <td><?php echo e($actividad->nombre_act); ?></td>
                            <td><?php echo e($actividad->descripcion); ?></td>
                            <td><?php echo e($actividad->objetivo); ?></td>
                            <td><?php echo e($actividad->fecha); ?></td>
                            <td><?php echo e($actividad->status); ?></td>
                            <td><?php echo e($actividad->estimacion_tiempo); ?></td>
                            <td><?php echo e($actividad->duracion); ?></td>
                            <td><?php echo e($actividad->experiencia_obtenida); ?></td>
                        <?php elseif($actividad->status == 'cancelado' || $actividad->status == 'cancelado_permitido'): ?>
                            <td><?php echo e($actividad->nombre_act); ?></td>
                            <td><?php echo e($actividad->descripcion); ?></td>
                            <td><?php echo e($actividad->objetivo); ?></td>
                            <td><?php echo e($actividad->fecha); ?></td>
                            <td><?php echo e($actividad->status); ?></td>
                            <td><?php echo e($actividad->estimacion_tiempo); ?></td>
                            <td><?php echo e($actividad->nota_error); ?></td>
                            <td>
                                <?php if($actividad->status == 'cancelado_permitido'): ?>
                                <form action="<?php echo e(route('retomarActividad', $actividad->id_actividad)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="btn btn-success">Retomar actividad</button>
                                </form>
                                <?php endif; ?>
                            </td>

                        <?php endif; ?>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </tbody>
            </table>

            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Volver</a>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/prestador-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views/prestador/actividades_prestadores.blade.php ENDPATH**/ ?>