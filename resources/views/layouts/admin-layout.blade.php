@extends('../layouts/main')

@section('head')
    <html class='dark'>
    <meta charset="UTF-8">
        <title>Laravel 10 Ajax DataTables CRUD (Create Read Update and Delete) - Cairocoders</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('subhead')
@endsection


@section('content')
<body class="main">
    <div class="xl:pl-5 xl:py-5 flex h-screen">
        <nav class="side-nav">
            <!-- BEGIN: Side Menu -->
            <div class="pt-4 mb-4">
                <div class="side-nav__header flex items-center">
                    <a href="" class="intro-x flex items-center">
                        <img alt="logo" class="side-nav__header__logo" src="{{ asset('build/assets/images/Inventores.png') }}">
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
                                <div class="side-menu__icon"> <i data-lucide="clipboard-list"></i> </div>
                                <div class="side-menu__title">
                                    REGISTROS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.registro')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round">
                                <path d="M18 21a8 8 0 0 0-16 0"/>
                                <circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg></i> </div>
                                        <div class="side-menu__title">Usuarios</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check">
                                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                            <path d="m9 9.5 2 2 4-4"/></svg></i> </div>
                                        <div class="side-menu__title">Visitas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                        <div class="side-menu__title">Recompensas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.C_Actividades')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-edit">
                                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                                        <path d="M10.42 12.61a2.1 2.1 0 1 1 2.97 2.97L7.95 21 4 22l.99-3.95 5.43-5.44Z"/>
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5.5"/><path d="M4 13.5V6a2 2 0 0 1 2-2h2"/></svg></i> </div>
                                        <div class="side-menu__title">Actividades a prestadores</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.faltas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="package-plus"></i> </div>
                                        <div class="side-menu__title">Nueva categoria</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="lucide lucide-calendar-check-2"><path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8"/>
                                <line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/>
                                <line x1="3" x2="21" y1="10" y2="10"/><path d="m16 20 2 2 4-4"/></svg></i> </div>
                                <div class="side-menu__title">
                                    ASISTENCIAS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.firmas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>
                                        <path d="m9 16 2 2 4-4"/></svg></i> </div>
                                        <div class="side-menu__title">Registro de Asistencia</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check">!</i> </div>
                                        <div class="side-menu__title">Registro de Asistencia Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.faltas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Faltas</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round">
                                <path d="M18 21a6 6 0 0 0-12 0"/>
                                <circle cx="12" cy="11" r="4"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg></i> </div>
                                <div class="side-menu__title">
                                    PRESTADORES
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.prestadores')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="user-check"></i> </div>
                                        <div class="side-menu__title">Activos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadoresPendientes')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="alert-octagon"></i> </div>
                                        <div class="side-menu__title">Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_inactivos')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="user-x"></i> </div>
                                        <div class="side-menu__title">Inactivos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_terminados')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check">
                                        <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
                                        <path d="m9 12 2 2 4-4"/></svg></i> </div>
                                        <div class="side-menu__title">Servicio concluido</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_liberados')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-check">
                                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/><path d="m9 10 2 2 4-4"/></svg></i> </div>
                                        <div class="side-menu__title">Servicio liberado</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round">
                                <path d="M18 21a8 8 0 0 0-16 0"/>
                                <circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg></i> </div>
                                <div class="side-menu__title">
                                    USUARIOS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.general')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                                        <div class="side-menu__title">General</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.clientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user">
                                        <circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/>
                                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg></i> </div>
                                        <div class="side-menu__title">Clientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.administradores') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog">
                                        <circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/><path d="M10 15H6a4 4 0 0 0-4 4v2"/>
                                        <path d="m21.7 16.4-.9-.3"/><path d="m15.2 13.9-.9-.3"/><path d="m16.6 18.7.3-.9"/><path d="m19.1 12.2.3-.9"/>
                                        <path d="m19.6 18.7-.4-1"/><path d="m16.8 12.3-.4-1"/>
                                        <path d="m14.3 16.6 1-.4"/><path d="m20.7 13.8 1-.4"/></svg></i> </div>
                                        <div class="side-menu__title">Administradores</div>
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
                                    <a href="{{ route('admin.actividades') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-plus-2"></i> </div>
                                        <div class="side-menu__title"> Creadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.actividades_en_progreso') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-input"></i> </div>
                                        <div class="side-menu__title">En Proceso </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.actividades_revision') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-clock">
                                        <path d="M16 22h2c.5 0 1-.2 1.4-.6.4-.4.6-.9.6-1.4V7.5L14.5 2H6c-.5 0-1 .2-1.4.6C4.2 3 4 3.5 4 4v3"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <circle cx="8" cy="16" r="6"/><path d="M9.5 17.5 8 16.25V14"/></svg></i> </div>
                                        <div class="side-menu__title">En Revisión</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tabla_terminados') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-check-2"></i> </div>
                                        <div class="side-menu__title">Aprobadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tabla_actividades_canceladas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-x-2"></i> </div>
                                        <div class="side-menu__title">Canceladas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('actividades_prestadores_revisadas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                        <div class="side-menu__title"> Actividades revisadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('actividades_canceladas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-warning">
                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                        <path d="M12 9v4"/><path d="M12 17h.01"/></svg></i> </div>
                                        <div class="side-menu__title"> Actividades con error </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="clipboard-copy"></i> </div>
                                <div class="side-menu__title">
                                Planificación
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.horarios')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Horario Prestadores</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.diasfestivos') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-off">
                                        <path d="M4.18 4.18A2 2 0 0 0 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 1.82-1.18"/><path d="M21 15.5V6a2 2 0 0 0-2-2H9.5"/>
                                        <path d="M16 2v4"/>
                                        <path d="M3 10h7"/><path d="M21 10h-5.5"/><line x1="2" x2="22" y1="2" y2="22"/></svg></i> </div>
                                        <div class="side-menu__title">Dias no Laborales</div>
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
                                    <a href="{{ route('admin.citas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                        <div class="side-menu__title">Solicitudes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.citas_pendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="alert-circle"></i> </div>
                                        <div class="side-menu__title">Citas por confirmar </div>
                                    </a>
                                </li>
                                <li>
                                    <a hhref="{{ route('admin.ProyectosCitados') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock">
                                        <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/>
                                        <path d="M3 10h5"/><path d="M17.5 17.5 16 16.25V14"/>
                                        <path d="M22 16a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z"/></svg></i> </div>
                                        <div class="side-menu__title">Programadas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="layout-list"></i> </div>
                                        <div class="side-menu__title">Prestadores Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos2') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                        <div class="side-menu__title">Prestadores Terminadas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos3') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check-square"></i> </div>
                                        <div class="side-menu__title">Completadas</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
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
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                    <div class="intro-x relative ml-auto flex sm:mx-auto">
                            <button class="btn btn-primary ml-5"><a href="{{ route('admin.checkin')  }}">Check-In</a></button>
                            @if (Auth::user()->can_admin == 1)
                            <button class="btn btn-primary ml-5"><a href="{{ route('admin.cambiorol') }}">
                                {{ __('Cambiar a prestador') }}</a></button>
                            @endif
                    </div>
                    
                    
                    <!-- END: Breadcrumb -->

                    <!-- BEGIN: Intermede -->
                        <!-- Navbar -->
                    <!-- END: Intermede -->
                       
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                            @if(!isset(Auth::user()->imagen_perfil))
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('build/assets/images/placeholders/avatar5.png')}}">
                            @else
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('build/assets/images/placeholders/userImg/'.Auth::user()->imagen_perfil)}}">
                            @endif
                            </div>
                            <div class="hidden md:block ml-3">
                                <div class="max-w-[7rem] truncate font-medium">{{$username=Auth::user()->name}}</div>
                                <div class="text-xs text-slate-400">{{$userRol=ucfirst(Auth::user()->tipo)}}</div>
                            </div>
                        </div>

                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="{{ route('perfil') }}" class="dropdown-item"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil </a>
                                </li>
                                <li>
                                    <a href="{{route('password.request')}}" class="dropdown-item"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Cambiar contraseña </a>
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
                </div>
            <div  class="container" style="padding: 20px 15px 0px 15px">
                @yield('subcontent')

            </div>
        </div>  
    </div>    

</body>

@endsection

@section('script')
    <?php
        // <!-- JQuery -->
        // <script src={{asset('plugins/jquery/jquery.min.js')}}></script>
        // <!-- Bootstrap 4 -->
        // <script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
        // <!-- AdminLTE App -->
        // <script src={{asset('dist/js/adminlte.min.js')}}></script>
        // <!-- DataTables  & Plugins -->
        // <script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
        // <script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
        // <script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
        // <script src={{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
        // <script src={{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
        // <script src={{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
        // <script src={{asset('plugins/jszip/jszip.min.js')}}></script>
        // <script src={{asset('plugins/pdfmake/pdfmake.min.js')}}></script>
        // <script src={{asset('plugins/pdfmake/vfs_fonts.js')}}></script>
        // <script src={{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
        // <script src={{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
        // <script src={{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>
        // <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        // <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
        // <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>

        // {{-- <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
        // {{-- <script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script> --}}
        // {{-- <script src="{{asset('plugins/moment/moment.min.js')}}"></script> --}}
    ?>

    

@endsection

