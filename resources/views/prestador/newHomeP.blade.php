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

    <div class="col-span-12 2xl:col-span-9">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5 text-align center">Seguimiento de horas</h2>
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
            <!-- END: Reporte 1 -->

            <!-- BEGIN: Leaderboard -->
            <div class="xl:px-6 mt-2.5">
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        TORNEO: MEJORES PRESTADORES DE SERVICIO
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
                                <th class="whitespace-nowrap">Rango</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php $bandera = false;?>
                                
                            @foreach ( $leaderBoard as $top)
                                <?php $imagen = DB::select("select imagen_perfil from users where codigo=$top->codigo")?>
                                <tr>
                                    @if ($top->codigo == Auth::user()->codigo)
                                        <?php $bandera = true; ?>
                                        <td><strong><p style="color: #0023FF;">{{$top->Posicion}}</p></strong></td>
                                        
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                            @if (Auth::user()->imagen_perfil)
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/'.Auth::user()->imagen_perfil)}}" 
                                                width="40" height="40" alt="">
                                            @else
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/default-profile-image.png')}}"
                                                width="40" height="40" alt="">
                                            @endif
                                            </div>
                                            <strong><p style="color: #0023FF"> {{$top->Inventor}}</p></strong></td>
                                        <td><strong><p style="color: #0023FF">{{$top->experiencia}}</p></strong></td>
                                        <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}"  width="40" height="80" alt=""></td>
                                                
                                    @else
                                        
                                        <td>{{$top->Posicion}}</td>
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                            @if(!$imagen[0]->imagen_perfil)
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/default-profile-image.png')}}" 
                                                width="40" height="40" alt="">    
                                            @else
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/'.$imagen[0]->imagen_perfil)}}" 
                                                width="40" height="40" alt="">
                                            @endif
                                            </div>
                                            {{$top->Inventor}}</td>
                                        <td>{{$top->experiencia}}</td>
                                        <td><img src="{{asset('build/assets/'.$top->ruta)}}"  width="40" height="80" alt=""></td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                            @if (!$bandera)
                                <tr>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario[0]->position}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                    @if(!isset(Auth::user()->imagen_perfil))
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/default-profile-image.png')}}">
                                    @else
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                        src="{{asset('storage/userImg/'.Auth::user()->imagen_perfil)}}" 
                                        width="40" height="40" alt="">                                
                                    @endif
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{$posicionUsuario[0]->Nombre}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario[0]->experiencia}}</strong></p> </td>
                                    <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}" width="40" height="80"alt=""></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END: Leaderboard-->
    </div>

@endsection

