@extends('layouts/prestador-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection

@section('subcontent')


    <div class="col-span-12 mt-6 grid gap-36">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5 text-align center">Seguimiento de horas</h2>
            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                <input type="text" class="datepicker form-control sm:w-56 box pl-10">
            </div>
        </div>

        <!-- BEGIN: Reporte Horas Generales -->       
        <div class="intro-y report-box mt-12 sm:mt-4">
            <div class="box py-0 xl:py-5 grid grid-cols-12 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">

                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                    <div class="report-box__content">
                        <div class="flex">
                            <div class="report-box__item__icon text-primary bg-primary/20 border border-success/20 border-primary/20 flex items-center justify-center rounded-full">
                                <i data-lucide="pie-chart"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-medium leading-7 mt-6">{{$horasTotales}}</div>
                        <div class="text-slate-500 mt-1">TOTAL DE HORAS</div>
                    </div>
                </div>
                <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                    <div class="report-box__content">
                        <div class="flex">
                            <div class="report-box__item__icon text-success bg-success/20 border flex items-center justify-center rounded-full">                                           
                                <i data-lucide="pie-chart"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-medium leading-7 mt-6">{{$horasAutorizadas}}</div>
                        <div class="text-slate-500 mt-1">HORAS AUTORIZADAS</div>
                    </div>
                </div>
                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                    <div class="report-box__content">
                        <div class="flex">
                            <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                <i data-lucide="pie-chart"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-medium leading-7 mt-6">{{$horasPendientes}}</div>
                        <div class="text-slate-500 mt-1">HORAS PENDIENTES POR AUTORIZAR</div>
                    </div>
                </div>
                <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                    <div class="report-box__content">
                        <div class="flex">
                            <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full"> 
                                <i data-lucide="pie-chart"></i>
                            </div>
                    </div>
                    <div class="text-2xl font-medium leading-7 mt-6">{{$horasRestantes}}</div>
                    <div class="text-slate-500 mt-1 text-align center">HORAS RESTANTES</div>
                </div>
            </div>
        </div>
        <!-- END: Reporte 1 -->
    </div>

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
                            <td> <strong> 77 </strong> </td>
                            <td> <strong> Tu nombre y apellido </strong> </td>
                            <td> <strong> Tu experiencia </strong> </td>
                            <td> <strong> Tus actividades completadas </strong> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END: Leaderboard-->

@endsection

