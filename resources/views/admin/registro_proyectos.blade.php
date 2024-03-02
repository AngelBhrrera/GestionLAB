@extends('layouts/admin-layout')
@section('subhead')

<link rel="stylesheet" href="{{asset('build/assets/css/registro_proyecto_actividadess.css')}}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
<li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
                    @if (session('success'))
                        <div class="alert alert-success w-full px-4">{{session('success')}}</div>
                    @endif
                    @if(session('warning'))
                        <div class="alert alert-warning w-full px-4">{{session('warning')}}</div>
                    @endif
                    @error('nombre')
                        <div class="alert alert-danger w-full px-4">{{$message}}</div>
                    @enderror
                        </div>
                </div>
            </div>
            <div class="card card-primary" id="crear_proyecto">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear Nuevo Proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10" id="crear_proyecto_2">
                <form id="enviar" method="POST" action="{{route('admin.make_proy')}}">
                    @csrf
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif

                    <div class="form-group row" >
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Titulo del proyecto</label>
                        <div class="col-md-8">
                            <textarea id="t_proyecto" name="t_nombre" type="text" class="form-control"  placeholder="Ingresa el titulo del proyecto" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="tipo_categoria">Seleccionar area</label>
                            <select class="form-control" id="area" name="area" required>
                                <option value="">Selecciona el area de trabajo donde estará principalmente el proyecto</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-check mt-2" >
                        <input id="checkbox" name="particular" class="form-check-input" type="checkbox" checked>
                        <label class="form-check-label" for="checkbox-switch-1">Particular</label>
                    </div>
                    <div class="container" id="card_duelist_box">
                        <div class="row justify-content-center">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                            <div class="col-md-8"> 
                                <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                    @if (isset($prestadores))
                                    @foreach ($prestadores as $prestador)
                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <small id="Help" class="form-text text-muted">Selecciona a los prestadores para realizar la actividad</small>
                        </div>
                        <button id="boton_crear" type="submit" class="btn btn-primary from-prevent-multiple-submits">Crear proyecto</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>


<div style="height: 45px;"></div>

@endsection

@section('script')

    <script type="text/javascript">

        document.getElementById('enviar').addEventListener('submit', function(event) {

            const prestadorSelect = document.getElementById('prestadores_seleccionados');
            const check = document.getElementById('checkbox');

            if (prestadorSelect.selectedOptions.length === 0) {
                
                if(check.checked){
                    event.preventDefault();
                    alert('Por favor, selecciona al menos un prestador.');
                }        
            }
        });

        let dlb2 = new DualListbox('.select2', {
            availableTitle: 'Prestadores disponibles',
            selectedTitle: 'Prestadores seleccionados',
            addButtonText: '🡺',
            removeButtonText: '🡸',
            addAllButtonText: '>>',
            removeAllButtonText: '<<',
            searchPlaceholder: 'Buscar prestadores'
        });
        dlb2.addEventListener('added', function(event) {

        });
        dlb2.addEventListener('removed', function(event) {

        });

    </script>

@endsection