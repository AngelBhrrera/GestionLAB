@extends('layouts/admin-layout')

@section('subhead')


@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')

<div style="padding-left: 30px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card card-primary">
                    <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Asignar Actividades </h3>
                </div>
                <div class="card-body">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif
                    @csrf

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                            <div class="col-span-12 sm:col-span-8">
                                                <div class="form-group row justify-content-center"> <!-- Alinea el contenido horizontalmente -->
                                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                                    <div class="col-md-8"> <!-- Ancho ajustado para el contenido -->
                                                        <select class="select2" multiple>
                                                            @if (isset($prestadores)) 
                                                                @foreach ($prestadores as $prestador) 
                                                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                                                @endforeach 
                                                            @endif 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-6 sm:col-span-4 text-center">
                                                <div class="form-group row">
                                                    <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Categoría</label>
                                                    <div class="col-md-20">
                                                        <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarCategorias()">
                                                            <option value="">Selecciona una categoría</option>
                                                            @foreach ($categorias as $categoria)
                                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Subcategoría</label>
                                                    <div class="col-md-20">
                                                        <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria">
                                                            <option value="">Filtrar por subcategoria (Opcional)</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividades</label>
                                                    <div class="col-md-20">
                                                        <select class="form-control" id="actividades_l" name="actividades_l" required>
                                                            <option value="">Asignar actividad</option>
                                                            @foreach ($actividades as $actividad)
                                                            <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado</label>
                                                    <div class="col-md-20">
                                                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                                            <input name="horas" type="number" class="form-control" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                                            <input name="minutos" type="number" class="form-control" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-12"> <!-- Columna adicional para el botón -->
                                                <div class="form-group row justify-content-center"> <!-- Alinea el botón horizontalmente -->
                                                    <div class="col-md-4"></div> <!-- Columna vacía para alinear con los otros campos -->
                                                    <div class="col-md-8"> <!-- Ancho ajustado para el botón -->
                                                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div style="height: 45px;"></div>

@endsection

@section('script')


<script type="text/javascript">
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
        console.log(event);
    });
    dlb2.addEventListener('removed', function(event) {
        console.log(event);
    });


    function filtrarCategorias() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var actividadSelect = document.getElementById('tipo_actividad');
        var categoriaId = categoriaSelect.value;

        subcategoriaSelect.innerHTML = '<option value="">Filtrar por subcategoria (Opcional)</option>';
        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var subc = JSON.parse(xhr.responseText);

                    subc.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        subcategoriaSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las subcategorias');
                }
            }
        };
        xhr.open('GET', '{{ route('admin.obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }

    function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var categoriaId = categoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividades.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        actividadSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('obtenerActividades') }}?categoriaId=' + categoriaId);

        xhr.send();
    }
</script>
@endsection