@extends('../layouts/main')

@section('head')
    @yield('subhead')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href= '/cliente/home' >Visitante</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                                <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
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
                            </ul>
                        </li>
                    </li>

                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="laptop"></i> </div>
                            <div class="side-menu__title">
                                CAPACITACIÓN
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                                    <div class="side-menu__title">Modelado 3D </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="codesandbox"></i> </div>
                                    <div class="side-menu__title">Uso de Impresoras 3D </div>
                                </a>
                            </li>
                            <li>
                                <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="gamepad-2"></i> </div>
                                    <div class="side-menu__title"> Desarrollo de Videojuegos </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" 
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                    stroke-linejoin="round" class="lucide lucide-tablet-smartphone">
                                    <rect width="10" height="14" x="3" y="8" rx="2"/>
                                    <path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4"/>
                                    <path d="M8 18h.01"/></svg></i> </div>
                                    <div class="side-menu__title">Desarrollo de Aplicaciones Interactivas</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                                        <g style="stroke: currentColor; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path d="M 86.351 40.731 h -4.794 v -2.408 c 0 -4.91 -3.994 -8.904 -8.903 -8.904 H 51.914 v -5.538 c 0 -2.067 -1.682 -3.749 -3.748 -3.749 h -6.332 c -2.067 0 -3.749 1.682 -3.749 3.749 v 5.538 H 17.347 c -4.91 0 -8.904 3.994 -8.904 8.904 v 2.408 H 3.65 c -2.013 0 -3.65 1.637 -3.65 3.65 v 10.524 c 0 2.013 1.637 3.649 3.65 3.649 h 4.793 v 2.409 c 0 4.909 3.994 8.903 8.904 8.903 h 14.458 c 3.072 0 6.036 -1.363 8.129 -3.741 c 1.282 -1.456 3.128 -2.291 5.065 -2.291 s 3.783 0.835 5.064 2.291 c 2.094 2.378 5.057 3.741 8.13 3.741 h 14.459 c 4.909 0 8.903 -3.994 8.903 -8.903 v -2.409 h 4.794 c 2.013 0 3.649 -1.637 3.649 -3.649 V 44.381 C 90 42.368 88.363 40.731 86.351 40.731 z M 40.085 23.881 c 0 -0.964 0.785 -1.749 1.749 -1.749 h 6.332 c 0.964 0 1.748 0.784 1.748 1.749 v 5.538 h -9.829 V 23.881 z M 3.65 56.555 c -0.91 0 -1.65 -0.74 -1.65 -1.649 V 44.381 c 0 -0.91 0.74 -1.65 1.65 -1.65 h 4.793 v 13.824 H 3.65 z M 79.557 60.964 c 0 3.807 -3.097 6.903 -6.903 6.903 H 58.194 c -2.499 0 -4.914 -1.116 -6.629 -3.063 c -1.661 -1.887 -4.055 -2.969 -6.565 -2.969 c -2.511 0 -4.904 1.082 -6.566 2.969 c -1.714 1.947 -4.13 3.063 -6.628 3.063 H 17.347 c -3.807 0 -6.904 -3.097 -6.904 -6.903 v -2.409 V 40.731 v -2.408 c 0 -3.807 3.097 -6.904 6.904 -6.904 h 20.738 h 13.829 h 20.739 c 3.807 0 6.903 3.097 6.903 6.904 v 2.408 v 17.824 V 60.964 z M 88 54.905 c 0 0.909 -0.74 1.649 -1.649 1.649 h -4.794 V 42.731 h 4.794 c 0.909 0 1.649 0.74 1.649 1.65 V 54.905 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                            <path d="M 16.822 45.307 c -0.256 0 -0.512 -0.098 -0.707 -0.293 c -0.391 -0.391 -0.391 -1.023 0 -1.414 l 7.697 -7.697 c 0.391 -0.391 1.023 -0.391 1.414 0 s 0.391 1.023 0 1.414 l -7.697 7.697 C 17.334 45.209 17.078 45.307 16.822 45.307 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                            <path d="M 29.291 41.458 c -0.256 0 -0.512 -0.098 -0.707 -0.293 c -0.391 -0.391 -0.391 -1.023 0 -1.414 l 3.624 -3.624 c 0.391 -0.391 1.023 -0.391 1.414 0 s 0.391 1.023 0 1.414 l -3.624 3.624 C 29.803 41.36 29.547 41.458 29.291 41.458 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                            <path d="M 17.047 53.702 c -0.256 0 -0.512 -0.098 -0.707 -0.293 c -0.391 -0.391 -0.391 -1.023 0 -1.414 l 8.875 -8.875 c 0.391 -0.391 1.023 -0.391 1.414 0 s 0.391 1.023 0 1.414 l -8.875 8.875 C 17.559 53.604 17.303 53.702 17.047 53.702 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                        </g>
                                        </svg></i> </div>
                                    <div class="side-menu__title">Desarrollo de Aplicaciones Realidad Virtual</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="side-menu__title">
                                SOLICITUDES
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                                    <div class="side-menu__title">Modelado 3D</div>
                                </a>
                            </li>
                            <li>
                                <a href="side-menu-light-crud-data-list.html" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" 
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circuit-board">
                                    <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M11 9h4a2 2 0 0 0 2-2V3"/>
                                    <circle cx="9" cy="9" r="2"/><path d="M7 21v-4a2 2 0 0 1 2-2h4"/><circle cx="15" cy="15" 
                                    r="2"/></svg></i> </div>
                                    <div class="side-menu__title"> Prototipos </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('formulario')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="codesandbox"></i> </div>
                                    <div class="side-menu__title">Impresion de Modelos 3D</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('prestadoresProyectosCompletados')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                                    <div class="side-menu__title">Sistemas Web</div>
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
                       
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                            @if(Auth::user()->tipo=='alumno')
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/student-default-profile.jpg')}}">
                            @else
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/teacher-default-profile.png')}}">
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
    </div>      
</body>
@endsection


