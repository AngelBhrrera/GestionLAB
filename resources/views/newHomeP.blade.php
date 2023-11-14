@extends('layouts/main-layout')
@section('head')
    <title>Gestión Lab</title>
@endsection

@section('content')

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
                                        <a href="{{'/'}}" class="side-menu">
                                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                            <div class="side-menu__title">Inicio</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                            <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                            <div class="side-menu__title">  Registro de horas </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                            <div class="side-menu__icon"> <i data-lucide="crown"></i> </div>
                                            <div class="side-menu__title">Insignias obtenidas</div>
                                        </a>
                                    </li>
                                    
                                
                                </ul>
                            </li>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                    HORARIO
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Horario prestador</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">  Asistencias</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Faltas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i> <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="lucide lucide-vote"><path d="m9 12 2 2 4-4"/><path d="M5 7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v12H5V7Z"/><path d="M22 19H2"/></svg></i> </div>
                                        <div class="side-menu__title">Solicitar permiso</div>
                                    </a>
                                </li>
                            </ul>
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
                                        <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
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
                                    <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">  Mostrar impresiones </div>
                                    </a>
                                </li>
                            </ul>
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
                                    <img alt="Usr" class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" src="build/assets/images/barrera.jpg">
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
                                        <a href="{{ route('logout') }}" class="dropdown-item"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar sesión </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Termina menu cuenta -->
                    </div>

                    <!-- BEGIN: Reporte Horas Generales -->

                    <div class="col-span-12 mt-6 grid gap-36">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5 text-align center">Seguimiento de horas</h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                                <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                            </div>
                        </div>
                        <div class="intro-y report-box mt-12 sm:mt-4">
                            <div class="box py-0 xl:py-5 grid grid-cols-12 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">
                                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-primary bg-primary/20 border border-success/20 border-primary/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="pie-chart"></i>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="report-box__item__indicator text-primary tooltip cursor-pointer" title="5.2% Higher than last month">
                                                    100% 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">480</div>
                                        <div class="text-slate-500 mt-1">NUMERO TOTAL DE HORAS</div>
                                    </div>
                                </div>
                                <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-success bg-success/20 border flex items-center justify-center rounded-full">                                           
                                                <i data-lucide="pie-chart"></i>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="report-box__item__indicator text-success tooltip cursor-pointer" title="2% Lower than last month">
                                                    31.25% <i data-lucide="arrow-up" class="w-4 h-4 ml-0.5"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">150</div>
                                        <div class="text-slate-500 mt-1">NUMERO DE HORAS AUTORIZADAS</div>
                                    </div>
                                </div>
                                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                                <i data-lucide="pie-chart"></i>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="report-box__item__indicator text-warning tooltip cursor-pointer" title="4.1% Higher than last month">
                                                    -10.4% 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">50</div>
                                        <div class="text-slate-500 mt-1">NUMERO DE HORAS PENDIENTES</div>
                                    </div>
                                </div>
                                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="report-box__content">
                                        <div class="flex">
                                            <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full"> 
                                                <i data-lucide="pie-chart"></i>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="report-box__item__indicator text-danger tooltip cursor-pointer" title="1% Lower than last month">
                                                    58.3% <i data-lucide="arrow-down" class="w-4 h-4 ml-0.5"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-2xl font-medium leading-7 mt-6">280</div>
                                        <div class="text-slate-500 mt-1 text-align center">NUMERO DE HORAS FALTANTES</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Reporte 1 -->

                    <!-- BEGIN: Leaderboard -->
                    <div class="xl:px-6 mt-2.5">
                        <div class="intro-y flex items-center mt-8">
                            <h2 class="text-lg font-medium mr-auto">
                                LEADERBOARD
                            </h2>
                        </div>
                    </div>

                    <div class="p-5" id="basic-table">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">#</th>
                                        <th class="whitespace-nowrap">Prestador</th>
                                        <th class="whitespace-nowrap">Experiencia</th>
                                        <th class="whitespace-nowrap">Actividades completadas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Angelina Jolie</td>
                                        <td>5518</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Brad Pitt</td>
                                        <td>250</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Luis Roberto</td>
                                        <td>100</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>77</td>
                                        <td>Tu nombre y apellido</td>
                                        <td>Tu experiencia</td>
                                        <td>Tus actividades completadas</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END: Leaderboard-->


        <!--  <div class="overflow-x-auto scrollbar-hidden">
                              <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div>
                            </div>
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

                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="SS" class="tooltip rounded-full" src="{{ asset('build/assets/images/image-6') }}" title="Uploaded at 2023">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">products : name</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">products : category</div>
                            </td>
                            <td class="text-center">STOCKS</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center 'text-success' ">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active
                                </div>
                            </td>
                            <td class="w-40">
                                <div class="flex items-center justify-center 'text-danger' ">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Inactive
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
  
                </tbody>
            </table>
        </div>
        END: Data List
        BEGIN: Pagination
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
        END: Pagination
    </div>-->
        
        <!-- BEGIN: JS Assets
        <script src="p/dist/js/app.js"></script>
        END: JS Assets-->
    </body>
</html>

@endsection