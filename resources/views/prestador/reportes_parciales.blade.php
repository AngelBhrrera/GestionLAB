@extends('layouts/prestador-layout')

@section('breadcrumb')
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reportes</li>
@endsection

@section('subcontent')
    <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
        @if (session('success'))
            <h6 class="alert alert-success" id="success">{{session('success')}}</h6>      
        @endif

        @if (session('warning'))
            
            <h6 class="alert alert-warning" id="warning">{{session('warning')}}</h6>  
        @endif

        @error('reporte_parcial')
            <h6 class="alert alert-danger" id="error">{{$message}}</h6>
        @enderror

        @error('tipo_reporte')
            <h6 class="alert alert-danger" id="error">{{$message}}</h6>
        @enderror
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Reportes
        
        </h2>
        
        <div class="text-center">
            <a href="javascript:;" data-tw-toggle="modal" 
            data-tw-target="#basic-modal-preview" class="btn btn-primary">
            <i class="w-4 h-4 mr-2" data-target="#imagenModal" data-toggle="modal" data-lucide="upload"></i>Subir archivo</a>
        </div>
    </div>
    <div class="box grid grid-cols-12 mt-5">
        <!-- BEGIN: Inbox Content -->
        <div class="inbox col-span-12 xl:col-span-8 2xl:col-span-10">
            <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 border-b border-slate-200/60 dark:border-darkmode-400 mb-4 pb-5">
            Reportes guardados: {{ count($reportes) }}
            </div>
            @if (count($reportes)==0)
                <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 ">
                    No hay reportes parciales para mostrar</div>
            @endif
            <div class="px-5 pb-4 grid grid-cols-12 gap-3 sm:gap-6 border-b border-slate-200/60">
                @foreach ($reportes as $reporte)
                        <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 2xl:col-span-2">
                            <div class="file box border-slate-200/60 dark:border-darkmode-400 shadow-none rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                <div class="absolute left-0 top-0 mt-3 ml-3"></div>
                                <a href="{{route('visualizar', ['nombreArchivo' => $reporte->nombre_reporte])}}" target="_blank"class="w-3/5 file__icon file__icon--file mx-auto">
                                    <div class="file__icon__file-name">PDF</div>
                                </a>
                                <a href="{{route('visualizar', ['nombreArchivo' => $reporte->nombre_reporte])}}" target="_blank">
                                    <div class="block font-small mt-4 text-center">{{$reporte->tipo}}<br>{{$reporte->fecha_subida}}<br>
                                    <div class="
                                    @if($reporte->estado == 'pendiente')
                                        alert alert-warning
                                    @elseif($reporte->estado == 'autorizado')
                                        alert alert-success
                                    @else
                                        alert alert-danger
                                    @endif"
                                    >{{"Estado: ".ucfirst($reporte->estado)}} </div>
                                </div>
                                    
                                </a>
                                
                                <div class="text-slate-500 text-xs text-center mt-0.5"></div>
                                <div class="absolute top-0 right-0 mr-2 mt-3 dropdown ml-auto">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                                        <i data-lucide="more-vertical" class="w-5 h-5 text-slate-500"></i>
                                    </a>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <a href="{{route('descargar_reporte', ['nombreArchivo' => $reporte->nombre_reporte])}}" class="dropdown-item" download>
                                                    <i data-lucide="download" class="w-4 h-4 mr-2"></i> Descagar
                                                </a>
                                            </li>
                                            @if ($reporte->estado == "rechazado" || $reporte->estado == "pendiente")
                                            <li>
                                                <a href="{{route('eliminarReporte', [$reporte->id])}}" onclick="return confirmarEliminar()" class="dropdown-item">
                                                    <i data-lucide="trash" class="w-4 h-4 mr-2"></i> Eliminar
                                                </a>
                                            </li>
                                            @endif
                                            
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
        <!-- END: Inbox Content -->
    </div>
    <br>
    <div>
        <h2 class="text-lg font-medium mr-auto">Aquí puedes subir y visualizar tus reportes. Sigue los pasos para subir tus documentos en orden.</h2>
        <div class="alert @if($orden) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">1. Orden de pago con comprobante.</div>
            </div>
            <div class="mt-3">Orden de pago generada en la plataforma de servicio social con su comprobante correspondiente.</div>
        </div>
        <div class="alert @if($imss) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">2. Constancia del IMSS</div>       
            </div>
            <div class="mt-3">Constancia de vigencia de derechos que puedes obtener en la página del Instituto Mexicano del Seguro Social (IMSS).</div>
        </div>
        <div class="alert @if($oficio) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">3. Oficio de comisión</div>
            </div>
            <div class="mt-3">Documento que te entregan en la unidad de servicio social para dar comenzar a tu servicio.</div>
        </div>
        <div class="alert @if($reporte1) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">4. Primer reporte parcial</div>
                
            </div>
            <div class="mt-3"> Primer reporte con 160 horas que realizas en la plataforma de servicio social de la udg.</div>
        </div>
        <div class="alert @if($reporte2) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">5. Segundo reporte parcial</div>
                
            </div>
            <div class="mt-3">Segundo reporte con 160 horas (320 en total) que realizas en la plataforma de servicio social de la udg.</div>
        </div>
        <div class="alert @if($reporte3) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">6. Tercer reporte parcial</div>
                
            </div>
            <div class="mt-3">Tercer reporte con 160 horas (480 en total) que realizas en la plataforma de servicio social de la udg.</div>
        </div>
        <div class="alert @if($final) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">7. Reporte final de servicio</div>
                
            </div>
            <div class="mt-3">Reporte que realizas en la plataforma una vez que completaste las 480 horas de servicio social.</div>
        </div>
        <div class="alert @if($finalDep) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">8. Reporte final de la dependencia</div>
            </div>
            <div class="mt-3">Reporte final generado por la dependencia a la que perteneces.</div>
        </div>
        <div class="alert @if($carta) alert-secondary @else alert-success-soft @endif show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">9. Carta de recomendación (sólo prestadores destacados)</div>
            </div>
            <div class="mt-3">Carta otorgada a los prestadores de servicio destacados que tengan menos de 3 faltas 
                y hayan realizado al menos 2 actividades por cada día de servicio.</div>
        </div>
    </div>
    <!-- Modal para subir archivo -->
    <div id="blank-modal" class="p-5">
        <div class="preview">
            <!-- END: Modal Toggle -->
            <!-- BEGIN: Modal Content -->
            <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-10 text-center">
                            <h2 class="text-2xl mt-5 font-medium">
                                Subir un nuevo archivo
                            </h2>
                            <form action="{{ route('subirReporte') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                        <div class="overflow-x-auto sm:w-full">
                                            <div class="text-center pt-5">
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
                                                    <input type="file"  id="reporte_parcial" name="reporte_parcial"  class="form-control-file" style="display: none;"  accept="application/pdf"/>
                                                        <span class="form-file-span pl-5">Selecciona un archivo</span>
                                                </div>
                                                </label>
                                            </div>
                                            </div>

                                        <select class="form-select mt-2 sm:mr-2" aria-label="Default select example" name="tipo_reporte" id="tipo_reporte">
                                            <option value="{{null}}">Seleccione un tipo reporte</option>
                                            
                                            @if($orden)
                                                <option value="Orden de pago">Orden de pago</option>
                                            @endif
                                            @if($imss)
                                                <option value="Constancia IMSS">Constancia IMSS</option>
                                            @endif
                                            @if($oficio)
                                                <option value="Oficio de comision">Oficio de comisión</option>
                                            @endif
                                            @if ($reporte1)
                                                <option value="Reporte parcial 1">Reporte parcial 1</option>
                                            @endif
                                            @if ($reporte2)
                                                <option value="Reporte parcial 2">Reporte parcial 2</option>
                                            @endif
                                            @if ($reporte3)
                                                <option value="Reporte parcial 3">Reporte parcial 3</option>
                                            @endif
                                            
                                            @if ($final)
                                                <option value="Reporte final">Reporte final</option>
                                            @endif
                                            @if ($finalDep)
                                                <option value="Reporte final dependencia">Reporte final dependencia</option>
                                            @endif
                                            @if ($carta)
                                                <option value="Carta recomendacion">Carta de recomendación</option>
                                            @endif

                                            
                                        </select>
                                        
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
@endsection

<script>
    setTimeout(function(){

        document.getElementById("alerta").style.display="none";

    }, 4000);

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

    

    function confirmarEliminar() {
        // Muestra un cuadro de confirmación
        var confirmacion = confirm("¿Estás seguro de que deseas eliminar este reporte parcial?");

        // Si el usuario hace clic en "Aceptar", continúa con la eliminación
        return confirmacion;
    }

</script>
