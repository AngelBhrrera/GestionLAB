@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item">Actividades</li>
    <li class="breadcrumb-item active" aria-current="page">Ver detalles de proyecto</li>
@endsection

@section('subcontent')


    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl font-medium leading-none mt-3" style="padding-top: 20px; padding-bottom: 20px;">
            Detalles de Actividad
        </h2>
    </div>

@endsection

@section('script')
    
@endsection