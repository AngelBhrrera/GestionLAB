@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.verCambiarPassword')}}">Cambio contraseña</a></li>
@endsection

@section('subcontent')
    

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>     
            @endif
            
            @if(session('warning'))
                <h6 class="alert alert-warning">{{session('warning')}}</h6>  
            @endif

            @error('nombre')
                <h6 class="alert alert-danger">{{$message}}</h6>
            @enderror
        </div>
    </div>
    <div class="container">
        <div class="px-5 sm:px-20 pt-10">
            <div id="formOne">
                <h3 class="text-2xl font-medium leading-none mt-3" style="padding-top: 20px; padding-bottom: 20px;">Cambiar contraseña </h3>
                <form onsubmit="return confirmarCambio()" method="POST" action="{{ route('admin.actualizar_password') }}">
                    @csrf
                    <div class="col-span-12 sm:col-span-4">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="nuevaPassword" class="form-label">Introduce tu nueva contraseña</label>
                            <input id="password" type="password" class="form-control" name="nuevaPassword" required autocomplete="off" placeholder="Contraseña">
                            @error('nuevaPassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-center xl:text-left">
                            <button id="btn-log" class="btn btn-outline-secondary w-full mt-3" type="submit">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

</div>
<div style="height: 65px;"></div>
@endsection

@section('script')
<script>
    function confirmarCambio(){
        const confirmar = confirm("¿Estás seguro de cambiar la contraseña?");

        if(confirmar){
            return true;
        }else{
            return false;
        }

    }
</script>
    
@endsection
