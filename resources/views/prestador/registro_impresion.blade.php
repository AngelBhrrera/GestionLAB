@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a>Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresion</li>
@endsection


@section('subcontent')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
            <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Registro de Impresión </h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('register_imps') }}">
                    @csrf
                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="from-group" class="form-label">Impresora</label>
                            <select class="form-control" name="imp_id" id="imp_id">
                            @if (isset($imps))
                                <option id="" value="{{null}}" >Selecciona la impresora</option>
                                @foreach ($imps as $dato)
                                    <option id="{{$dato->id}}" value="{{$dato->id}}" >{{$dato->nombre }} </option>
                                @endforeach
                            @endif       
                            </select>          
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="from-group" class="form-label">Proyecto</label>
                            <select class="form-control" name="proyect" id="proyect">
                                <option id="null_proyect" value="{{null}}" >Selecciona el proyecto (omitir en caso de interno) </option>
                                @if (isset($proys))
                                    @foreach ($proys as $dato )
                                        <option id="{{$dato->id}}" value="{{$dato->titulo}}">{{$dato->titulo }} </option>
                                    @endforeach
                                @endif                 
                            </select>
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Nombre del modelo .stl</label>
                            <input type="text"  class="form-control @error('model') is-invalid @enderror"
                                name="model" id="model" value="{{old('model')}}">
                            @error('model')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Color</label>
                            <input type="text"  class="form-control"
                                name="color" id="color" value="{{old('color')}}">
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Piezas</label>
                            <input  type="text" class="form-control"
                                name="pieces" id="pieces" value="{{old('pieces')}}">
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Peso</label>
                            <input  type="text" class="form-control"
                                name="weight" id="weight" value="{{old('weight')}}">
                        </div>

                        <div class="form-group row">
                            <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado</label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                        <input name="horas" type="number" class="form-control" placeholder="Horas" min="01" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                        <input name="minutos" type="number" class="form-control" placeholder="Minutos" min="01" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                                    </div>
                                </div>
                        </div>

                        <br>

                        <div class="col-md-12 text-right">
                            <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                                Registrar impresion
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
