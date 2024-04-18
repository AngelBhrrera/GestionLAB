@extends('layouts/main')

@section('head')
    <title>Dashboard - Rocketman - Tailwind HTML Admin Templatee</title>
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <img class="mx-auto my-auto" alt="Inventores" width="170px" height="100px" src="{{ asset('build/assets/images/logosInventores/InventoresBannerHDWhiteBorder.png') }}">
                        <h1 class="text-lg font-medium truncate mr-5">Sistema de Predicción del Rendimiento de los Prestadores del Servicio en el Área del Laboratorio de Inventores</h1>
                    </div>
                    <br>
                    <br>
                    <div class="intro-y report-box mt-12 sm:mt-4">
                        <div class="box py-0 xl:py-5 grid grid-cols-12 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">
                            <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-primary bg-primary/20 border border-primary/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="crop"></i>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="report-box__item__indicator text-danger tooltip cursor-pointer" title="120 menos que la ultima semana">
                                                -120 <i data-lucide="arrow-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">585</div>
                                    <div class="text-slate-500 mt-1">Diferencial Experiencia Semanal</div>
                                </div>
                            </div>
                            <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="thumbs-up"></i>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="report-box__item__indicator text-danger tooltip cursor-pointer" title="17 menos que la ultima semana">
                                                -17 <i data-lucide="arrow-down" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">34</div>
                                    <div class="text-slate-500 mt-1">Total de Actividades Exitosas de la Semana</div>
                                </div>
                            </div>
                            <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="star"></i>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="report-box__item__indicator text-success tooltip cursor-pointer" title="12% más que el último mes">
                                                +12% <i data-lucide="arrow-down" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">65%</div>
                                    <div class="text-slate-500 mt-1">% de Actividades con Exito Notable y Excelente</div>
                                </div>
                            </div>
                            <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-success bg-success/20 border border-success/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="pie-chart"></i>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="report-box__item__indicator text-danger tooltip cursor-pointer" title="--">
                                                -- <i data-lucide="arrow-down" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">10</div>
                                    <div class="text-slate-500 mt-1">-OTRO DATO-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
                <!-- BEGIN: Top Countries -->
                <div class="col-span-12 md:col-span-4 lg:col-span-3 mt-4 md:mt-7 ml-4">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Mejores rendimientos</h2>
                        <a href="" class="ml-auto text-slate-500 truncate">Ver más</a>
                    </div>
                    <div class="intro-y box p-5 mt-4">
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/united-states.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 1</div>
                            <div class="ml-auto">320</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/france.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 2</div>
                            <div class="ml-auto">304</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/spain.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 3</div>
                            <div class="ml-auto">289</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/united-kingdom.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 4</div>
                            <div class="ml-auto">275</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/india.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 5</div>
                            <div class="ml-auto">254</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/brazil.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 6</div>
                            <div class="ml-auto">230</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/switzerland.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 7</div>
                            <div class="ml-auto">211</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/france.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 8</div>
                            <div class="ml-auto">180</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/united-kingdom.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 9</div>
                            <div class="ml-auto">132</div>
                        </div>
                        <div class="flex items-center mb-5 last:mb-0">
                            <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/united-kingdom.svg') }}">
                            </div>
                            <div class="ml-3 truncate pr-5">Usuario 10</div>
                            <div class="ml-auto">97</div>
                        </div>
                    </div>
                </div>
                <!-- END: Top Countries -->
                
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 md:col-span-8 lg:col-span-10 mt-7 ml-4">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Rendimiento de Experiencia Semanal</h2>
                        <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                            <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                            <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                        </div>
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-4">
                        <div class="md:flex items-center">
                            <div class="mr-auto">
                                <div class="flex items-center">
                                    <div class="text-2xl font-medium">585</div>
                                    <div class="flex items-center text-danger cursor-pointer ml-3">
                                        -120 <i data-lucide="arrow-up" class="w-4 h-4 ml-0.5"></i>
                                    </div>
                                </div>
                                <div class="text-slate-500 mt-1">Total de Experiencia</div>
                            </div>
                            <select class="form-select w-40 md:ml-auto mt-3 md:mt-0 dark:bg-darkmode-600 dark:border-darkmode-400" aria-label="General report filter">
                                <option selected>Filtrar por</option>
                                <option>Matutino</option>
                                <option>Mediodia</option>
                                <option>Vespertino</option>
                                <option>Sabatino</option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <div class="h-[260px]">
                                <canvas id="report-line-chart-1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
                
                <!-- BEGIN: Rendimiento Diario -->
                <div class="col-span-12 mt-4">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Rendimiento Diario del Área</h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <select class="form-select box w-32" aria-label="General report filter">
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                            <button class="ml-3 btn box flex items-center text-slate-600 dark:text-slate-300">
                                <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF
                            </button>
                        </div>
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-4">
                        <div class="overflow-x-auto overflow-y-hidden">
                            <div class="daily-report">
                                <div class="daily-report__statistic flex">
                                    <div class="w-full -mr-12">
                                        <div class="text-slate-500 text-xs h-5"></div>
                                        <div class="daily-report__statistic__week grid grid-cols-4 mt-2 text-slate-500">
                                            <div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Lun</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Mar</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Mie</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Jue</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Vie</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5 relative">
                                                    <div class="daily-report__statistic__day__text text-slate-500 absolute inset-y-0 my-auto text-xs">Sab</div>
                                                </div>
                                                <div class="daily-report__statistic__day w-full pt-[100%] mb-2.5"></div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach (["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] as $month)
                                        <div class="w-full">
                                            <div class="text-slate-500 text-xs h-5">{{ $month }}</div>
                                            <div class="daily-report__statistic__week grid grid-cols-4 mt-2">
                                                @for ($week = 0; $week < 8; $week++)
                                                    <div>
                                                        @foreach (["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"] as $day)
                                                            <div title="{{ rand(1, 50) }} sales on 2 Sep, 2021" class="daily-report__statistic__day tooltip w-full pt-[100%] mb-2 cursor-pointer zoom-in bg-primary {{ ['bg-opacity-60', 'bg-opacity-40', 'bg-opacity-30', 'bg-opacity-20', 'bg-opacity-10'][rand(0, 4)] }}"></div>
                                                        @endforeach
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="w-full flex items-center xl:justify-end">
                                    <div class="mr-2 text-slate-500 text-xs">Less</div>
                                    <div title="1 - 5 sales" class="daily-report__info tooltip mr-2 w-3.5 h-3.5 -mt-0.5 bg-primary/10"></div>
                                    <div title="5 - 15 sales" class="daily-report__info tooltip mr-2 w-3.5 h-3.5 -mt-0.5 bg-primary/20"></div>
                                    <div title="15 - 35 sales" class="daily-report__info tooltip mr-2 w-3.5 h-3.5 -mt-0.5 bg-primary/30"></div>
                                    <div title="35 - 65 sales" class="daily-report__info tooltip mr-2 w-3.5 h-3.5 -mt-0.5 bg-primary/40"></div>
                                    <div title="65+ sales" class="daily-report__info tooltip mr-2 w-3.5 h-3.5 -mt-0.5 bg-primary/60"></div>
                                    <div class="mr-2 text-slate-500 text-xs">More</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Performance -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l border-slate-300/50 h-full 2xl:pt-6 pb-6">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 gap-y-8">
                    <!-- BEGIN: Attachments -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">ACCIONES</h2>
                        </div>
                        <div class="mt-4">
                            <div class="intro-x">
                                <div class="box px-5 py-3 flex items-center zoom-in mb-3">
                                    <a href="">
                                        <div class="mr-auto">
                                            <div class="font-medium">Simulador de Prediccion</div>
                                        </div>
                                        <div class= "text-success">% de precisión</div>
                                    </a>
                                </div>

                                <div class="box px-5 py-3 flex items-center zoom-in mb-3">
                                    <a href="">
                                        <div class="mr-auto">
                                            <div class="font-medium">Visualizar reporte</div>
                                        </div>
                                        <div class= "text-success">Fecha de actualizacion: </div>
                                    </a>
                                </div>
                
                            </div>
                        </div>
                    </div>
                    <!-- END: Attachments -->
                    <!-- BEGIN: Pie chart -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 sm:row-start-4 md:row-start-3 lg:row-start-auto mt-4">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Perfil de Prestador</h2>
                                <a href="" class="ml-auto text-slate-500 truncate">Ver más</a>
                            </div>
                            <ul class="nav nav-boxed-tabs sm:w-64 rounded-lg mt-3 sm:mt-0" role="tablist">
                                <li id="daily-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button
                                        class="nav-link w-full py-1.5 px-2 active"
                                        data-tw-toggle="pill"
                                        data-tw-target="#daily-new-transaction"
                                        type="button"
                                        role="tab"
                                        aria-controls="daily-new-transaction"
                                        aria-selected="true"
                                    >
                                        Turno
                                    </button>
                                </li>
                                <li id="weekly-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button
                                        class="nav-link w-full py-1.5 px-2"
                                        data-tw-toggle="pill"
                                        data-tw-target="#weekly-new-transaction"
                                        type="button"
                                        role="tab"
                                        aria-selected="false"
                                    >
                                        Carrera
                                    </button>
                                </li>
                                <li id="monthly-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button
                                        class="nav-link w-full py-1.5 px-2"
                                        data-tw-toggle="pill"
                                        data-tw-target="#monthly-new-transaction"
                                        type="button"
                                        role="tab"
                                        aria-selected="false"
                                    >
                                       Periodo
                                    </button>
                                </li>
                            </ul>
                            <div class="intro-y box p-5 mt-4">
                                <div class="relative px-3">
                                    <div class="w-40 mx-auto lg:w-auto">
                                        <div class="h-[210px]">
                                            <canvas class="mt-2 z-10 relative" id="report-donut-chart-1"></canvas>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-center items-center absolute w-full h-full top-0 left-0">
                                        <div class="text-2xl leading-7 font-medium">67</div>
                                        <div class="text-slate-500 mt-1">Prestadores totales</div>
                                    </div>
                                </div>
                                <div class="w-52 lg:w-auto mx-auto mt-6">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-primary/50 border border-primary/50 rounded-full mr-3"></div>
                                        <span class="truncate">Matutino</span>
                                        <span class="ml-auto">50%</span>
                                    </div>
                                    <div class="flex items-center mt-4">
                                        <div class="w-2 h-2 bg-pending/50 border border-pending/50 rounded-full mr-3"></div>
                                        <span class="truncate">Mediodia</span>
                                        <span class="ml-auto">30%</span>
                                    </div>
                                    <div class="flex items-center mt-4">
                                        <div class="w-2 h-2 bg-warning/50 border border-warning/60 rounded-full mr-3"></div>
                                        <span class="truncate">Vespertino</span>
                                        <span class="ml-auto">20%</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- END: Pie Chart -->
                </div>
            </div>
        </div>
    </div>
@endsection
