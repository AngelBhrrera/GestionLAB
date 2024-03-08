@extends('layouts/prestador-layout')

@section('subhead')

    <?php  
        $area = Auth::user()->area;
        $filtro = DB::table('modulos')
            ->where('id', $area)
            ->first();
    ?>

@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="col-span-12 2xl:col-span-9">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5 text-align center">SEGUIMIENTO DE HORAS</h2>
        </div>
        <div class="grid grid-cols-12">

            <!-- BEGIN: Reporte Horas Generales -->
            <div class="col-span-12 mt-6">     
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
            </div>
            <br>
            <div class="mt-4" style="width: 300px;">
                <div class="intro-x box p-5">
                    <div class="flex items-center">
                        <img class="w-7 h-7" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/calendar-check.png') }}">
                        <div class="ml-4">Racha de asistencias</div>
                        <div class="ml-auto">{{$racha}}</div>
                    </div>
                    <div class="flex items-center mt-5 sm:w-50">
                        <img class="w-7 h-7" alt="Rocketman Tailwind HTML Admin Template" src="{{ asset('build/assets/images/calendar-x.png') }}">
                        <div class="ml-4">Faltas totales</div>
                        <div class="ml-auto">{{$faltas}}</div>
                    </div>
                    <a href="{{ route('actividadesAsignadas') }}" class="flex items-center mt-5 sm:w-50">
                        <img src="{{asset('build/assets/images/list-collapse.svg')}}" alt="">
                        <div style="color: blue;" class="ml-4">Actividades pendientes</div>
                        <div style="color: blue;" class="ml-auto">{{$nActividades}}</div>
                    </a>
                    <a href="{{ route('misActividades') }}" class="flex items-center mt-5 sm:w-50">
                        <img src="{{asset('build/assets/images/list-checks.svg')}}" alt="">
                        <div style="color: blue;" class="ml-4">Actividades terminadas</div>
                        <div style="color: blue;" class="ml-auto">{{$terminadas}}</div>
                    </a>
                    
                </div>
            </div>
            

            <!-- END: Reporte 1 -->
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">ULTIMOS 5 CHECK IN</h2>
            </div>
            <br>
            <div id="players"> </div>
            @if ($filtro->gamificacion == 1)
            <!-- BEGIN: leaderboard -->
            <div class="xl:px-6 mt-2.5">
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        TORNEO: MEJORES PRESTADORES DE SERVICIO
                    </h2>
                </div>
            </div>

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#area">Área</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sede">Sede</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="area">
                <ul class="nav nav-tabs nav-justified " style="overflow-x: auto; padding-bottom: 10px;" role="tablist">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Prestador</th>
                                <th class="whitespace-nowrap">Experiencia</th>
                                <th class="whitespace-nowrap">Semanas</th>
                                <th class="whitespace-nowrap">Rango</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $bandera = false; ?>
                            @foreach ($leaderboard as $top)
                            @if ($top->codigo == Auth::user()->codigo)
                                <?php $bandera = true; ?>
                                <td><strong><p style="color: #0023FF;">{{$top->Posicion}}</p></strong></td>
                                
                                <td>
                                    <div class="w-10 h-10 image-fit">
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                            src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                    </div>
                                    <strong><p style="color: #0023FF"> {{$top->Inventor}}</p></strong></td>
                                <td><strong><p style="color: #0023FF">{{$top->total_exp}}</p></strong></td>
                                <td>{{ $top->semanas_actividad }}</td>
                                <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}"  width="40" height="80" alt=""></td>  
                            @else
                                        
                                        <td>{{$top->Posicion}}</td>
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                                src="{{route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false'])}}">
                                            </div>
                                            {{$top->Inventor}}</td>
                                        <td>{{$top->total_exp}}</td>
                                        <td>{{ $top->semanas_actividad }}</td>
                                        <td><img src="{{asset('build/assets/'.$top->ruta)}}"  width="40" height="80" alt=""></td>
                                    @endif
                                </tr>
                            @endforeach
                            @if (!$bandera)
                                <tr>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuarioA}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                        src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{Auth::user()->name}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{Auth::user()->experiencia}}</strong></p> </td>
                                    <td>{{ $top->semanas_actividad }}</td>
                                    <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}" width="40" height="80"alt=""></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                <ul>
                </div>
                <div class="tab-pane" id="sede">
                <ul class="nav nav-tabs nav-justified " role="tablist">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Prestador</th>
                                <th class="whitespace-nowrap">Experiencia</th>
                                <th class="whitespace-nowrap">Semanas</th>
                                <th class="whitespace-nowrap">Rango</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $bandera = false; ?>
                        @foreach ($leaderboardSede as $top)
                                    @if ($top->codigo == Auth::user()->codigo)
                                        <?php $bandera = true; ?>
                                        <td><strong><p style="color: #0023FF;">{{$top->Posicion}}</p></strong></td>
                                        
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                                 src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                            </div>
                                            <strong><p style="color: #0023FF"> {{$top->Inventor}}</p></strong></td>
                                        <td><strong><p style="color: #0023FF">{{$top->total_exp}}</p></strong></td>
                                        <td>{{ $top->semanas_actividad }}</td>
                                        <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}"  width="40" height="80" alt=""></td>
                                                
                                    @else
                                        
                                        <td>{{$top->Posicion}}</td>
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                                src="{{route('obtenerImagen', ['nombreArchivo' => ($top->imagen_perfil != null) ? $top->imagen_perfil : 'false'])}}">
                                            </div>
                                            {{$top->Inventor}}</td>
                                        <td>{{$top->total_exp}}</td>
                                        <td>{{ $top->semanas_actividad }}</td>
                                        <td><img src="{{asset('build/assets/'.$top->ruta)}}"  width="40" height="80" alt=""></td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                            @if (!$bandera)
                                <tr>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuarioS}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                        src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{Auth::user()->name}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{Auth::user()->experiencia}}</strong></p> </td>
                                    <td>{{ $top->semanas_actividad }}</td>
                                    <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}" width="40" height="80"alt=""></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                <ul>
            </div>
            <!-- END: leaderboard-->
            @endif
        </div>
        <div class="container" style="height: 45px;"></div>
    </div>

@endsection

@section('script')
     
    <script type="text/javascript">

            var assist = {!! $asistencias !!};

            var table = new Tabulator("#players", {
                data: assist,
                layout: "fitDataFill",
                resizableColumns:false,
                //responsiveLayout:"collapse",
                layoutColumnsOnNewData:true,
                virtualDomHoz:true,
                tooltips: true,

                columns: [{
                        title: "Fecha",
                        field: "fecha",
                        sorter: "date",
                        formatter: "datetime",
                        formatterParams: {
                            inputFormat: "DD/MM/YYYY",
                            outputFormat: "DD/MM/YYYY", 
                            invalidPlaceholder: "(Fecha inválida)",
                        },
                        headerFilter: "input",
                        width: 120,
                    },  {
                        title: "Horas",
                        field: "horas",
                        sorter: "number",
                        width: 100,
                    }, {
                        title: "Estado",
                        field: "estado",
                        formatter: function(cell, formatterParams, onRendered) {
                            var estado = cell.getValue();
                            var icono = "";

                            if (estado === "autorizado") {
                                icono = "✔️";
                            } else if (estado === "pendiente") {
                                icono = "⏳";
                            } else if (estado === "denegado") {
                                icono = "❌";
                            }
                            return icono;
                        },
                        
                    },{
                        title: "Entrada",
                        field: "hora_entrada",
                        sorter: "string",
                        width: 120,
                    },
                    {
                        title: "Salida",
                        field: "hora_salida",
                        sorter: "string",
                        width: 120,
                    }, {
                        title: "Tiempo",
                        field: "tiempo",
                        sorter: "number",
                    },  
                    
                ],
            });

    </script>

@endsection
