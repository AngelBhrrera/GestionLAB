@extends('layouts/prestador-layout')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear actividad</li>
@endsection

@section('subcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear nueva actividad </h3>
            </div>

            <div class="card-body pl-10 pr-10">

                <form method="POST" action="{{route('make_act')}}">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif

                    <input id="id" name="id" type="hidden" value="{{!isset($actm[0]->id) ? old('id') : $actm[0]->id }}">
                    <input name="TipoOriginal" type="hidden" value="{{isset($actm[0]->tipo) ? $actm[0]->tipo : old('TipoOriginal') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la actividad</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{isset($actm[0]->nombre_act) ? $actm[0]->nombre_act : old('nombre') }}" required autocomplete="nombre" autofocus>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Categoría</label>
                        <div class="col-md-6">
                        <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Subcategoría</label>
                        <div class="col-md-6">
                            <select class="form-control" id="tipo_subcategoria" name="tipo_subcategoria">
                                <option value="">Selecciona una subcategoría</option>
                                @foreach ($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="tipo_actividad" class="text-center">Tipo de actividad</label>
                        <div class="row text-center">
                            <div class="col">
                                <select class="form-control" name="tipo_actividad">
                                    <option value="{{null}}">Selecciona un tipo de actividad</option>
                                    <option value="generica">Genérica</option>
                                    <option value="particular">Particular</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                        <label for="recursos">Recursos necesarios - entradas </label>
                            <textarea id="recursos" type="text" class="form-control" name="recursos"></textarea>

                            @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción del trabajo a realizar - procesos </label>

                        <div class="col-md-6">
                            <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required>@if(isset($actm)){{$actm[0]->descripcion}}@endif</textarea>

                            @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="resultados" class="col-md-4 col-form-label text-md-right">Objetivos, resultados que se esperan - salidas </label>

                        <div class="col-md-6">
                            <textarea id="resultados" type="text" class="form-control" name="resultados" required></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado (TEC)</label>
                            <div class="col-md-6">
                                    <input name="horas" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                    <input name="minutos" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                            </div>
                    </div>


                    <div class="col-md-12 text-right">
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var subcategoriaSelect = document.getElementById('tipo_subcategoria');
        var categoriaId = categoriaSelect.value;

        subcategoriaSelect.innerHTML = '<option value="">Selecciona una subcategoria (Opcional)</option>';

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
                        subcategoriaSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };
        xhr.open('GET', '{{ route('obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }
</script>
@endsection