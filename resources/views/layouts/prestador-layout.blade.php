@extends('../layouts/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
<?php   
        $nivel = DB::table('niveles')
            ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
            ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion')
            ->where('niveles.experiencia_acumulada', '<=', Auth::user()->experiencia ?? 1) // Si la experiencia es null, establece la experiencia acumulada en 0.
            ->orderByDesc('niveles.experiencia_acumulada')
            ->first();
        $nivel_str = strval($nivel->nivel);
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
                                    <a href="{{'/'}}" class="side-menu">
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
                            <a href="{{route('perfil')}}" class="side-menu">
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
                        <ul class="submenu">
                            <li>
                                <a href="{{route('horario')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                    <div class="side-menu__title">Horario prestador</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('asistencias')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                    <div class="side-menu__title">  Asistencias</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('faltas')}}" class="side-menu">
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
                        <ul class="submenu">
                            <li>
                                <a href="{{route('registro_reporte')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                    <div class="side-menu__title"> Crear nueva actividad </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('obtenerActividades')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                                    <div class="side-menu__title">Todas las actividades </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividades_creadas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="file-plus-2"></i> </div>
                                    <div class="side-menu__title"> Actividades creadas</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividades_en_proceso')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="file-input"></i> </div>
                                    <div class="side-menu__title">Actividades en proceso </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividadesTerminadas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                    <div class="side-menu__title"> Actividades terminadas en revisión </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividades_prestadores_revisadas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="file-check-2"></i> </div>
                                    <div class="side-menu__title"> Actividades revisadas </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('actividades_canceladas')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="file-x-2"></i> </div>
                                    <div class="side-menu__title"> Actividades con error </div>
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
        
                        <ul class="submenu">
                            <li>
                                <a href="{{route('create_imps')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                    <div class="side-menu__title"> Crear impresión </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('show_imps')}}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                    <div class="side-menu__title">  Mostrar mis impresiones </div>
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
                    <div class="intro-x relative ml-auto flex sm:mx-auto">
                            @if (Auth::user()->can_admin == 1)
                            <a href="{{ route('cambiarRol') }}">
                                <button class="btn btn-primary ml-5"><i data-lucide="refresh-cw"></i>
                                    {{ __('Cambiar a admin') }}</button>
                            </a>    
                            @endif
                            
                    </div>
                    
                    <!-- BEGIN: Intermede -->
                        <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                            <div class="mobile-menu-toggler cursor-pointer"> <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i> </div>
                        </div>
                        <div class="intro-x relative ml-auto sm:mx-auto"> </div>
                    <!-- END: Intermede -->
                       
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x relative ml-auto flex sm:mx-auto"><h2 class="text-1xl font-medium">Nivel: {{$nivel_str}} <br> Xp: {{Auth::user()->experiencia}}</h2> <img class="ml-5"width="70" heigth="50" src="{{asset('build/assets/'.$nivel->ruta)}}" alt="medalla"></div>
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

@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

<script>

    $('.side-menu').click(function(e) {

        var submenuS = $(this).next('.submenu');
        // Cierra todos los submenús, excepto el que se está abriendo
        $('.submenu').not(submenuS).slideUp();

        // Alterna la visibilidad del submenú clicado
        submenuS.slideToggle();
    });

</script>
@endsection

