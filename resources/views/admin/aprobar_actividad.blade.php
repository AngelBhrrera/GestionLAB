@extends('layouts/admin-layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="">Aprobar</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividad</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Aprobar actividad de prestador </h3>
            </div>

            <div class="card-body pl-10 pr-10">

                <form method="POST" action="{{route('admin.actTEC')}}">
                    <input type="hidden" name="id" value="{{ $actividad->id }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la actividad</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control" name="nombre" value= "{{ $actividad->titulo }}" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Categoría</label>
                        <div class="col-md-6">
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">
                            @if (isset($categ))    
                            <option selected value= "{{ $actividad->id_categoria }}">{{ $categ }} </option>
                            @endif
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
                                @if (isset($subcateg))    
                                    <option selected value= "{{ $actividad->id_subcategoria }}">{{ $subcateg }} </option>
                                @endif
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
                        <label for="recursos">Recursos necesarios - entradas</label>
                            <textarea id="recursos" type="text" class="form-control" name="recursos" > {{$actividad->recursos}} </textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción del trabajo a realizar - procesos</label>

                        <div class="col-md-6">
                            <textarea id="descripcion" type="text" class="form-control" name="descripcion" > {{$actividad->descripcion}} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="resultados" class="col-md-4 col-form-label text-md-right">Objetivos, resultados que se esperan - salidas</label>

                        <div class="col-md-6">
                            <textarea id="resultados" type="text" class="form-control" name="resultados" > {{$actividad->objetivos}} </textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado (TEC)</label>
                            <div class="col-md-6">
                                    <input name="horas" type="number" class="form-control sm:w-56" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                    <input name="minutos" type="number" class="form-control sm:w-56" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                            </div>
                            <small id="Help" class="form-text text-muted">Ingresa el tiempo que crees tardar en completar la actividad</small>
                    </div>


                    <div class="col-md-12 text-right">
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Aprobar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="height: 45px;"></div>
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
        xhr.open('GET', '{{ route('admin.obtenerSubcategorias') }}?categoriaId=' + categoriaId);
        xhr.send();
    }
</script>
@endsection