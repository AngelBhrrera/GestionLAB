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

        <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Cover -->
<div class="col-span-12">
        <div class="box intro-y px-3 pt-3 pb-5">
            <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                <div class="image-fit w-40 h-40 rounded-full border-4 border-white shadow-md overflow-hidden">
                    <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" 
                    src="{{route('obtenerImagen', ['nombreArchivo' => ($user->imagen_perfil != null) ? $user->imagen_perfil : 'false'])}}">
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
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="building" class="w-4 h-4 mr-2"></i>Sede: {{$sede->nombre_sede}}</div>
                    @else
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="building" class="w-4 h-4 mr-2"></i>Sede: No definida</div>
                    @endif
                    @if(isset($user->emergencia))
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="radio" class="w-4 h-4 mr-2"></i>Emergencias: {{$user->emergencia}}</div>
                    @endif    
                    @if(isset($user->cumpleanios))
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start"> <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>Cumpleaños: {{$user->cumpleanios}}</div>
                    @endif
                    
                </div>
                <div class="flex 2xl:mr-10 mt-5"></div>
                <div class="flex 2xl:mr-10 mt-5"></div>
                <div class="flex 2xl:mr-10 mt-5">
                    <div class="box intro-y p-5 mt-5">
                        <h2 class="text-2xl  font-medium">{{$descripcion_medalla}}</h2>
                        <img width="100" heigth="50"src="{{asset('build/assets/'.$medalla)}}" alt="Medalla">
                        
                        <h2 class="text-2xl  font-medium">
                            Nivel: {{$nivel_str}}
                            Xp: {{ $user->experiencia ?? '0' }}
                        </h2>
                    </div>
                </div>
                <div class="flex 2xl:mr-10 mt-5">
                    <!-- BEGIN: Modal Toggle -->
                    <div class="text-center">
                        <a href="javascript:;" data-tw-toggle="modal" 
                        data-tw-target="#basic-modal-preview" class="btn btn-primary">
                        <i class="w-4 h-4 mr-2" data-target="#imagenModal" data-toggle="modal" data-lucide="image-plus"></i> Cambiar imagen</a>
                        <a href="javascript:;" data-tw-toggle="modal" 
                        data-tw-target="#basic-modal-preview2" class="btn btn-primary">
                        <i class="w-4 h-4 mr-2" data-target="#datoModal" data-toggle="modal" data-lucide="user-plus"></i>Agregar datos complementarios</a>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Cover -->

    <!-- Modal para cambiar la imagen -->
    <div id="blank-modal" class="p-5">
        <div class="preview">
            <!-- END: Modal Toggle -->
            <!-- BEGIN: Modal Content -->
            <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-10 text-center">
                            <h2 class="text-2xl mt-5 font-medium">
                                Cambiar imagen de perfil
                            </h2>
                            <form action="{{ route('cambiarImagenPerfil') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                        <div class="overflow-x-auto sm:w-full">
                                            <div class="text-center pt-5">
                                                <div class="overflow-x-auto sm:w-full">
                                                    <label class="form-block-input btn-primary" style="
                                                        border-radius: 15px;
                                                        font-size: 14px;
                                                        font-weight: 600;
                                                        display: inline-block;
                                                        transition: all .5s;
                                                        cursor: pointer;
                                                        padding: 15px 40px !important;
                                                        text-transform: uppercase;
                                                        width: fit-content;
                                                        text-align: center;
                                                        " >
                                                        <div style="display:flex;">
                                                            <i data-lucide="image" height="20" width="20"></i>
                                                            <input type="file"  id="imagen_perfil" name="imagen_perfil" class="form-control-file" style="display: none;"  accept="image/jpg, image/jpeg, image/png"/>
                                                            <span class="form-file-span pl-5">Selecciona una imagen</span>
                                                        </div>
                                                </div>
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" id="cancelar" data-tw-dismiss="modal" class="btn btn-danger" data-dismiss="#basic-modal-preview">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
        </div>
    </div>
    <!-- END modal cambiar imagen-->

    <!-- Modal para agregar otors datos -->
    <div id="blank-modal" class="p-5">
        <div class="preview">
            <!-- END: Modal Toggle -->
            <!-- BEGIN: Modal Content -->
            <div id="basic-modal-preview2" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-10 text-center">
                            <h2 class="text-2xl mt-5 font-medium">
                                Agregar datos complementarios
                            </h2>
                            <form action="{{ route('datosComplementarios') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="overflow-x-auto sm:w-full">
                                            <div class="text-center pt-5">
                                                <div class="overflow-x-auto sm:w-full">
                                                    <div class="intro-y col-span-12 sm:col-span-6">
                                                        <h2 class="text-2xl mt-5 font-small">Cumpleaños:</h2><br>
                                                        <input id="cumple" value="{{ isset($user->cumpleanios) ? $user->cumpleanios : '' }}" type="date" class="form-control" name="cumple" placeholder="Ingresa tu fecha de cumpleaños" style="width: 200px">
                                                    </div>
                                                    <div class="intro-y col-span-12 sm:col-span-6">
                                                        <h2 class="text-2xl mt-5 font-small">Numero emergencias:</h2><br>
                                                        <input id="emerg" type="text" class="form-control" value="{{ isset($user->emergencia) ? $user->emergencia : '' }}"  name="emerg" placeholder="Ingresa un numero al que acudir en caso de emergencia" style="width: 200px" maxlength="10">
                                                    </div>
                                                    <div class="intro-y col-span-12 sm:col-span-6">
                                                        <h2 class="text-2xl mt-5 font-small">Aficiones:</h2><br>
                                                        <textarea id="aficiones" class="form-control" name="aficiones" placeholder="Ingresa aficiones tuyas separadas por coma" style="width: 200px">{{ isset($user->aficiones) ? $user->aficiones : '' }}</textarea>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" id="cancelar" data-tw-dismiss="modal" class="btn btn-danger" data-dismiss="#basic-modal-preview">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
        </div>
    </div>
    <!-- END modal agregar datos complementarios-->

    <!-- BEGIN: Profile Content -->
    <div class="box intro-y p-5 mt-5">
        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
            <div class="font-medium truncate text-base">Aficiones</div>
        </div>
        <div class="flex flex-wrap">
            @if(isset($user->aficiones))
                @foreach(explode(',', $user->aficiones) as $aficion)
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">{{ $aficion }}</div>
                @endforeach
            @endif
        </div>
    </div>
        
    @if ($filtro->gamificacion == 1)
    
    <div class="col-span-12 xl:col-span-8">
        
        <div class="box intro-y p-5 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium truncate text-base">Niveles Obtenidos</div>
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
        <div class="box intro-y p-5 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium truncate text-base">Insignias Obtenidas</div>
            </div>
            <div class="grid grid-cols-12 gap-y-7">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="ml-5">
                            <p>No has obtenido ninguna insignia</p>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Content -->
    @endif

@endsection
@section('script')
    <script>
        
        document.addEventListener('DOMContentLoaded', () => {
            // Obtener inputs tipo file
            // Asignar eventos a inputs
            const fileInputs = document.querySelectorAll('input[type=file]');
            const fileButtons = document.querySelectorAll('.form-file-button');
            fileInputs[0].addEventListener('change', fileChange);
            // Agrega el evento de clic al botón de cancelar
            
        });

        // Cambios en inputs
        function fileChange(e) {
            let input = e.target;
            let spanBlock = e.target.closest('label').querySelector('.form-file-span');
            // Limpiar contenedor
            spanBlock.innerHTML = '';
            // Recorrer archivos para agregarlos al contenedor
            Array.from(input.files).forEach(file => {
                spanBlock.innerHTML += `<span class="form-files">${file.name}</span>`;
            });
        }
        // Clics en botones
        function fileClick(e) {
            // Desde el botón se obtiene el input y se abre la ventana para seleccionar archivos
            let input = e.target.closest('label').querySelector('input');
            input.click();
        }
    </script>
@endsection