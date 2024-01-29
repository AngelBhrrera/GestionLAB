@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Ver reportes parciales</li>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col  mt-8 ml-5">
        <h2 class="text-lg font-medium mr-auto">Reportes parciales</h2>
        <div class="grid grid-cols-12 gap-6 mt-5 mb-5">
            <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
                @if (session('success'))
                    <h6 class="alert alert-success">{{session('success')}}</h6>     
                @endif
                
                @if(session('warning'))
                    <h6 class="alert alert-warning">{{session('warning')}}</h6>  
                @endif

                @error('nombre')
                    <h6 class="alert alert-danger">{{$message}}</h6>
                @enderror
            </div>
        </div>
        <form action="{{route('admin.busqueda_reportes_parciales')}}">
            @csrf
            <div class="w-[350px] relative mr-5">
                <input name="busqueda" type="text" class="form-control pl-10" placeholder="Buscar por código">
                <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
            </div>
            <br>
            <div class="w-[350px] relative">
                <button class="btn btn-primary">
                    Buscar
                </button>
            </div>
        </form>
    </div>
    
    <div class="box grid grid-cols-12 mt-5 ml-5 mr-5">
        <!-- BEGIN: Inbox Content -->
        <div class="inbox col-span-12 xl:col-span-8 2xl:col-span-10">
            <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 border-b border-slate-200/60 dark:border-darkmode-400 mb-4 pb-5">
            @if(isset($reportes))
                Reportes parciales guardados: {{ count($reportes) }}
            @else
                Reportes parciales guardados: -
            @endif
            <br>
            @if(isset($codigo))
                Mostrando registros con código: {{$codigo}}
            @endif
            </div>
           

            @if(!isset($reportes) || count($reportes)==0)
                <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 ">
                    No hay reportes parciales para mostrar
                </div>
            @endif
            <div class="px-5 pb-4 grid grid-cols-12 gap-3 sm:gap-6 border-b border-slate-200/60">
                <?php $num_reporte = 0?>
                @if(isset($reportes))
                    @foreach ($reportes as $reporte)
                            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 2xl:col-span-2">
                                <div class="file box border-slate-200/60 dark:border-darkmode-400 shadow-none rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                    <div class="absolute left-0 top-0 mt-3 ml-3"></div>
                                    <a href="{{asset('storage/reportes_parciales/'. $reporte->nombre_reporte)}}" target="_blank"class="w-3/5 file__icon file__icon--file mx-auto">
                                        <div class="file__icon__file-name">PDF</div>
                                    </a>
                                    <a href="{{asset('storage/reportes_parciales/'. $reporte->nombre_reporte)}}" target="_blank">
                                        <div class="block font-medium mt-4 text-center">{{$reporte->tipo}}<br>{{$reporte->fecha_subida}}</div>
                                    </a>
                                    
                                    <div class="text-slate-500 text-xs text-center mt-0.5"></div>
                                    <div class="absolute top-0 right-0 mr-2 mt-3 dropdown ml-auto">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                                            <i data-lucide="more-vertical" class="w-5 h-5 text-slate-500"></i>
                                        </a>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a href="{{asset('storage/reportes_parciales/'. $reporte->nombre_reporte)}}" class="dropdown-item" download>
                                                        <i data-lucide="download" class="w-4 h-4 mr-2"></i> Descagar
                                                    </a>
                                                </li>
                                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- END: Inbox Content -->
        
    </div>
@endsection

<script>
    setTimeout(function(){

    document.getElementById("alerta").style.display="none";

    }, 4000);
</script>