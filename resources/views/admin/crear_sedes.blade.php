@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Vistas</li>
@endsection

@section('subcontent')
    

        <h2 class="text-2xl mt-5 font-medium pl-5">GESTIÓN</h2>

        <div class="grid grid-cols-12 gap-6 mt-5" id="alerta">
            <div class="intro-y col-span-12 lg:col-span-6">
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
        
        
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
        <div class="col-span-12 sm:col-span-6">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-medium">Modificar las vistas de la sede</h3>
                <br>
                <br>
            
        <form action="{{route('admin.modificarSede')}}" method="POST">
            @csrf
            <input type="hidden" name="sede" id="sede" value="">
            <select class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" id="sede" onchange="modificarCamposSede()">
                @if (isset($gest))
                    <option id="gest" value="null">Selecciona una sede</option>
                    @foreach ($gest as $dato )
                        <option id="{{$dato->nombre_Sede}}" value="{{json_encode($dato)}}">{{$dato->nombre_Sede }} </option>
                    @endforeach
                @endif
            </select>

            <h3 class="text-2xl mt-5 font-medium">Vistas</h3>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2 pt-3"> <label class="pl-5 pr-5" for="torneo">Torneo</label><input type="checkbox" class="w-10 h-10 form-check-input" name="torneo"id="torneo"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="impresiones">Impresiones</label><input type="checkbox" class="w-10 h-10 form-check-input" name="impresiones" id="impresiones"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="Reportes">Reportes</label><input type="checkbox" class="w-10 h-10 form-check-input" name="reportes" id="reportes"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="visita">Visitas</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="visitas" id="visitas"></div>
            </div>
            <br>
            <br>
            <button type="Submit" disabled id="guardar" class="btn btn-primary">Actualizar vistas</button>
            </form>
        </div>
    </div>
    
    <div class="col-span-12 sm:col-span-6">
        <div class="intro-y box p-5 mt-5">
            <h3 class="text-2xl mt-5 font-small">Lista de sedes</h3>
            <div class="text-center mx-auto" style="padding-left: 10px" id="sedes"></div>
        </div>
    </div>

</div>


@endsection

@section('script')
    <script>
    function modificarCamposSede(){
            
            btn_guardar= document.getElementById("guardar");
            selectSede = document.getElementById("sede");
            campoNombre = document.getElementById("nuevoNombre");
            idSede=document.getElementById("sede");
            checks= document.querySelectorAll('.form-check-input');
            
            if(selectSede.value === "null"){
                 // Restablecer los campos al estado inicial
                idSede.value = "";
                btn_guardar.disabled = true;
                return;
            }
            for(var check of checks){
                    check.checked = false;
            }
            btn_guardar.disabled = false;
            datoSede = JSON.parse(selectSede.value);
            campoNombre.value=datoSede.nombre_Sede;
            idSede.value = datoSede.id_Sede;


            if(datoSede.torneo == 1){
                checks[0].checked = true;
            }
            if(datoSede.impresiones == 1){
                checks[1].checked = true;
            }
            if(datoSede.reportes == 1){
                checks[2].checked = true;
            }
            if(datoSede.vistas== 1){
                checks[3].checked = true;
            }
        }
        setTimeout(function(){
            document.getElementById("alerta").style.display="none";
        }, 4000);

        </script>
@endsection