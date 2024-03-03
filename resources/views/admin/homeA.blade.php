@extends('layouts/admin-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="col-span-12 2xl:col-span-9 pt-4">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5 text-align center">REPORTE DE DESEMPEÑO</h2>
        </div>
        <div class="grid grid-cols-12">

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
                                <div class="text-2xl font-medium leading-7 mt-6">{{$proys}}</div>
                                <div class="text-slate-500 mt-1">PROYECTOS TERMINADOS</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-success bg-success/20 border flex items-center justify-center rounded-full">                                           
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                                </div>
                                <div class="text-2xl font-medium leading-7 mt-6">{{$actsP}}</div>
                                <div class="text-slate-500 mt-1">ACTIVIDADES PENDIENTES</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                                </div>
                                <div class="text-2xl font-medium leading-7 mt-6">{{$actsT}}</div>
                                <div class="text-slate-500 mt-1">ACTIVIDADES TERMINADAS</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full"> 
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                            </div>
                            <div class="text-2xl font-medium leading-7 mt-6">{{$exp}}</div>
                            <div class="text-slate-500 mt-1 text-align center">EXPERIENCIA DE LA SEMANA</div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <br>
            @if (isset($leaderboard))
            <!-- BEGIN: leaderboard -->
            <div class="xl:px-6 mt-2.5">
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        TORNEO: MEJORES COORDINADORES DEL SERVICIO
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
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                        src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{Auth::user()->name}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{Auth::user()->total_exp}}</strong></p> </td>
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
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" width="40" height="40" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                                        src="{{route('obtenerImagen', ['nombreArchivo' => (Auth::user()->imagen_perfil != null) ? Auth::user()->imagen_perfil : 'false'])}}">
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{Auth::user()->name}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{Auth::user()->total_exp}}</strong></p> </td>
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



@endsection
