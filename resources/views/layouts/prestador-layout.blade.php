@extends('../layouts/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    <style>
        .container:hover .imagen-rol {-webkit-transform:scale(1.5);transform:scale(1.5); transition:all .3s}
    </style>

    <?php   
        $nivel = DB::table('niveles')
            ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
            ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion', 'medallas.ruta_n' )
            ->where('niveles.experiencia', '<=',  Auth::user()->experiencia)
            ->orderByDesc('niveles.experiencia_acumulada')
            ->first();
        $nivel_str = strval($nivel->nivel);

        $area = Auth::user()->area;
        $filtro = DB::table('modulos')
            ->where('id', $area)
            ->first();

    ?>


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
                            <ul class="submenu">
                                <li>
                                    <a href="{{route('homeP')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                        <div class="side-menu__title">Inicio</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('horas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">  Registro de horas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('parciales')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file"></i> </div>
                                        <div class="side-menu__title">Reportes</div>
                                    </a>
                                </li>
                                <li>
                                <a href="{{route('horario')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                    <div class="side-menu__title">Horario prestador</div>
                                </a>
                                </li>                             
                            </ul>
                        </li>
                    </li>
                    
                @if ($filtro->gamificacion == 1)
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                            <div class="side-menu__title">
                                ACTIVIDADES
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('create_act')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                    <div class="side-menu__title"> Crear nueva actividad </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('obtenerActividades')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                                    <div class="side-menu__title">Mi proyecto</div>
                                </a>
                            </li>
                            </li>
                            <li>
                                <a href="{{route('misActividades')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                    <div class="side-menu__title"> Mis actividades </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividadesAsignadas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                    <div class="side-menu__title"> Actividades asignadas </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actPull')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                    <div class="side-menu__title"> Pull de actividades abiertas </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                            stroke-linejoin="round" class="lucide lucide-trophy"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg></i> </div>
                            <div class="side-menu__title">
                                TORNEO
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('horario')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><img src="{{asset('build/assets/images/podium.png')}}" width="24" height="24" alt=""></i> </div>
                                    <div class="side-menu__title">Leaderboard W/M</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('perfil')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="crown"></i> </div>
                                    <div class="side-menu__title">Insignias obtenidas</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('level')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" 
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="lucide lucide-arrow-up-1-0"><path d="m3 8 4-4 4 4"/><path d="M7 4v16"/>
                                    <path d="M17 10V4h-2"/><path d="M15 10h4"/><rect x="15" y="14" width="4" height="6" ry="2"/>
                                    </svg></i> </div>
                                    <div class="side-menu__title">Niveles</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif

                @if ($filtro->impresiones == 1)
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                            <div class="side-menu__title">
                                IMPRESIONES
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
        
                        <ul class="submenu">
                            <li>
                                <a href="{{route('create_imps')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                    <div class="side-menu__title"> Crear impresión </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('show_imps')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><img src="{{asset('build/assets/images/3d-printer.png')}}" width="24" height="24" alt=""></i> </div>
                                    <div class="side-menu__title">  Mostrar mis impresiones </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('show_all_imps')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i><img src="{{asset('build/assets/images/3d-printer-gear.png')}}" width="24" height="24" alt=""></i> </div>
                                    <div class="side-menu__title">  Ver todas las impresiones </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
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
                       

                    <div class="intro-x relative ml-auto flex sm:mx-auto">
                        @if (Auth::user()->tipo == "coordinador")
                            <a href="{{ route('cambiarRol') }}">
                                <div class="container"><img class="imagen-rol" title="Cambiar a vista admin"
                                src="{{asset('build/assets/images/prestico2.svg')}}" width="30" height="30" alt=""></div>
                            </a> 
                        @endif 
                        <img src="{{ asset('build/assets/' . $nivel->ruta_n) }}" width="30" height="30" alt="ruta">
                        <img src="{{asset('build/assets/images/XP.ico')}}"width="30" height="30" alt="">{{Auth::user()->experiencia}}</img>
                    </div>

                    <div class="intro-x relative ml-auto flex sm:mx-auto">
                            <img class="ml-5"width="50" heigth="30" src="{{asset('build/assets/'.$nivel->ruta)}}" alt="medalla">
                    </div>

                    <div class="intro-x dropdown h-10">
                        
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
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


