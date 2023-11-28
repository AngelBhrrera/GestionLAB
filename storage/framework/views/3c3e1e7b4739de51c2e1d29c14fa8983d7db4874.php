

<?php $__env->startSection('content'); ?>
<div class="container">

  <?php if(session('success')): ?>
  <div class="alert alert-success">
    <?php echo e(session('success')); ?>

  </div>
  <script>
    setTimeout(function() {
            location.reload();
        }, 1500); // La página se recargará automáticamente después de 1.5 segundos
  </script>
  <?php endif; ?>

  <?php if($errors->has('imagen_perfil')): ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($errors->first('imagen_perfil.max')); ?></strong>
  </span>
  <?php endif; ?>

  <div class="row align-items-center justify-content-center mb-3">

    <div class="col-md-3 text-center">
      <div class="profile-image d-flex justify-content-center overflow-hidden">

        <?php if($user->imagen_perfil): ?>
        
        
        <img src="<?php echo e(asset('storage/imagen/' . $user->imagen_perfil)); ?>" alt="<?php echo e($user->imagen_perfil); ?>"
          class="profile-image">
        
        
        
        
        <?php else: ?>
        <img src="<?php echo e(asset('imagen/default-profile-image.png')); ?>" alt="<?php echo e($user->name); ?>" width="150" height="150">
        <?php endif; ?>
      </div>
      <button type="button" class="btn btn-sm btn-outline-success mt-3" data-toggle="modal"
        data-target="#imagenModal">Cambiar Imagen</button>
    </div>

    
      <div class="col-md-4">
        <h1>Mi Perfil</h1>
        <hr>
        <p><strong>Nombre:</strong> <?php echo e($user->name); ?></p>
        <p><strong>Apellido:</strong> <?php echo e($user->apellido); ?></p>
        <p><strong>Correo:</strong> <?php echo e($user->correo); ?></p>
        <p><strong>Codigo:</strong> <?php echo e($user->codigo); ?></p>
        <p><strong>Centro:</strong> <?php echo e($user->centro); ?></p>
        <p><strong>Carrera:</strong> <?php echo e($user->carrera); ?></p>
        <p><strong>Experiencia:</strong> <?php echo e($user->experiencia ?? '0'); ?></p>
        <p><strong>Nivel:</strong> <?php echo e($nivel_str); ?></p>


      </div>

      <div class="col-md-3 text-center  text-align: center; display: block;">
        <h1 class="ml-3 gradiente-texto">Insignia:</h1>
        <div class="d-flex align-items-center justify-content-center">
          <div class="profile-medal d-flex justify-content-center overflow-hidden">
            <img src="<?php echo e($medalla); ?>" alt="Medalla del usuario" class="medal-image">
          </div>
        </div>
        <h1 class="ml-3"><?php echo e($descripcion_medalla); ?></h1>
      </div>

    

  
  <h1 class="gradiente-texto text-center">Total de insignias obtenidas:</h1>
  <div class="row justify-content-center">
    <?php $__currentLoopData = $todasMedallasUsuario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medalla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3 col-sm-6 mb-4 col-12 text-center">
      <div class="card profile-medal d-flex flex-column align-items-center justify-content-center">
        <div class="medal-wrapper d-flex align-items-center justify-content-center">
          <img src="<?php echo e(asset($medalla->ruta)); ?>" alt="<?php echo e($medalla->descripcion); ?>" class="medal-image" >
          <h5 class="card-title text-center"><?php echo e($medalla->descripcion); ?></h5>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

</div>

<style>
  .profile-image {
    width: 250px;
    height: 250px;
    margin: 0 auto;
    overflow: hidden;
    /* border-radius: 50%; */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .profile-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  /* Estilos para las medallas */
  .profile-medal {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    /* margin-left: -75px; */
  }

  .medal-image {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .gradiente-texto {
    background: linear-gradient(to right, #ffd700, #ffa500, #ff8c00, #ff4500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradient 10s ease infinite;
  }

  @keyframes  gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }
</style>


<!-- Modal para cambiar la imagen -->
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagenModalLabel">Cambiar imagen de perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo e(route('cambiarImagenPerfil')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="imagen_perfil">Imagen de perfil</label>
            <input type="file" class="form-control-file" id="imagen_perfil" name="imagen_perfil">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/perfilPrestador.blade.php ENDPATH**/ ?>