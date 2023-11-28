<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de acceso</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" type="button" href="<?php echo e(route('admin.home')); ?>">Inicio</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Registros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" type="button" href="<?php echo e(route('admin.registro')); ?>">Registrar Usuario</a>
          
          
          <a class="dropdown-item" type="button" href="<?php echo e(route('admin.C_Actividades')); ?>"> Registrar Actividades a prestadores</a>
          <a class="dropdown-item" type="button" href="<?php echo e(route('admin.newCategoriaYActividad')); ?>"> Registrar Nueva categoria y actividad</a>
        </div>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" type="button" href="<?php echo e(route('admin.checkin')); ?>">Check-In</a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catalogos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" type="button" href="<?php echo e(route('admin.horarios')); ?>">Horarios prestadores</a>
          
          <a class="dropdown-item" type="button" href="<?php echo e(route('admin.diasfestivos')); ?>">Dias no laborales</a>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->



    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin.home')); ?>" class="brand-link">
      <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <span class="brand-text font-weight-light">Control de acceso</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href=<?php echo e(route('modificaradmin')); ?> class="d-block"><?php echo e(Auth::user()->name); ?> <?php echo e(Auth::user()->apellido); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php if(Auth::user()->can_admin == 1): ?>
               <li class="nav-item">
                   <a class="nav-link" href="<?php echo e(route('admin.cambiorol')); ?>">
                     <i class="nav-icon fas fa-sync-alt"></i>
                     <p>
                       <?php echo e(__('Cambiar a prestador')); ?>

                     </p>
                   </a>
                 </li>
               <?php endif; ?>
              <li class="nav-item">
                 <a href="#" class="nav-link">
                   <i class="nav-icon fas fa-check-square"></i>
                     <p>
                       Asistencias
                       <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview" style="display: none">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.firmas')); ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            <?php echo e(__(' Registro de Asistencia')); ?>

                        </p>

                    </a>

                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.firmasPendientes')); ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            <?php echo e(__(' Registro de Asistencia Pendientes')); ?>

                        </p>
                    </a>

                  </li>

                </ul>

              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.faltas')); ?>">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    <?php echo e(__('Faltas')); ?>

                  </p>
                </a>
              </li>

              <li class="nav-item">

                <a href="#" class="nav-link">

                  <i class="nav-icon fas fa-users"></i>

                  <p>
                    Prestadores

                    <i class="fas fa-angle-left right"></i>

                  </p>

                </a>

                <ul class="nav nav-treeview" style="display: none">

                  <li class="nav-item">

                    <a class="nav-link" href="<?php echo e(route('admin.prestadores')); ?>">

                      <i class="nav-icon fas fa-database"></i>

                      <p>
                        <?php echo e(__(' Prestadores Activos')); ?>

                      </p>

                    </a>

                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.prestadoresPendientes')); ?>">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                        <?php echo e(__(' Prestadores Pendientes ')); ?>

                      </p>

                    </a>

                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.prestadores_inactivos')); ?>">
                      <i class="nav-icon fas fa-user-slash"></i>
                      <p>
                        <?php echo e(__(' Prestadores Inactivos ')); ?>

                      </p>

                    </a>

                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.prestadores_terminados')); ?>">
                      <i class="nav-icon fas fa-user-slash"></i>
                      <p>
                        <?php echo e(__(' Prestadores Terminados ')); ?>

                      </p>

                    </a>

                  </li>
                </ul>
              </li>

              <li class="nav-item">

                <a href="#" class="nav-link">

                  <i class="nav-icon fas fa-user"></i>

                  <p>
                    Usuarios

                    <i class="fas fa-angle-left right"></i>

                  </p>

                </a>
                <ul class="nav nav-treeview" style="display: none">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.general')); ?>">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>
                              <?php echo e(__(' General')); ?>

                            </p>

                        </a>

                      </li>
                  
                  <?php if(Auth::user()->tipo == "Superadmin"): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.administradores')); ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            <?php echo e(__(' Administradores')); ?>

                        </p>

                    </a>

                  </li>
                  <?php endif; ?>
                </ul>
              </li>

            

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
            <p>
              Actividades
              <i class="fas fa-angle-left right"></i>

            </p>
            </a> 

            <ul class="nav nav-treeview" style="display: none">
              
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.actividades')); ?>">
                  <i class="nav-icon fas fa-thumbtack"></i>
                  <p>
                    <?php echo e(__(' Act. creadas')); ?> (<?php echo e(app('App\Http\Controllers\AdminController')->obtenerCantidadActividadesCreadas()); ?>)
                  </p>
                </a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.actividades_en_progreso')); ?>">
                  <i class="nav-icon fas fa-thumbtack"></i>
                  <p>
                    <?php echo e(__(' Act. proceso')); ?> (<?php echo e(app('App\Http\Controllers\AdminController')->obtenerCantidadActividadesEnProceso()); ?>)
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.actividades_revision')); ?>">
                  <i class="nav-icon fas fa-thumbtack"></i>
                  <p>
                    <?php echo e(__(' Act. revisión')); ?> (<?php echo e(app('App\Http\Controllers\AdminController')->obtenerCantidadActividadesEnRevision()); ?>)
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.tabla_terminados')); ?>">
                  <i class="nav-icon fas fa-thumbtack"></i>
                  <p>
                    <?php echo e(__(' Act. revisadas')); ?> (<?php echo e(app('App\Http\Controllers\AdminController')->obtenerCantidadActividadesTerminadas()); ?>)
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.tabla_actividades_canceladas')); ?>">
                  <i class="nav-icon fas fa-thumbtack"></i>
                  <p>
                    <?php echo e(__(' Act. canceladas')); ?> (<?php echo e(app('App\Http\Controllers\AdminController')->obtenerCantidadActividadesCanceladas()); ?>)
                  </p>
                </a>
              </li>
            </ul>
            </li>

            

          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                <?php echo e(__('Cerrar sesion')); ?>

              </p>
            </a>
          </li>
          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php echo $__env->make($opcion, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.1
    </div>
    <strong>Copyright &copy; 2023 <a href="https://www.cfe.mx/">CFE</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->


</body>
</html>
<?php /**PATH C:\laragon\www\GestionLAB\resources\views/home.blade.php ENDPATH**/ ?>