@extends('layouts/prestador-layout')
@section('content')


@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active">Actividades</li>
            <li class="breadcrumb-item active" aria-current="page">Detalle Actividad</li>
        </ol>
    </nav>
    <link rel="stylesheet" href="{{asset('build/assets/css/detalles_actividad.css')}}">
@endsection

@section('subcontent')
<div class="container" id="contenedor-actividades">
    <h1 class="text-center" id="detalle_titulo">Detalle Actividad</h1>
    <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
    <div id="actividad">
        <ul>
                <h1 id="titulo_actividad">{{$detalle->titulo}}</h1>
                <li id="categorias"><strong>Categoría:</strong> {{ $detalle->nombre_categoria }}</li>
                <li id="categorias"><strong>Subcategoría:</strong> {{ $detalle->nombre_subcategoria }}</li>
                <li id="categorias"><strong>Tipo:</strong> {{ $detalle->tipo }}</li>
                <li id="categorias"><strong>Descripción:</strong> {{ $detalle->descripcion }}</li>
                <li id="categorias"><strong>Objetivos:</strong>
                    <ul>
                        @php
                            $objetivos = explode(',', $detalle->objetivos);
                        @endphp
                        @foreach ($objetivos as $objetivo)
                            <li id="recursos"><input type='checkbox'> {{ $objetivo }}</li>
                        @endforeach
                    </ul>
                </li>
                <li id="recursos"><strong>Recursos:</strong>
                    <ul>
                        @php
                            $recursos = explode(',', $detalle->recursos);
                        @endphp
                        @foreach ($recursos as $recurso)
                            <li id="recursos"><input type='checkbox'> {{ $recurso }}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
    </div>
</div>
@endsection


@section('script')

@endsection
