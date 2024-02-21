@extends('layouts/admin-layout')
@section('content')


@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
            <li class="breadcrumb-item active">Actividades</li>
            <li class="breadcrumb-item active" aria-current="page">Detalle Actividad</li>
        </ol>
    </nav>
@endsection

@section('subcontent')
<div class="container">
    <h1 class="text-center">Detalle Actividad</h1>
    <div class="text-center mx-auto" style="padding-left: 1.5px;" id="players"></div>
    <ul>
            <li><strong>Categoría:</strong> {{ $detalle->nombre_categoria }}</li>
            <li><strong>Subcategoría:</strong> {{ $detalle->nombre_subcategoria }}</li>
            <li><strong>Título:</strong> {{ $detalle->titulo }}</li>
            <li><strong>Tipo:</strong> {{ $detalle->tipo }}</li>
            <li><strong>Recursos:</strong>
                <ul>
                    @php
                        $recursos = explode(',', $detalle->recursos);
                    @endphp
                    @foreach ($recursos as $recurso)
                        <li><input type='checkbox'> {{ $recurso }}</li>
                    @endforeach
                </ul>
            </li>
            <li><strong>Descripción:</strong> {{ $detalle->descripcion }}</li>
            <li><strong>Objetivos:</strong>
                <ul>
                    @php
                        $objetivos = explode(',', $detalle->objetivos);
                    @endphp
                    @foreach ($objetivos as $objetivo)
                        <li><input type='checkbox'> {{ $objetivo }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
</div>
@endsection


@section('script')

@endsection
