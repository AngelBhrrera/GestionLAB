@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresora</li>
@endsection

@section('subcontent')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gestion de Impresoras</h3>
                </div>
                <div class="card-body">

                    <form class="from-prevent-multiple-submits" method="POST" action="{{ route('admin.make_print') }}"  enctype="multipart/form-data">

                    @csrf
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="Ingresar el nombre identificador de la impresora">
                            <label for="">Nombre</label>
                            <input type="name" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" id="nombre" value="{{old('nombre')}}">
                            <small id="Help" class="form-text text-muted">Ingresar el nombre identificador de la impresora</small>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" data-toggle="tooltip" data-placement="top">
                            <label for="">Marca</label>
                            <input type="text"  class="form-control @error('nombre') is-invalid @enderror"
                                name="mark" id="mark" value="{{old('mark')}}">
                            @error('mark')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-3" class="form-label">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" >
                                <option selected id= null value= null>Selecciona un tipo de impresora</option>
                                <option id="1" value='Filamento'>Filamento</option>
                                <option id="2" value='Resina'>Resina</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-right">
                            <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits">
                                Enviar
                            </button>
                        </div>

                    </form>

                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="impresoras">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">No. de Impresora</a>
                                @foreach ($impresoras as $impresora)
                                    <p id="leaderBoard" class="nav-link">{{$impresora->nombre}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Marca</a>
                                @foreach ($impresoras as $impresora)
                                    <p id="leaderBoard" class="nav-link">{{$impresora->marca}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Tipo</a>
                                @foreach ($impresoras as $impresora)
                                    <p id="leaderBoard" class="nav-link">{{$impresora->tipo}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Ultimo uso</a>
                                @foreach ($impresoras as $impresora)
                                    <p id="leaderBoard" class="nav-link">{{$impresora->ultimo_uso}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Estado</a>
                                @foreach ($impresoras as $impresora)
                                    <p id="leaderBoard" class="nav-link">{{$impresora->estado}}</p>
                                @endforeach
                            </li>

                        </ul>
                    </div>

            </div>

        </div>

    </div>

</div>

@endsection

