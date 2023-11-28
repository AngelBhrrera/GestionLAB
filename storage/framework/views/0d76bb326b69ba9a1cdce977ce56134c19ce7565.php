<?php $__env->startSection('head'); ?>
    <title>Gestión Lab</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rocketman admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rocketman Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>GESTION LAB INVENTORES</title>

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="public/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        <div class="xl:pl-5 xl:py-5 flex h-screen">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <div class="pt-4 mb-4">
                    <div class="side-nav__header flex items-center">
                        <a href="" class="intro-x flex items-center">
                            <img alt="logo" class="side-nav__header__logo" src="build/assets/images/Inventores.png">
                            <span class="side-nav__header__text pt-0.5 text-lg ml-2.5"> Menú </span> 
                        </a>
                        <a href="javascript:;" class="side-nav__header__toggler hidden xl:block ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="arrow-left-circle" class="w-5 h-5"></i> </a>
                        <a href="javascript:;" class="mobile-menu-toggler xl:hidden ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="x-circle" class="w-5 h-5"></i> </a>
                    </div>
                </div>
                <div class="scrollable">
                    <ul class="scrollable__content">
                        <li class="side-nav__devider mb-4">MENU</li>

                        <li>
                            <a href="side-menu-light-calendar.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title"> HORARIO </div>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:;" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                                <div class="side-menu__title">
                                    ACTIVIDADES
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Crear nueva actividad </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title">  Mostrar todas las actividades </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Mostrar actividades creadas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title">Mostrar actividades en proceso </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Mostrar actividades terminadas en revisión </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Mostrar actividades revisadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-form.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Mostrar actividades con error </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="main-light-error-page.html" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                                <div class="side-menu__title"> IMPRESIONES </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="wrapper">
                <div class="content">
                    <!-- BEGIN: Top Bar -->
                    <div class="top-bar">
                        <!-- BEGIN: Breadcrumb -->
                        <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Prestador</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                        <!-- END: Breadcrumb -->
                        <!-- BEGIN: Mobile Menu -->
                        <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                            <div class="mobile-menu-toggler cursor-pointer"> <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i> </div>
                        </div>
                        <!-- END: Mobile Menu -->
                        <!-- BEGIN: Search -->
                        <div class="intro-x relative ml-auto sm:mx-auto">
                            <div class="search hidden sm:block">
                                <input type="text" class="search__input form-control" placeholder="Quick Search... (Ctrl+k)">
                                <i data-lucide="search" class="search__icon"></i> 
                            </div>
                            <a class="notification sm:hidden" href=""> <i data-lucide="search" class="notification__icon dark:text-slate-500 mr-5"></i> </a>
                        </div>
                        <!-- END: Search -->
                        <!-- BEGIN: Search Result -->
                        <div id="search-result-modal" class="modal flex items-center justify-center" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="relative border-b border-slate-200/60">
                                            <i data-lucide="search" class="w-5 h-5 absolute inset-y-0 my-auto ml-4 text-slate-500"></i> 
                                            <input type="text" class="form-control border-0 shadow-none focus:ring-0 py-5 px-12" placeholder="Quick Search...">
                                            <div class="h-6 text-xs bg-slate-200 text-slate-500 px-2 flex items-center rounded-md absolute inset-y-0 right-0 my-auto mr-4">ESC</div>
                                        </div>
                                        <div class="p-5">
                                            <div class="font-medium mb-3">Applications</div>
                                            <div class="mb-5">
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"> <i class="w-3.5 h-3.5" data-lucide="inbox"></i> </div>
                                                    <div class="ml-3 truncate">Compose New Mail</div>
                                                    <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center"> <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access </div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 bg-pending/10 text-pending flex items-center justify-center rounded-full"> <i class="w-3.5 h-3.5" data-lucide="users"></i> </div>
                                                    <div class="ml-3 truncate">Contacts</div>
                                                    <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center"> <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access </div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"> <i class="w-3.5 h-3.5" data-lucide="credit-card"></i> </div>
                                                    <div class="ml-3 truncate">Product Reports</div>
                                                    <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center"> <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access </div>
                                                </a>
                                            </div>
                                            <div class="font-medium mb-3">Contacts</div>
                                            <div class="mb-5">
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile" class="rounded-full" src="dist/images/profile-2.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Al Pacino</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">alpacino@left4code.com</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile2" class="rounded-full" src="dist/images/profile-9.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Johnny Depp</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile3" class="rounded-full" src="dist/images/profile-12.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Arnold Schwarzenegger</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">arnoldschwarzenegger@left4code.com</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile4" class="rounded-full" src="dist/images/profile-5.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">John Travolta</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">johntravolta@left4code.com</div>
                                                </a>
                                            </div>
                                            <div class="font-medium mb-3">Products</div>
                                            <div>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile5" class="rounded-full" src="dist/images/preview-12.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Sony Master Series A9G</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">Electronic</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile6" class="rounded-full" src="dist/images/preview-15.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Sony A7 III</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">Photography</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile7" class="rounded-full" src="dist/images/preview-3.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Nike Air Max 270</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">Sport &amp; Outdoor</div>
                                                </a>
                                                <a href="" class="flex items-center mt-3 first:mt-0">
                                                    <div class="w-7 h-7 image-fit">
                                                        <img alt="profile8" class="rounded-full" src="dist/images/preview-2.jpg">
                                                    </div>
                                                    <div class="w-36 truncate ml-3">Samsung Galaxy S20 Ultra</div>
                                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">Smartphone &amp; Tablet</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Termina buscador -->
                        <!-- Comienza menu cuenta-->
                        <div class="intro-x dropdown h-10">
                            <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                                <div class="w-10 h-10 image-fit">
                                    <img alt="UserProfile" class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" src="build/assets/images/Barrera.jpg">
                                </div>
                                <div class="hidden md:block ml-3">
                                    <div class="max-w-[7rem] truncate font-medium">Usuario</div>
                                    <div class="text-xs text-slate-400">Rol</div>
                                </div>
                            </div>
                            <div class="dropdown-menu w-56">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil </a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Editar perfil </a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Cambiar contraseña </a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Ayuda </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar sesión </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Termina menu cuenta -->
                    </div>
                    <!-- Comienza barra superior -->
                    <div class="xl:px-6 mt-2.5">
                        <div class="intro-y flex items-center mt-8">
                            <h2 class="text-lg font-medium mr-auto">
                                Registro de Horas
                            </h2>
                        </div>
                              <!-- Comienza tabla de datos-->
                        <div class="intro-y box p-5 mt-5">
                            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                                <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                                    <div class="sm:flex items-center sm:mr-4">
                                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Campo</label>
                                        <select id="tabulator-html-filter-field" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                                            <option value="date">Fecha</option>
                                            <option value="time">Tiempo</option>
                                            <option value="hour">Horas</option>
                                            <option value="status">Estado</option>
                                        </select>
                                    </div>
                                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Es</label>
                                        <select id="tabulator-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto" >
                                            <option value="like" selected>Operador</option>
                                            <option value="=">=</option>
                                            <option value="<">&lt;</option>
                                            <option value="<=">&lt;=</option>
                                            <option value=">">></option>
                                            <option value=">=">>=</option>
                                            <option value="!=">!=</option>
                                        </select>
                                    </div>
                                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Valor</label>
                                        <input id="tabulator-html-filter-value" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Filtrar">
                                    </div>
                                    <div class="mt-2 xl:mt-0">
                                        <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Ir</button>
                                        <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reiniciar</button>
                                    </div>
                                </form>
                                <div class="flex mt-5 sm:mt-0">
                                    <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Imprimir </button>
                                    <div class="dropdown w-1/2 sm:w-auto">
                                        <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar a CSV </a>
                                                </li>
                                                <li>
                                                    <a id="tabulator-export-json" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar a JSON </a>
                                                </li>
                                                <li>
                                                    <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar a XLSX </a>
                                                </li>
                                                <li>
                                                    <a id="tabulator-export-html" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar a HTML </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">IMAGES</th>
                        <th class="whitespace-nowrap">PRODUCT NAME</th>
                        <th class="text-center whitespace-nowrap">STOCK</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = array_slice($fakers, 0, 9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rocketman - HTML Admin Template" class="tooltip rounded-full" src="<?php echo e(asset('build/assets/images/' . $faker['images'][0])); ?>" title="Uploaded at <?php echo e($faker['dates'][0]); ?>">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rocketman - HTML Admin Template" class="tooltip rounded-full" src="<?php echo e(asset('build/assets/images/' . $faker['images'][1])); ?>" title="Uploaded at <?php echo e($faker['dates'][0]); ?>">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rocketman - HTML Admin Template" class="tooltip rounded-full" src="<?php echo e(asset('build/assets/images/' . $faker['images'][2])); ?>" title="Uploaded at <?php echo e($faker['dates'][0]); ?>">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap"><?php echo e($faker['products'][0]['name']); ?></a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?php echo e($faker['products'][0]['category']); ?></div>
                            </td>
                            <td class="text-center"><?php echo e($faker['stocks'][0]); ?></td>
                            <td class="w-40">
                                <div class="flex items-center justify-center <?php echo e($faker['true_false'][0] ? 'text-success' : 'text-danger'); ?>">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> <?php echo e($faker['true_false'][0] ? 'Active' : 'Inactive'); ?>

                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
                       <!--  <div class="overflow-x-auto scrollbar-hidden">
                              <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- BEGIN: JS Assets
        <script src="p/dist/js/app.js"></script>
        END: JS Assets-->
    </body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionSSCFE\resources\views//newUI/newHomeP.blade.php ENDPATH**/ ?>