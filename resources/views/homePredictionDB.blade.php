@extends('layouts/admin-layout')

    <?php  
        $area = Auth::user()->area;

        $filtro = DB::table('modulos')
            ->where('id', $area)
            ->first();
    ?>

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Rendimiento del Area</li>
@endsection

@section('subhead')
    <style>
        .intro-y.box {
            width: 100%; /* O el ancho que prefieras */
            max-width: 100%; /* Para asegurar que no exceda el ancho de su contenedor padre */
        }

       
        canvas {
            width: 100% !important; /* Ocupar todo el ancho del contenedor */
            height: auto !important; /* Mantener la proporción del gráfico */
        }


    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection


@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
           
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-4">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
                            Rendimiento del Area
                        </h2>
                    </div>
                    <br>
                    <br>
                    <div class="intro-y report-box mt-12 sm:mt-2">
                        <div class="box py-0 xl:py-5 grid grid-cols-12 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">
                            @if($rendimiento->count() > 0)   
                            <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-primary bg-primary/20 border border-primary/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="crop"></i>
                                        </div>
                                        <div class="ml-auto">
                                            @php
                                                $diferencial = 0;
                                                $color = 'text-gray-500';
                                                if ($rendimiento->count() > 1) {
                                                    $diferencial = $rendimiento[0]->total_exp_sum - $rendimiento[1]->total_exp_sum;
                                                    if ($diferencial > 0) {
                                                        $color = 'text-success';
                                                        $arrow = 'arrow-up';
                                                    } elseif ($diferencial < 0) {
                                                        $color = 'text-danger';
                                                        $arrow = 'arrow-down';
                                                    } else {
                                                        $color = 'text-warning';
                                                    }
                                                }
                                            @endphp
                                            <div class="report-box__item__indicator {{ $color }} tooltip cursor-pointer" title="{{ $diferencial }} menos que la ultima semana">
                                                {{ $diferencial }} @if ($arrow) <i data-lucide="{{ $arrow }}" class="w-4 h-4 ml-0.5"></i> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">{{ $rendimiento[0]->total_exp_sum }}</div>
                                    <div class="text-slate-500 mt-1">Diferencial Experiencia Semanal</div>
                                </div>
                            </div>
                            @endif
                            <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="report-box__content">
                                    <div class="flex">
                                        <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full">
                                            <i data-lucide="thumbs-up"></i>
                                        </div>
                                        <div class="ml-auto">
                                            @php
                                                $diferencial = 0;
                                                $color = 'text-gray-500';
         
                                                    $diferencial = $acabadasRA - $acabadasRP;
                                                    if ($diferencial > 0) {
                                                        $color = 'text-success';
                                                        $arrow = 'arrow-up';
                                                    } elseif ($diferencial < 0) {
                                                        $color = 'text-danger';
                                                        $arrow = 'arrow-down';
                                                    } else {
                                                        $color = 'text-warning';
                                                        $arrow = 'arrow-down';
                                                    }
                                                
                                            @endphp
                                            <div class="report-box__item__indicator {{ $color }} tooltip cursor-pointer" title="{{ $diferencial }} menos que la ultima semana">
                                                {{ $diferencial }} @if ($arrow) <i data-lucide="{{ $arrow }}" class="w-4 h-4 ml-0.5"></i> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">{{ $acabadasRA }}</div>
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
                                            @php
                                                $diferencial = 0;
                                                $color = 'text-gray-500';
                                                
                                                    $diferencial = round($porcentajeA - $porcentajeP, 2);
                                                    if ($diferencial > 0) {
                                                        $color = 'text-success';
                                                        $arrow = 'arrow-up';
                                                    } elseif ($diferencial < 0) {
                                                        $color = 'text-danger';
                                                        $arrow = 'arrow-down';
                                                    } else {
                                                        $color = 'text-warning';
                                                        $arrow = 'arrow-down';
                                                    }
                                            @endphp
                                            <div class="report-box__item__indicator {{ $color }} tooltip cursor-pointer" title="{{ $diferencial }} menos que la ultima semana">
                                                {{ $diferencial }} % @if ($arrow) <i data-lucide="{{ $arrow }}" class="w-4 h-4 ml-0.5"></i> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-medium leading-7 mt-6">{{ round($porcentajeA, 2) }}</div>
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
                                    <div class="text-slate-500 mt-1">Experiencia generada en la semana</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
 
                <!-- BEGIN: Top Users -->
                <div class="col-span-12 md:col-span-4 lg:col-span-3 mt-4 md:mt-7 ml-4">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Mejores rendimientos</h2>
                        <a href="" class="ml-auto text-slate-500 truncate">Ver más</a>
                    </div>

                    <div class="intro-y box p-5 mt-4">
                     
                            <div class="flex items-center mb-5 last:mb-0">
                                <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                    <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/prestico3.svg') }}">
                                </div>
                                <div class="ml-3 truncate pr-5">AAA</div>
                                <div class="ml-auto">200</div>
                            </div>

                            <div class="flex items-center mb-5 last:mb-0">
                                <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                    <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/prestico3.svg') }}">
                                </div>
                                <div class="ml-3 truncate pr-5">BBB</div>
                                <div class="ml-auto">100</div>
                            </div>

                            <div class="flex items-center mb-5 last:mb-0">
                                <div class="w-[1.15rem] h-[1.15rem] image-fit rounded-full overflow-hidden">
                                    <img class="rounded-full !w-[140%] !h-[140%] -mt-[20%]" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/prestico3.svg') }}">
                                </div>
                                <div class="ml-3 truncate pr-5">CCC</div>
                                <div class="ml-auto">50</div>
                            </div>
                      
                    </div>

                </div>
                <!-- END: Top Users -->
                @if($rendimiento->count() > 0)   
                <!-- BEGIN: Rendimiento Semanal -->
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
                                    <div class="text-2xl font-medium">{{ $rendimiento[0]->total_exp_sum }}</div>
                                    @php
                                        $diferencial = 0;
                                        $color = 'text-gray-500';
                                        if ($rendimiento->count() > 1) {
                                            $diferencial = $rendimiento[0]->total_exp_sum - $rendimiento[1]->total_exp_sum;
                                            if ($diferencial > 0) {
                                                $color = 'text-success';
                                                $arrow = 'arrow-up';
                                            } elseif ($diferencial < 0) {
                                                $color = 'text-danger';
                                                $arrow = 'arrow-down';
                                            } else {
                                                $color = 'text-warning';
                                            }
                                        }
                                    @endphp
                                    <div class="flex items-center text-danger cursor-pointer ml-3">
                                        {{ $diferencial }} @if ($arrow) <i data-lucide="{{ $arrow }}" class="w-4 h-4 ml-0.5"></i> @endif
                                    </div>
                                </div>
                                <div class="text-slate-500 mt-1">Total de Experiencia</div>
                                <select id="turno-select" class="form-select w-40 md:ml-auto mt-3 md:mt-0 dark:bg-darkmode-600 dark:border-darkmode-400" aria-label="General report filter">
                                    <option value="all" selected>Filtrar por</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Mediodia">Mediodia</option>
                                    <option value="Vespertino">Vespertino</option>
                                    <option value="Sabatino">Sabatino</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <div class="h-[260px]">
                                    <canvas id="scatter-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Rendimiento Semanal -->
                @endif

            </div>
        </div>

      
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l border-slate-300/50 h-full 2xl:pt-6 pb-6">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 gap-y-8">                          
                    <!-- BEGIN: Otras opciones-->
                    @if(isset($iltimaActualizacion))   
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">ACCIONES</h2>
                        </div>
                        <div class="mt-4">
                            <div class="intro-x">
                                <div class="box px-5 py-3 flex items-center zoom-in mb-3">
                                    <a href="predictor">
                                        <div class="mr-auto">
                                            <div class="font-medium">Simulador de Prediccion</div>
                                        </div>
                                        <div class= "text-success">71% de precisión</div>
                                    </a>
                                </div>

                                <div class="box px-5 py-3 flex items-center zoom-in mb-3">
                                    <a href="dataframe">
                                        <div class="mr-auto">
                                            <div class="font-medium">Visualizar reporte</div>
                                        </div>
                                        <div class= "text-success">Fecha de actualizacion: {{ $ultimaActualizacion->fecha_reporte }} </div>
                                    </a>
                                </div>
                
                            </div>
                        </div>
                    </div>
                    <!-- END: Otras Opciones -->
                    @endif
                    <!-- START: Perfil prestador -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 sm:row-start-4 md:row-start-3 lg:row-start-auto mt-4">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Perfil de Prestador</h2>
                                <a href="" class="ml-auto text-slate-500 truncate">Ver más</a>
                            </div>
                            <ul class="nav nav-boxed-tabs sm:w-64 rounded-lg mt-3 sm:mt-0" role="tablist">
                                <li id="daily-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-1.5 px-2 active" data-tw-toggle="pill" data-tw-target="#turno-chart" type="button" role="tab" aria-controls="daily-new-transaction" aria-selected="true">
                                        Turno
                                    </button>
                                </li>
                                <li id="weekly-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-1.5 px-2" data-tw-toggle="pill" data-tw-target="#carrera-chart" type="button" role="tab" aria-selected="false">
                                        Carrera
                                    </button>
                                </li>
                                <li id="monthly-new-transaction-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-1.5 px-2" data-tw-toggle="pill" data-tw-target="#periodo-chart" type="button" role="tab" aria-selected="false">
                                        Periodo
                                    </button>
                                </li>
                            </ul>
                            <div class="intro-y box p-5 mt-4">
                                <div class="relative px-3">
                                    <div class="w-50 mx-auto lg:w-auto">
                                        <div class="h-[460px]">
                                            <canvas class="mt-2 z-10 relative" id="turno-chart"></canvas>
                                            <canvas class="mt-2 z-10 relative" id="carrera-chart" style="display: none;"></canvas>
                                            <canvas class="mt-2 z-10 relative" id="periodo-chart" style="display: none;" ></canvas>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-center items-center absolute w-full h-full top-0 left-0">
                                        <!-- Aquí se mostrará el total de prestadores de turno -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var carreraData = {!! json_encode($carreras) !!};
    var carreraLabels = carreraData.map(item => item.carrera);
    var carreraValues = carreraData.map(item => item.conteo);

    var periodoData = {!! json_encode($periodos) !!};
    var periodoLabels = periodoData.map(item => item.periodo);
    var periodoValues = periodoData.map(item => item.conteo);

    var turnoData = {!! json_encode($turnos) !!};
    var turnoLabels = turnoData.map(item => item.horario);
    var turnoValues = turnoData.map(item => item.conteo);
    
    var turnoChartCtx = document.getElementById('turno-chart').getContext('2d');
    var turnoChart = new Chart(turnoChartCtx, {
        type: 'doughnut',
        data: {
            labels: turnoLabels,
            datasets: [{
                data: turnoValues,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)',
                'rgb(255, 0, 255)',
                'rgb(0, 255, 255)',
                'rgb(128, 128, 128)',
                'rgb(0, 0, 0)',
                ]
            }]
        }
    });

</script>

<script>

    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('canvas').forEach(canvas => {
                canvas.style.display = 'none';
            });
            // Mostrar el gráfico correspondiente
            const targetCanvas = document.querySelector(this.dataset.twTarget);
            if (targetCanvas) {
                targetCanvas.style.display = 'block';
                var ctx = document.getElementById('scatter-chart')
                ctx.style.display = 'block';
            }
        });
    });

    var carreraChartCtx = document.getElementById('carrera-chart').getContext('2d');
    var carreraChart = new Chart(carreraChartCtx, {
        type: 'doughnut',
        data: {
            labels: carreraLabels,
            datasets: [{
                data: carreraValues,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)',
                'rgb(255, 0, 255)',
                'rgb(0, 255, 255)',
                'rgb(128, 128, 128)',
                'rgb(0, 0, 0)',
                ]
            }]
        }
    });

    var periodoChartCtx = document.getElementById('periodo-chart').getContext('2d');
    var periodoChart = new Chart(periodoChartCtx, {
        type: 'doughnut',
        data: {
            labels: periodoLabels,
            datasets: [{
                data: periodoValues,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)',
                'rgb(255, 0, 255)',
                'rgb(0, 255, 255)',
                'rgb(128, 128, 128)',
                'rgb(0, 0, 0)',
                ]
            }]
        }
    });

    // Datos de rendimiento
    var rendimientoData = {!! json_encode($rendimientoT) !!};
    var rendimientoDataT = {!! json_encode($rendimientoTT) !!};

    // Inicializar gráfico de dispersión
    var ctx = document.getElementById('scatter-chart').getContext('2d');
    var scatterChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: rendimientoDataT.map(item => `${item.semana} ${item.anio}`),
            datasets: [{
                label: 'Total de Experiencia',
                data: rendimientoDataT.map(item => ({ x: `${item.semana} ${item.anio}`, y: item.total_exp_sum })),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                    position: 'bottom'
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Total de Experiencia: ${context.raw.y}`;
                        }
                    }
                }
            }
        }
    });

    document.getElementById('turno-select').addEventListener('change', function () {
        var selectedTurno = this.value;

        if (selectedTurno === 'all') {
            scatterChart.data.labels = rendimientoDataT.map(item => `${item.semana} ${item.anio}`);
            scatterChart.data.datasets[0].data = rendimientoDataT.map(item => ({ x: `${item.semana} ${item.anio}`, y: item.total_exp_sum }));
            scatterChart.update();
        } else {
            // Filtrar datos por el turno seleccionado
            var filteredData = rendimientoData.filter(item => item.turno === selectedTurno);

            // Actualizar datos del gráfico de dispersión con los datos filtrados
            scatterChart.data.labels = filteredData.map(item => `${item.semana} ${item.anio}`);
            scatterChart.data.datasets[0].data = filteredData.map(item => ({ x: `${item.semana} ${item.anio}`, y: item.total_exp }));
            scatterChart.update();
        }
    });
</script>

@endsection
