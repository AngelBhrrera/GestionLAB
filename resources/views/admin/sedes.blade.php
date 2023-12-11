@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')
    
    <div class="intro-y box p-5">
        <h2 class="text-2xl mt-5 font-medium">Horario</h2>

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
        <br>
        <form action="{{route('admin.modificarSede')}}" method="POST">
            @csrf
            <input type="hidden" name="idSede" id="idSede" value="">
            <select class="form-control @if(old('opc')=='1') @error('sede') is-invalid @enderror @endif" name="sede" id="sede" onchange="modificarCamposSede()">
                @if (isset($sede))
                    <option id="sede" value="null">Selecciona una sede</option>
                    @foreach ($sede as $dato )
                        <option id="{{$dato->nombre_Sede}}" value="{{json_encode($dato)}}" {{old('sede') == $dato->id_Sede ? 'selected="selected"' : '' }}>{{$dato->nombre_Sede }} </option>
                    @endforeach
                @endif
            </select>
            <br><br>
            <input required type="text" name="nuevoNombre" id="nuevoNombre" style="width: 40%" placeholder="Nuevo nombre" class="form-control">
            
            <h1 class="text-2xl mt-5 font-medium">Turnos disponibles</h1>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2 pt-5"> <label class="pl-5 pr-5" for="matutino">Matutino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="matutino"id="matutino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="mediodia">Medio día</label><input type="checkbox" class="w-10 h-10 form-check-input" name="mediodia" id="mediodia"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="vespertino">Vespertino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="vespertino" id="vespertino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="sabatino">Sabatino</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="sabatino" id="sabatino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="completo">Completo</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="completo" id="completo"></div>
            </div>
            <br>
            <button type="Submit" class="btn btn-primary"> Guardar cambios</button>
        </form>
    </div>
    
    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl mt-5 font-small">Añadir una sede</h2>
        
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

    <script>
        function modificarCamposSede(){
            
            selectSede = document.getElementById("sede");
            campoNombre = document.getElementById("nuevoNombre");
            idSede=document.getElementById("idSede");
            checks= document.querySelectorAll('.form-check-input');
            
            if(selectSede.value === "null"){
                 // Restablecer los campos al estado inicial
                campoNombre.value = "";
                idSede.value = "";
                for(var check of checks){
                    check.checked = false;
                }
                return;
            }

            datoSede = JSON.parse(selectSede.value);
            campoNombre.value=datoSede.nombre_Sede;
            idSede.value = datoSede.id_Sede;
            //Check turno matituno
            if(datoSede.turnoMatutino == 1){
                checks[0].checked = true;
            }else{
                checks[0].checked = false;
            }
            //Check turno medio día
            if(datoSede.turnoMediodia == 1){
                checks[1].checked = true;
            }else{
                checks[1].checked = false;
            }

            //Check turno vespertino
            if(datoSede.turnoVespertino== 1){
                checks[2].checked = true;
            }else{
                checks[2].checked = false;
            }

            //Check turno sabatino
            if(datoSede.turnoSabatino== 1){
                checks[3].checked = true;
            }else{
                checks[3].checked = false;
            }

            //Check turno completo
            if(datoSede.turnoTiempoCompleto == 1){
                checks[4].checked = true;
            }else{
                checks[4].checked = false;
            }
            
        }
    </script>
    
  

@endsection
