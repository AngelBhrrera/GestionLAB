@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')
    
    <div class="intro-y box p-5">
        <h2 class="text-2xl mt-5 font-medium">Horario</h2>

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
            <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="activa">Activa</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="activa" id="activa"></div>

            <h1 class="text-2xl mt-5 font-medium">Turnos disponibles</h1>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2 pt-5"> <label class="pl-5 pr-5" for="matutino">Matutino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="matutino"id="matutino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="mediodia">Medio día</label><input type="checkbox" class="w-10 h-10 form-check-input" name="mediodia" id="mediodia"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="vespertino">Vespertino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="vespertino" id="vespertino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="sabatino">Sabatino</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="sabatino" id="sabatino"></div>
                <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="completo">Completo</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="completo" id="completo"></div>
            </div>
            <br>
            <button type="Submit" disabled id = "guardar" class="btn btn-primary"> Guardar cambios</button>
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
            <button type="submit"class="btn btn-primary">Crear</button>
        </form>
    </div>

    <div class="intro-y box p-5 mt-5">
        <h2 class="text-2xl mt-5 font-small">Lista de sedes</h2>
        <div class="text-center mx-auto" style="padding-left: 10px" id="sedes"></div>
    </div>

    
    
  

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript">

            var sedes = {!! $tabla_sedes !!};

            var table = new Tabulator("#sedes", {
                height:"100%",
                data: sedes,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: "true",
                pagination: "local",
                paginationSize: 5,
                tooltips: true,
                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Nombre Sede",
                        field: "nombre_Sede",
                        headerFilter: "input",
                        sorter: "string",
                        hozAlign: "center",
                        width: 200,
                    }, {
                        title: "Estado",
                        field: "activa",
                        formatter: function(cell, formatterParams, onRendered) {
                            var estado = cell.getValue();
                            var icono = "";
                            if (estado == "1") {
                                icono = "✔️";
                            } else if (estado == "0") {
                                icono = "❌";
                            }
                            return icono;
                        },
                        hozAlign: "center",
                        width: 100,
                    }
                ],
            });
    </script>

    <script>
        function modificarCamposSede(){
            
            btn_guardar= document.getElementById("guardar");
            selectSede = document.getElementById("sede");
            campoNombre = document.getElementById("nuevoNombre");
            idSede=document.getElementById("idSede");
            checks= document.querySelectorAll('.form-check-input');
            
            if(selectSede.value === "null"){
                 // Restablecer los campos al estado inicial
                campoNombre.value = "";
                idSede.value = "";
                btn_guardar.disabled = true;
                for(var check of checks){
                    check.checked = false;
                }

                return;
            }
            btn_guardar.disabled = false;
            datoSede = JSON.parse(selectSede.value);
            campoNombre.value=datoSede.nombre_Sede;
            idSede.value = datoSede.id_Sede;


            //Cheack activo/inactivo
            if(datoSede.activa == 1){
                checks[0].checked = true;
            }else{
                checks[0].checked = false;
            }
            //Check turno matituno
            if(datoSede.turnoMatutino == 1){
                checks[1].checked = true;
            }else{
                checks[1].checked = false;
            }
            //Check turno medio día
            if(datoSede.turnoMediodia == 1){
                checks[2].checked = true;
            }else{
                checks[2].checked = false;
            }

            //Check turno vespertino
            if(datoSede.turnoVespertino== 1){
                checks[3].checked = true;
            }else{
                checks[3].checked = false;
            }

            //Check turno sabatino
            if(datoSede.turnoSabatino== 1){
                checks[4].checked = true;
            }else{
                checks[4].checked = false;
            }

            //Check turno completo
            if(datoSede.turnoTiempoCompleto == 1){
                checks[5].checked = true;
            }else{
                checks[5].checked = false;
            }
            
        }
        setTimeout(function(){

            document.getElementById("alerta").style.display="none";

        }, 4000);
    </script>
            
    
@endsection
