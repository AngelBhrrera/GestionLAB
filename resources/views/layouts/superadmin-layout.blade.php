@extends('../layouts/main')

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
                    @yield('scroll-menu')
                    @yield('gestion')
                    @yield('coordinador')
                    @yield('impresiones')
                    @yield('actividades')
                </ul>
            </div>
            <div style="height: 65px;"></div>
            <!-- END: Side Menu -->
        </nav>
        @yield('structure')
    </div>
    @yield('footer')
</body>
@endsection
