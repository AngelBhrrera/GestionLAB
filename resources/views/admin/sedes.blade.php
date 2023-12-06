@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')
    
    <div class="intro-y box p-5">
        <h2 class="text-2xl mt-5 font-medium">Horario</h2>
        <select class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" id="sede" onchange="sedeNav()">
            @if (isset($sede))
                <option id="sede" value="{{null}}" {{isset($dV[0]->sede) ? $dV[0]->sede == null ? 'selected="selected"' : '' : ''}}>Selecciona una sede</option>
                @foreach ($sede as $dato )
                    <option id="{{$dato->nombre_Sede}}" value="{{$dato->id_Sede}}" {{old('sede') == $dato->id_Sede ? 'selected="selected"' : '' }}>{{$dato->nombre_Sede }} </option>
                @endforeach
            @endif
        </select>
    </div>
    
    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl mt-5 font-small">Añadir una sede</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                @if (session('success'))
                    <h6 class="alert alert-success">{{session('success')}}</h6>           
                @endif

                @error('nombre')
                    <h6 class="alert alert-danger">{{$message}}</h6>
                @enderror
            </div>
        </div>
        
        <form action="{{route('admin.nuevaSede')}}" method="POST">
            @csrf
            <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                <p>Nombre de la sede</p>
                <input required id="nombreSede" type="text" class="form-control" name="nombreSede" placeholder="Nombre" style="width: 40%">
            </div>
            <br>
            <button class="btn btn-primary">Crear</button>
        </form>
    </div>
    
  

@endsection
