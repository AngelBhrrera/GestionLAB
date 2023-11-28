

<?php $__env->startSection('subcontent'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/prestador-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views//profileTest.blade.php ENDPATH**/ ?>