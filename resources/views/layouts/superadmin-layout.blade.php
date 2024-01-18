@extends('../layouts/main')

@section('head')
    @section('headertype')
        <html class='dark'>
    @endsection
    <style>
        container {
            height: 100%;
            display: flex;
        }

        footer {
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 1rem 4%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            background-color: #BDC9EB; 
            z-index: 1000; 
        }
    </style>
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
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round">
                                                <path d="M18 21a8 8 0 0 0-16 0" />
                                                <circle cx="10" cy="8" r="5" />
                                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                            </svg></i> </div>
                                    <div class="side-menu__title">Usuarios</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                    <div class="side-menu__title">Recompensas</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check-2">
                                        <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                        <path d="m16 20 2 2 4-4" />
                                    </svg></i> </div>
                            <div class="side-menu__title">
                                ASISTENCIAS
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{route('admin.firmas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check">
                                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                                <line x1="16" x2="16" y1="2" y2="6" />
                                                <line x1="8" x2="8" y1="2" y2="6" />
                                                <line x1="3" x2="21" y1="10" y2="10" />
                                                <path d="m9 16 2 2 4-4" />
                                            </svg></i> </div>
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
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round">
                                        <path d="M18 21a6 6 0 0 0-12 0" />
                                        <circle cx="12" cy="11" r="4" />
                                        <rect width="18" height="18" x="3" y="3" rx="2" />
                                    </svg></i> </div>
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
                                <a href="{{ route('admin.administradores') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog">
                                                <circle cx="18" cy="15" r="3" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M10 15H6a4 4 0 0 0-4 4v2" />
                                                <path d="m21.7 16.4-.9-.3" />
                                                <path d="m15.2 13.9-.9-.3" />
                                                <path d="m16.6 18.7.3-.9" />
                                                <path d="m19.1 12.2.3-.9" />
                                                <path d="m19.6 18.7-.4-1" />
                                                <path d="m16.8 12.3-.4-1" />
                                                <path d="m14.3 16.6 1-.4" />
                                                <path d="m20.7 13.8 1-.4" />
                                            </svg></i> </div>
                                    <div class="side-menu__title">Administradores</div>
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
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check">
                                                <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg></i> </div>
                                    <div class="side-menu__title">Servicio concluido / liberado</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.administradores') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog">
                                                <circle cx="18" cy="15" r="3" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M10 15H6a4 4 0 0 0-4 4v2" />
                                                <path d="m21.7 16.4-.9-.3" />
                                                <path d="m15.2 13.9-.9-.3" />
                                                <path d="m16.6 18.7.3-.9" />
                                                <path d="m19.1 12.2.3-.9" />
                                                <path d="m19.6 18.7-.4-1" />
                                                <path d="m16.8 12.3-.4-1" />
                                                <path d="m14.3 16.6 1-.4" />
                                                <path d="m20.7 13.8 1-.4" />
                                            </svg></i> </div>
                                    <div class="side-menu__title">Administradores</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="clipboard-copy"></i> </div>
                            <div class="side-menu__title">
                                PLANIFICACIÓN
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
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-off">
                                                <path d="M4.18 4.18A2 2 0 0 0 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 1.82-1.18" />
                                                <path d="M21 15.5V6a2 2 0 0 0-2-2H9.5" />
                                                <path d="M16 2v4" />
                                                <path d="M3 10h7" />
                                                <path d="M21 10h-5.5" />
                                                <line x1="2" x2="22" y1="2" y2="22" />
                                            </svg></i> </div>
                                    <div class="side-menu__title">Dias no Laborales</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.sedes')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="building"></i> </div>
                                    <div class="side-menu__title">Gestión sedes</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div style="height: 65px;"></div>
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
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Intermede -->
                    <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                        <div class="mobile-menu-toggler cursor-pointer"> <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i> </div>
                    </div>
                    <div class="intro-x relative ml-auto sm:mx-auto"> </div>
                    <!-- END: Intermede -->
                    <div class="intro-x relative ml-auto flex sm:mx-auto">
                        <a href="{{ route('admin.checkin')  }}"><i width="30" height="30" data-lucide="check-circle-2"></i></a>
                    </div>
                    <div class="intro-x relative ml-auto flex sm:mx-auto"></div>
                    <div class="intro-x relative ml-auto flex sm:mx-auto"></div>
                    <div class="intro-x relative ml-auto flex sm:mx-auto"></div>
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                                @if(!isset(Auth::user()->imagen_perfil))
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/default-profile-image.png')}}">
                                @else
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/'.Auth::user()->imagen_perfil)}}">
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
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar sesión </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    @yield('subcontent')
                </div>
                
            </div>
        </div>
    </div>
    <div class="footer-container">
        <footer class="main-footer" id="mobileFooter">
            <div class="float-right">
                <b>Version</b> 3.1.1
            </div>
            <strong>Copyright &copy; 2024 <a href="https://www.inventores.mx/">Laboratorio de Inventores</a>.</strong> All rights reserved.
        </footer>
    </div>

</body>
@endsection
