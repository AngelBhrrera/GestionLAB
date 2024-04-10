@extends('../layouts/superadmin-layout')

@section('head')
    @section('headertype')
        <html class='dark'>
    @endsection

    <style>
        container {
            height: 100%;
            display: flex;
        }
        .container:hover .imagen-rol {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
            transition: all .3s;
        }
        footer {
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            padding: .75rem 4%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            background-color: #BDC9EB; 
            z-index: 1000; 
        }
        .blanco {
            filter: invert(80%) saturate(0%);
        }
    </style>

    <?php  
        $area = Auth::user()->area;
        $prestadores = DB::table('users')
            ->whereIn('tipo', ['prestador', 'voluntario', 'practicante'])
            ->exists();
        $proyectos = DB::table('proyectos')
            ->where('id_area', $area)
            ->exists();

        $filtro = DB::table('modulos')
            ->where('id', $area)
            ->first();
    ?>

    @yield('subhead')
@endsection

@section('scroll-menu')
    <li class="side-nav__devider mb-4">MENU</li>
    @if (Auth::user()->tipo == "jefe area" || Auth::user()->tipo == "jefe sede" || Auth::user()->tipo == "Superadmin")
        @section('gestion')
            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"> <i data-lucide="clipboard-list"></i> </div>
                    <div class="side-menu__title">
                        GESTION
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
                            <div class="side-menu__title">Registrar usuarios</div>
                        </a>
                    </li>
                    @if($prestadores)
                    <li>
                        <a href="{{route('admin.general')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="side-menu__title">Ver todos los usuarios</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.prestadores_pendientes')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="alert-octagon"></i> </div>
                            <div class="side-menu__title">Activar Prestador</div>
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
                            <div class="side-menu__title">Gestionar Vacaciones, Festivos y No Laborales</div>
                        </a>
                    </li>
                    @endif
                    {{--<li>
                        <a href="{{route('admin.horarios')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                            <div class="side-menu__title">Horario Prestadores</div>
                        </a>
                    </li>
                    --}}
                    @if (Auth::user()->tipo == "jefe area")
                    <li>
                        <a href="{{route('admin.sede')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="building"></i> </div>
                            <div class="side-menu__title">Modificar Area</div>
                        </a>
                    </li>
                    @else
                        <li>
                            <a href="{{route('admin.sede')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="building"></i> </div>
                                @if (Auth::user()->tipo == "jefe sede")
                                <div class="side-menu__title">Modificar Sede / Agregar Areas</div>
                                @else
                                <div class="side-menu__title">Modificar / Agregar Sedes / Areas</div>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if ($filtro->gamificacion == 1)
                    <li>
                        <a href="{{route('admin.categorias')}}" class="side-menu">
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                            stroke-linejoin="round" class="lucide lucide-between-horizontal-start"><rect width="13" 
                            height="7" x="8" y="3" rx="1"/><path d="m2 9 3 3-3 3"/><rect width="13" height="7" 
                            x="8" y="14" rx="1"/></svg></i> </div>
                            <div class="side-menu__title">Gestion Actividades, Categorias y Subcategorias</div>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
        @endsection
    @endif

    @if(Auth::user()->tipo == "coordinador" || Auth::user()->tipo == "jefe area")
    @section('coordinador')
        <li>
            <a href="#" class="side-menu">
                <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                class="lucide lucide-webhook"><path d="M18 16.98h-5.99c-1.1 0-1.95.94-2.48 1.9A4 4 0 0 1 2 17c.01-.7.2-1.4.57-2"/>
                <path d="m6 17 3.13-5.78c.53-.97.1-2.18-.5-3.1a4 4 0 1 1 6.89-4.06"/><path d="m12 6 3.13 5.73C15.66 12.7 16.9 13 18 13a4 4 0 0 1 0 8"/></svg></i></div>
                <div class="side-menu__title">
                    COORDINADOR
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('admin.prestadores_pendientes')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="alert-octagon"></i> </div>
                        <div class="side-menu__title">Activar Prestador</div>
                    </a>
                </li>
                @if(isset ($prestadores))
                    <li>
                        <a href="{{route('admin.prestadores')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user-check"></i> </div>
                            <div class="side-menu__title">Ver prestadores</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.firmas')}}" class="side-menu">
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-check">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                        <path d="m9 16 2 2 4-4" />
                                    </svg></i> </div>
                            @if (Auth::user()->tipo == "coordinador")
                            <div class="side-menu__title">Registros Checkin</div>
                            @else
                            <div class="side-menu__title">Validar horas</div>
                            @endif
                        </a>
                    </li>
                    @if (Auth::user()->tipo != "coordinador")
                    <li>
                        <a href="{{route('admin.reportes_parciales')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="file"></i> </div>
                            <div class="side-menu__title">Autorizar documentos del Servicio Social</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.premios')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                            <div class="side-menu__title">Premios</div>
                        </a>
                    </li>
                    @endif
                @endif
                @if ($filtro->visitas == 1)
                    <li>
                        <a href="{{ route('admin.visitas_reg') }}" class="side-menu">
                            <div class="side-menu__icon"> <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                                        <path d="m9 9.5 2 2 4-4" />
                                    </svg></i> </div>
                            <div class="side-menu__title">Gestion de Visitantes</div>
                        </a>
                    </li>
                @endif
            </ul>
    @endsection
    @endif

    @if ($filtro->impresiones == 1)
    @if($prestadores)
        @if (Auth::user()->tipo == "coordinador" || Auth::user()->tipo == "jefe area")
            @section('impresiones')
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
                            <a href="{{route('admin.control_print')}}" class="side-menu">
                                <div class="side-menu__icon"> <i><img src="{{asset('build/assets/images/3d-printer-gear.png')}}" class="blanco"  width="24" height="24" alt=""></i> </div>
                                <div class="side-menu__title">Gestión Impresoras</div>
                            </a>
                        </li>
                        @if (Auth::user()->tipo == "jefe area")
                        <li>
                            <a href="{{route('admin.module_print')}}" class="side-menu">
                            <div class="side-menu__icon"> <i><img src="{{asset('build/assets/images/3d-printer.png')}}"  class="blanco"  width="24" height="24" alt=""></i> </div>
                                <div class="side-menu__title">Gestion Modulo Impresion</div>
                            </a>
                        </li>
                        @endif
                        {{--
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
                        --}}
                    </ul>
                </li>
            @endsection
        @endif
    @endif
    @endif


    @if ($filtro->gamificacion == 1)
        @if (Auth::user()->tipo == "coordinador" || Auth::user()->tipo == "jefe area")
            @section('actividades')
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="side-menu__title">
                            PROYECTOS Y ACTIVIDADES
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        @if($prestadores)
                        <li>
                            <a href="{{ route('admin.create_proy') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="package-plus"></i> </div>
                                <div class="side-menu__title">Proyectos</div>
                            </a>
                        </li>
                        @endif
                        @if($proyectos)
                        <li>
                            <a href="{{ route('admin.actividades')}}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                <div class="side-menu__title"> Actividades del Area </div>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endsection
        @endif
    @endif


@endsection

@section('structure')
    <div class="wrapper">
        <div class="content">
            <div class="top-bar">

                <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                    <div class="mobile-menu-toggler cursor-pointer"> <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i> </div>
                </div>
                <div class="intro-x relative ml-auto sm:mx-auto"> </div>

                <div class="intro-x relative ml-auto flex sm:mx-auto">
                    <a href="{{ route('admin.checkin')  }}"><i width="30" height="30" data-lucide="check-circle-2"></i></a>
                </div>
                <div class="intro-x relative ml-auto flex sm:mx-auto"></div>
                <div class="intro-x relative ml-auto flex sm:mx-auto">
                    @if (Auth::user()->tipo == "coordinador")
                    <a href="{{ route('admin.cambiorol') }}">
                        <div class="container">
                            <img class="imagen-rol" title="Cambiar a Prestador" src="{{asset('build/assets/images/prestico3.svg')}}" width="30" height="30" alt="">
                        </div>
                    </a>
                    @endif
                </div>
                <div class="intro-x relative ml-auto flex sm:mx-auto"></div>
                <!-- Comienza menu cuenta-->
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
                                <hr class="dropdown-divider">
                            </li>
                            @if (Auth::user()->tipo != "coordinador")
                                <li>
                                <a href="{{ route('admin.verCambiarPassword') }}" class="dropdown-item"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Cambiar contraseña</a>
                                </li>
                            @endif
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
@endsection

@section('footer')
    <div class="footer-container">
        <footer class="main-footer" id="mobileFooter">
            <div class="float-right">
                <b>Version</b> 3.1.1
            </div>
            <strong>Copyright &copy; 2024 <a href="https://www.inventores.mx/">Laboratorio de Inventores</a>.</strong> All rights reserved.
        </footer>
    </div>
@endsection