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

</html>