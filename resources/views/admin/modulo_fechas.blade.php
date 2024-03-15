@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Festivos</li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('descripcion')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#avac">Añadir periodos vacacionales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#afes">Añadir dias festivos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#anol">Añadir dias no laborales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vfes">Ver todas las fechas destacadas</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="avac">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Añadir periodo vacacional</h3>
                <form action="{{route('admin.agregar_festivos')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="vacaciones">
                    <input type="hidden" name="sede" value="{{Auth::user()->sede}}">
                    <input type="hidden" name="area" value="{{Auth::user()->area}}">
                    <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                        <p>Introduce un rango de fechas</p><br>
                        <label style="margin-right:4px" for="vacacionesInicio">Inicio</label>
                        <input required id="vacacionesInicio" type="date" class="form-control" name="vacacionesInicio" placeholder="Inicio" style="width: 200px">
                        <br><br>
                        <label class="mr-5"for="vacacionesInicio">Fin</label>
                        <input required id="vacacionesFin" type="date" class="form-control" name="vacacionesFin" placeholder="Fin" style="width: 200px">
                    </div>
                    <br>
                    <label class="mr-5" for="descripcion">Justificación</label>
                    <input class="form-control" type="text" name="descripcion" autocomplete="off" required>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="afes">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Añadir un día festivo</h3>
                <form action="{{route('admin.agregar_festivos')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="festivo">
                    <input type="hidden" name="sede" value="{{Auth::user()->sede}}">
                    <input type="hidden" name="area" value="{{Auth::user()->area}}">
                    <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                        <p>Introduce un día festivo</p><br>
                        <input required id="diaFestivo" type="date" class="form-control" name="diaFestivo" placeholder="festivo" style="width: 200px"></div>
                        <br>
                        <label class="mr-5" for="descripcion">Justificación</label>
                        <input class="form-control" type="text" name="descripcion" autocomplete="off" required>
                        <br><br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="anol">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Añadir un día no laboral</h3>
                <form action="{{route('admin.agregar_festivos')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="no_laboral">
                    <input type="hidden" name="sede" value="{{Auth::user()->sede}}">
                    <input type="hidden" name="area" value="{{Auth::user()->area}}">
                    <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                        <p>Introduce un día no laboral</p><br>
                        <input required id="diaLaboral" type="date" class="form-control" name="diaFestivo" placeholder="No laboral" style="width: 200px"></div>
                        <br>
                        <label class="mr-5" for="descripcion">Justificación</label>
                        <input class="form-control" type="text" name="descripcion" autocomplete="off" required>
                        <br><br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="vfes">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Días festivos y vacaciones</h3>
                <div class="text-center mx-auto" style="padding-left: 10px" id="festivos"></div>
            </div>
        </div>
    </div>
</div>

                           
    <!-- BEGIN: Modal Content -->
    <div id="static-backdrop-modal-preview" id="editarFestivo"class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5"></div>
                        <form action="{{route('admin.editarFestivo')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id_festivo" name="id_festivo" value="">
                            <input type="hidden" id="tipo" name="tipo" value="">
                            <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                                <h2 class="text-2xl mt-5 font-small">Introduce los nuevos datos</h2><br>
                                <input id="inicio" required value="" type="date" class="form-control" name="inicio" placeholder="inicio" style="width: 200px"></div>
                                <input id="fin" value="" type="date" class="form-control mt-5" name="fin" placeholder="fin" style="width: 200px"></div>
                                <br>
                                <label class="mr-5" for="descripcion">Justificación</label>
                                <input required id="descripcion" class="form-control" type="text" name="descripcion" autocomplete="off">
                                <br><br>
                                <div class="text-center">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Cancelar</button>
                                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
            var dias_especiales = {!! $no_laboral !!};
            var table = new Tabulator("#festivos", {

                data: dias_especiales,
                paginationSize: 15,
                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,

                columns: [{
                        title: "ID",
                        field: "id",
                        visible: false,
                        width: 2,
                    }, {
                        title: "Descripción",
                        field: "evento",
                        headerFilter: "input",
                        sorter: "string",
                        width: 300,
                    }, {
                        title: "Inicio",
                        field: "inicio",
                        width: 150,
                    },{
                        title: "Fin",
                        field: "final",
                        width: 150,
                    },
                    {
                        title: "Tipo",
                        field: "tipo",
                        width: 150,
                    },
                    {
                        title: "Editar",
                        field: "datos",
                        formatter: customButtonFormatter,
                        width: 150,
                    },
                    {
                        title: "Eliminar",
                        field: "id",
                        
                        formatter: function (cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            var button = document.createElement("button");
                            button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                            button.textContent = "Eliminar";
                            button.addEventListener("click", function() {
                                eliminarFestivo(value);
                            });
                            return button;
                        },
                        width: 150,
                    },
                    
                ],
            });

            function eliminarFestivo(value){
                let confirmar = confirm("¿Estás seguro de eliminar el registro? Esta acción no se puede deshacer.")
                if(confirmar){
                    if(true){
                    const token = document.head.querySelector('meta[name="csrf-token"]').content;
                    fetch(`eliminarFestivo/${value}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {

                        console.log('Eliminado', data);

                        window.location.reload(); 
                    })
                    .catch(error => {
                        console.error('Error al intentar eliminar', error);
                    });
                    }else{
                        console.log("No se pudo eliminar el registro");
                    }
                } 
            }
    
        function customButtonFormatter(cell, formatterParams, onRendered) {
            var div = document.createElement("div");
            div.classList.add("text-center");
            
            var a = document.createElement("a");
            a.href = "javascript:;";
            a.setAttribute("data-tw-toggle", "modal");
            a.setAttribute("data-tw-target", "#static-backdrop-modal-preview");
            a.classList.add("btn", "btn-primary");
            a.textContent = "Editar";

            div.appendChild(a);
            a.addEventListener('click', function(){
                var data = cell.getRow().getData();
                var fechaInicio = formatoFecha(data.inicio);
                var fechaFin = formatoFecha(data.final);
                console.log(fechaInicio);
                document.getElementById('id_festivo').value = data.id;
                document.getElementById('tipo').value = data.tipo;
                document.getElementById('inicio').value = fechaInicio;
                document.getElementById('descripcion').value = data.evento;
                var final = document.getElementById('fin');
                
                final.value = fechaFin;
                if(data.tipo == "festivo" || data.tipo == "no_laboral"){
                    final.classList.add('hidden');
                    final.removeAttribute('required');
                }else{
                    final.classList.remove('hidden');
                    final.setAttribute('required','');
                }
                
            });
            return div;
        }

        function formatoFecha(fechaString){

            var fechaParts = fechaString.split('-');
            var fechaFormateada = fechaParts[2] + '-' + fechaParts[1] + '-' + fechaParts[0];

            return fechaFormateada;
        }

        

    </script>
@endsection