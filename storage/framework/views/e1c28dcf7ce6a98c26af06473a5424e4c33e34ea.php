<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Account Menu -->

        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <div class="w-10 h-10"></div>
        </div>

        <div class="dropdown-menu w-56">
            <ul class="dropdown-content">
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('perfil')); ?>">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> <?php echo e(__('Mi perfil')); ?>

                        
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item">
                        <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views////layouts/components/top-bar.blade.php ENDPATH**/ ?>