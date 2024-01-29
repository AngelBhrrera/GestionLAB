



<?php $__env->startSection('head'); ?>
    <title>LOGIN</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        
              
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">

                <a href="<?php echo e(route('landing')); ?>"><img class="mx-auto my-auto" alt="Inventores" width="200px" height="150px" src="<?php echo e(asset('build/assets//images/logosinventores/InventoresBannerHDWhiteBorder.png')); ?>"></a>
                
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <?php if(session('FAIL')): ?>
                        <div class="intro-y col-span-12 lg:col-span-6">
                            <h6 class="alert alert-danger"><?php echo e(session('FAIL')); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="container pt-3">
                    <form method="POST" id="login-form">
                        <?php echo csrf_field(); ?>
                        <input id="opc" name="opc" type="hidden" value="0">
                        <input id="correo" type="email" class="form-control py-3 px-4 block" placeholder="Correo"  name="correo" autocomplete="off">    
                        <div id="error-email" class="login__input-error text-danger mt-2"></div>                    
                        <input id="password" type="password" class="form-control py-3 px-4 block mt-4 " placeholder="Contraseña" name="password"  autocomplete="current-password">
                        <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        <div class="text-slate-500 flex text-xs sm:text-sm mt-4 ">
                            <a href="<?php echo e(route('password.request')); ?>">Recuperar contraseña</a>
                        </div>
                        <div class="mt-5 xl:mt-8 text-center xl:text-left">                        
                            <button id="btn-login" type="submit" class="btn btn-primary w-full xl:mr-3 " >Iniciar Sesion</button>
                        </div>
                    </form>
                        <div class="text-center xl:text-left">
                            <a href="<?php echo e(route('register')); ?>">
                                <button class="btn btn-outline-secondary w-full mt-3" type="submit">
                                    Registrarse
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="success-notification-content" class="toastify-content hidden flex">
        <i class="text-success" data-lucide="check-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Registration success!</div>
        </div>
    </div>

    <div id="failed-notification-content" class="toastify-content hidden flex">
        <i class="text-danger" data-lucide="x-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Registro fallido</div>
            <div class="text-slate-500 mt-1">
                Los datos ingresados son incorrectos.
            </div>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="module" src="<?php echo e(asset('/build/assets/js/app.6c589841.js')); ?>"></script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/login-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views/auth/login.blade.php ENDPATH**/ ?>