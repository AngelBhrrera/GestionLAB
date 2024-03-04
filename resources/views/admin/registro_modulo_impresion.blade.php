@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestionar</li>
    <li class="breadcrumb-item active" aria-current="page">Modulo Impresion</li>
@endsection

@section('subcontent')

    <h2 class="text-2xl mt-5 font-medium pl-5">Gestion de sede</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
            @foreach(['success', 'warning', 'danger'] as $alertType)
                @if(session($alertType))
                    <h6 class="alert alert-{{ $alertType }}">{{ session($alertType) }}</h6>
                @endif
            @endforeach
            @error('nombre')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-6">
            <div class="intro-y box p-5">
                <h3 class="text-2xl mt-5 font-small">Actividad predefinida de impresion</h3>
                <form action="{{ route('admin.set_print_act') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="actI">Actividad</label>
                        <select class="form-control" id="actI" name='actI'  required>
                            <option value= null >Selecciona una actividad</option>
                            @foreach ($actI as $act)
                                <option value="{{ $act->id }}">{{ $act->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Definir actividad default</button>
                </form>
            </div>
        </div>


        <div class="col-md-6">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Actividad predefinida de Mantenimiento</h3>
                <form method="POST" action="{{route('admin.set_mainteneance_act')}}">
                    @csrf
                    <div class="form-group">
                        <label for="actM">Actividad</label>
                        <select class="form-control" id="actM" name='actM'  required>
                        <option value= null >Selecciona una actividad</option>
                            @foreach ($actM as $act)
                                <option value="{{ $act->id }}">{{ $act->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Definir actividad default</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection