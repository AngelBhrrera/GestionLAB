<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class=breadcrumb>
        <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">App</a></li>
                <li class="breadcrumb-item"><a href="#">Administrator</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- END: Breadcrumb -->
    <div class="flex flex-row-reverse">    
        <div class="intro-x dropdown h-10 basis-1/2">
                <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                    <div class="hidden md:block ml-3">
                        <div class="max-w-[7rem] truncate font-medium">Actividades</div>
                        <div class="text-xs text-slate-400"></div>
                    </div>
                </div>
                <div class="dropdown-menu w-56">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                Actividades Completadas (0)
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Actividades
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help
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
        </div>
    
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown text-slate-200 h-10 ">
            <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <div class="w-10 h-10 image-fit">
                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" src="">
                </div>
                <div class="hidden md:block ml-3">
                    <div class="max-w-[7rem] truncate font-medium">Prueba</div>
                    <div class="text-xs text-slate-400"></div>
                </div>
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content">
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help
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
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
<?php /**PATH C:\laragon\www\GestionLAB\resources\views////layouts/components/top-bar.blade.php ENDPATH**/ ?>