

<?php $__env->startSection('head'); ?>
    <?php echo $__env->yieldContent('subhead'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href= '/cliente/home' >Visitante</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<body class="main">
    <div class="xl:pl-5 xl:py-5 flex h-screen">
        <nav class="side-nav">
            <!-- BEGIN: Side Menu -->
            <div class="pt-4 mb-4">
                <div class="side-nav__header flex items-center">
                    <a href="" class="intro-x flex items-center">
                        <img alt="logo" class="side-nav__header__logo" src="<?php echo e(asset('build/assets/images/Inventores.png')); ?>">
                        <span class="side-nav__header__text pt-0.5 text-lg ml-2.5"> Menu </span> 
                    </a>
                    <a href="javascript:;" class="side-nav__header__toggler hidden xl:block ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="arrow-left-circle" class="w-5 h-5"></i> </a>
                    <a href="javascript:;" class="mobile-menu-toggler xl:hidden ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="x-circle" class="w-5 h-5"></i> </a>
                </div>
            </div>
            <div class="scrollable">
                <ul class="scrollable__content">
                    <li class="side-nav__devider mb-4">MENU</li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" 
                                    stroke-linecap="round" stroke-linejoin="round" 
                                    class="lucide lucide-warehouse">
                                    <path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/>
                                    <rect width="12" height="12" x="6" y="10"/></svg></i></div>
                                    <div class="side-menu__title">
                                        HOME
                                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="<?php echo e('/'); ?>" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                        <div class="side-menu__title">Inicio</div>
                                    </a>
                                </li>                           
                            </ul>
                        </li>
                    </li>

                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                            <div class="side-menu__title">
                                IMPRESIONES
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                    <div class="side-menu__title"> Crear impresión </div>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('prestadoresProyectosCompletados')); ?>" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                    <div class="side-menu__title">  Mostrar impresiones </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        <!-- END: Side Menu -->
        </nav>

        <div class="wrapper">
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
                        <ol class="breadcrumb">
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ol>
                    </nav>
                    <!-- END: Breadcrumb -->

                    <!-- BEGIN: Intermede -->
                        <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                            <div class="mobile-menu-toggler cursor-pointer"> <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i> </div>
                        </div>
                        <div class="intro-x relative ml-auto sm:mx-auto"> </div>
                    <!-- END: Intermede -->
                       
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                            <?php if(isset(Auth::user()->image)): ?>
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="<?php echo e(Auth::user()->name.' '.Auth::user()->apellido); ?>" src="<?php echo e(asset('build/assets/images/placeholders/avatar5.png')); ?>">
                            <?php else: ?>
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="<?php echo e(Auth::user()->name.' '.Auth::user()->apellido); ?>" src="<?php echo e(asset('build/assets/images/placeholders/'.Auth::user()->imagen_perfil)); ?>">
                            <?php endif; ?>
                            </div>
                            <div class="hidden md:block ml-3">
                                <div class="max-w-[7rem] truncate font-medium"><?php echo e($username=Auth::user()->name); ?></div>
                                <div class="text-xs text-slate-400"><?php echo e($userRol=ucfirst(Auth::user()->tipo)); ?></div>
                            </div>
                        </div>

                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="<?php echo e(route('perfil')); ?>" class="dropdown-item"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('password.request')); ?>" class="dropdown-item"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Cambiar contraseña </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Ayuda </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar sesión </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div  class="container" style="padding: 20px 15px 0px 15px">
                <?php echo $__env->yieldContent('subcontent'); ?>
            </div>

            </div>
        </div>  
    </div>      
</body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('../layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views/layouts/visitante-layout.blade.php ENDPATH**/ ?>