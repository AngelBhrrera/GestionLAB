<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Horas Prestador')); ?></title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('build/assets/images/Cico.svg')); ?>" rel="shortcut icon">

</head>
<body>
    <link href="<?php echo e(asset('build/assets/images/Cico.svg')); ?>" rel="shortcut icon">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="<?php echo e(asset('build\assets\images\Logo-CFE.webp')); ?>" alt="Logo" class="mx-auto d-block" style="max-width: 120px;">
                <div style="margin-left:100px">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        Inicio
                    </a>
                </div>
                 <a class="nav-link" href="<?php echo e(route('registroImpresion')); ?>">
                    Impresión
                </a> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(isset(Auth::user()->tipo)): ?>
                            <?php if(Auth::user()->tipo=='clientes'): ?>
                                <li><a class="nav-link" href="<?php echo e(route('cliente.home')); ?>">Inicio</a></li>
                                <li><a class="nav-link" href="<?php echo e(route('cliente.registro')); ?>">Impresión</a></li>
                                <!--<li><a class="nav-link" href="<?php echo e(route('email.impresion')); ?>">enviar correo</a></li>-->
                                <!--<li><a class="nav-link" href="<?php echo e(route('cliente.visitas')); ?>">Visitas</a></li>-->

                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(isset(Auth::user()->tipo)): ?>
                            <?php if(Auth::user()->tipo=='prestador'): ?>
                                


                                
                                
                                
                                
                                <li><a class="nav-link" href="<?php echo e(route('horario')); ?>">Horario</a></li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Actividades
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?php echo e(route('regitro_reporte')); ?>">
                                            <?php echo e(__('Crear actividad')); ?>

                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividades_prestadores')); ?>">
                                            <?php echo e(__(' Todas mis actividades')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerTodasActividades()); ?>)
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividades_creadas')); ?>">
                                            <?php echo e(__(' Act. creadas')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesCreadas()); ?>)
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividades_en_proceso')); ?>">
                                            <?php echo e(__(' Act. en proceso')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesEnProceso()); ?>)
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividadesTerminadas')); ?>">
                                            <?php echo e(__(' Act. terminadas en revisión')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesEnRevision()); ?>)
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividades_canceladas')); ?>">
                                            <?php echo e(__(' Act. con error')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesConError()); ?>)
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('actividades_prestadores_revisadas')); ?>">
                                            <?php echo e(__(' Act. revisadas')); ?> (<?php echo e(app('App\Http\Controllers\PrestadorController')->obtenerCantidadActividadesTerminadas()); ?>)
                                        </a>

                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(auth()->guard()->guest()): ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <?php if(Auth::user()->can_admin == 1): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.cambiorol')); ?>">
                                        <?php echo e(__('Cambiar a admin')); ?>

                                    </a>
                                    <?php endif; ?>

                                    
                                        <a class="dropdown-item" href="<?php echo e(route('perfil')); ?>"><?php echo e(__('Mi perfil')); ?></a>
                                    

                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Cerrar Sesion')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/layouts/app.blade.php ENDPATH**/ ?>