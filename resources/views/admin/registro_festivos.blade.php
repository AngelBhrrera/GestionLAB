@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Festivos</li>
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
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
        <div class="col-span-12 sm:col-span-6">
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
                    <label class="mr-5" for="descripcion">Descripción</label>
                    <input class="form-control" type="text" name="descripcion" autocomplete="off">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    
        <div class="col-span-12 sm:col-span-6">
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
                        <label class="mr-5" for="descripcion">Descripción</label>
                        <input class="form-control" type="text" name="descripcion" autocomplete="off">
                        <br><br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-6">
        <div class="intro-y box p-5 mt-5">
        <h3 class="text-2xl mt-5 font-small">Días festivos y vacaciones</h3>
        <div class="text-center mx-auto" style="padding-left: 10px" id="festivos"></div>
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
                                <input id="inicio" value="" type="date" class="form-control" name="inicio" placeholder="inicio" style="width: 200px"></div>
                                <input id="fin" value="" type="date" class="form-control mt-5" name="fin" placeholder="fin" style="width: 200px"></div>
                                <br>
                                <label class="mr-5" for="descripcion">Descripción</label>
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
    <!-- END: Modal Content -->
    <div style="height: 65px;"></div>
@endsection



@section('script')
    <script type="text/javascript">
            var sedes = {!! $no_laboral !!};
            var table = new Tabulator("#festivos", {

                data: sedes,
                paginationSize: 15,

                pagination: "local",
                layout: "fitDataFill",
                resizableColumns:false,
                height: "100%",

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
                        hozAlign: "center",
                        width: 300,
                    }, {
                        title: "Inicio",
                        field: "inicio",
                        hozAlign: "center",
                        sorter: "date",
                        formatter: "datetime",
                        formatterParams: {
                            inputFormat: "DD-MM-YYYY",
                            outputFormat: "DD-MM-YYYY", 
                            invalidPlaceholder: "(Fecha inválida)",
                        },
                        width: 150,
                    },{
                        title: "Fin",
                        field: "final",
                        hozAlign: "center",
                        sorter: "date",
                        formatter: "datetime",
                        formatterParams: {
                            inputFormat: "DD-MM-YYYY",
                            outputFormat: "DD-MM-YYYY", 
                            invalidPlaceholder: "(Fecha inválida)",
                        },
                        width: 150,
                    },
                    {
                        title: "Tipo",
                        field: "tipo",
                        hozAlign: "center",
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
                if(data.tipo == "festivo"){
                    final.classList.add('hidden');
                }else{
                    final.classList.remove('hidden');
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