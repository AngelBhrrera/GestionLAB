@extends('layouts/prestador-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
        </ol>
    </nav>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Cover -->
<div class="col-span-12">
        <div class="box intro-y px-3 pt-3 pb-5">
            <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                <div class="image-fit w-40 h-40 rounded-full border-4 border-white shadow-md overflow-hidden">
                
                @if(!isset($user->imagen_perfil))
                    <img alt="{{$user->name.' '.$user->apellido}}" src="{{asset('build/assets/images/placeholders/avatar5.png')}}">
                @else
                    <img alt="{{$user->name.' '.$user->apellido}}" src="{{asset('build/assets/images/placeholders/userImg/'.$user->imagen_perfil)}}">
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
                    @if(isset($user->sede))
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="clock" class="w-4 h-4 mr-2"></i>Sede: {{$user->sede}}</div>
                    @else
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i class="w-4 h-4 mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-school"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></i>Sede: No definida</div>
                    @endif
                    
                </div>
                <div class="flex 2xl:mr-10 mt-5"></div>
                <div class="flex 2xl:mr-10 mt-5"></div>
                <div class="flex 2xl:mr-10 mt-5">
                    <div class="box intro-y p-5 mt-5">
                        <h2 class="text-2xl  font-medium">{{$nivel->descripcion}}</h2>
                        <img width="100" heigth="50"src="{{asset('build/assets/'.$nivel->ruta)}}" alt="Medalla">
                        
                        <h2 class="text-2xl  font-medium">
                            Nivel: {{$nivel_str}}
                            Xp: {{ $user->experiencia ?? '0' }}
                        </h2>
                    </div>
                </div>
                <div class="flex 2xl:mr-10 mt-5">
                    <button class="btn btn-primary mr-2 w-40"> <i class="w-4 h-4 mr-2" data-target="#imagenModal" data-toggle="modal" data-lucide="image-plus"></i> Cambiar imagen</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Cover -->
    <!-- Modal para cambiar la imagen -->
    <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imagenModalLabel">Cambiar imagen de perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('cambiarImagenPerfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="imagen_perfil">Imagen de perfil</label>
                <input type="file" class="form-control-file" id="imagen_perfil" name="imagen_perfil">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- BEGIN: Profile Content -->
    <div class="col-span-12 xl:col-span-8">
        
        <div class="box intro-y p-5 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium truncate text-base">Insignias Obtenidas</div>
                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i> 
            </div>
            <div class="grid grid-cols-12 gap-y-7">
                @foreach($todasMedallasUsuario as $medalla)
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16  bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium"><img width="100" heigth="50" src="{{asset('build/assets/'.$medalla->ruta)}}"alt="Medalla"></div>
                        <div class="ml-5">
                            <div class="font-medium text-base">{{$medalla->descripcion}}</div>
                            <div class="mt-1 text-slate-500">Obtenida en el nivel {{$medalla->nivel}}</div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END: Profile Content -->
@endsection