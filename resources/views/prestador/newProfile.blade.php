@extends('layouts/prestador-layout')

@section('subcontent')
<!-- BEGIN: Profile Cover -->
<div class="col-span-12">
        <div class="box intro-y px-3 pt-3 pb-5">
            <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                <div class="image-fit w-40 h-40 rounded-full border-4 border-white shadow-md overflow-hidden">
                
                @if(isset($user->image))
                    <img alt="{{$user->name.' '.$user->apellido}}" src="{{asset('build/assets/images/placeholders/avatar5.png')}}">
                @else
                    <img alt="{{$user->name.' '.$user->apellido}}" src="{{asset('build/assets/images/placeholders/'.$user->imagen_perfil)}}">
                @endif
                </div>
                    
                <div class="2xl:ml-5">
                    <h2 class="text-2xl mt-5 font-medium">
                        {{$user->name." ".$user->apellido}}
                    </h2>
                    <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i>{{$user->correo}}</div>
                    <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="align-left" class="w-4 h-4 mr-2"></i>Código: {{$user->codigo}} </div>
                    <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="map-pin" class="w-4 h-4 mr-2"></i>Centro: {{$user->centro}}</div>
                    <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="codesandbox" class="w-4 h-4 mr-2"></i>Carrera: {{$user->carrera}}</div>
                    @if(isset($user->horario))
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="clock" class="w-4 h-4 mr-2"></i>Turno: {{$user->horario}}</div>
                    @else
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="clock" class="w-4 h-4 mr-2"></i>Turno: No definido</div>
                    @endif
                    
                </div>
                <div class="mx-auto grid grid-cols-2 gap-y-2 md:gap-y-0 gap-x-5 h-20 mt-5 2xl:border-l 2xl:border-r border-dashed border-slate-200 px-10 mb-6 2xl:mb-0">
                    
                </div>
                <div class="flex 2xl:mr-10 mt-5">
                    <button class="btn btn-primary mr-2 w-32"> <i class="w-4 h-4 mr-2" data-lucide="user-plus"></i> Following </button>
                    <button class="btn btn-outline-secondary w-32"> <i class="w-4 h-4 mr-2" data-lucide="user-check"></i> Add Friend </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Cover -->
    <!-- BEGIN: Profile Content -->
    <div class="col-span-12 xl:col-span-8">
        
        <div class="box intro-y p-5 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium truncate text-base">Insignias Obtenidas</div>
                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i> 
            </div>
            <div class="grid grid-cols-12 gap-y-7">
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">SV</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">Svelte</div>
                        <div class="mt-1 text-slate-500">4,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">AN</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">Angular</div>
                        <div class="mt-1 text-slate-500">1,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">TW</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">TailwindCSS</div>
                        <div class="mt-1 text-slate-500">45,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">LV</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">Laravel</div>
                        <div class="mt-1 text-slate-500">4,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">RT</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">React</div>
                        <div class="mt-1 text-slate-500">1,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                    <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">BS</div>
                    <div class="ml-5">
                        <div class="font-medium text-base">Bootstrap</div>
                        <div class="mt-1 text-slate-500">45,468,655 followers</div>
                        <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2"> <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Content -->
@endsection