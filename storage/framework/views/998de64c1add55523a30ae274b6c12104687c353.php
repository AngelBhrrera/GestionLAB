

<?php $__env->startSection('head'); ?>
    <?php echo $__env->yieldContent('subhead'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex h-screen xl:pl-5 xl:py-5">
        <!-- BEGIN: Side Menu -->
        <nav class="[&>div]:opacity-0 side-nav">
            <div class="pt-4 mb-4">
                <div class="flex items-center side-nav__header">
                    <a href="" class="flex items-center intro-x">
                        <img alt="Rocketman Tailwind HTML Admin Template" class="side-nav__header__logo" src="">
                        <span class="side-nav__header__text pt-0.5 text-lg ml-2.5">
                            Lucent
                        </span>
                    </a>
                    <a href="javascript:;" class="hidden pr-5 ml-auto transition-all duration-300 ease-in-out side-nav__header__toggler xl:block text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100">
                        <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
                    </a>
                    <a href="javascript:;" class="pr-5 ml-auto transition-all duration-300 ease-in-out mobile-menu-toggler xl:hidden text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100">
                        <i data-lucide="x-circle" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
            <div class="scrollable">
                <ul class="scrollable__content">
                    
                </ul>
            </div>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="wrapper">
            <div class="[&>div]:opacity-0 content">
                <?php echo $__env->make('../layouts/components/top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="xl:px-6 mt-2.5">
                    <?php echo $__env->yieldContent('subcontent'); ?>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views/layouts/main-layout.blade.php ENDPATH**/ ?>