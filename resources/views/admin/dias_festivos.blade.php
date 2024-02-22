@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
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

    <div style="height: 65px;"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var sedes = {!! $no_laboral !!};

            var table = new Tabulator("#festivos", {
                height:"100%",
                data: sedes,
                layout: "fitColumns",
                resizableColumns: "false",
                fitColumns: true,
                pagination: "local",
                paginationSize: 15,
                tooltips: true,
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
                    }, {
                        title: "Inicio",
                        field: "inicio",
                        hozAlign: "center",
                    },{
                        title: "Fin",
                        field: "final",
                        hozAlign: "center",
                    },
                    {
                        title: "Tipo",
                        field: "tipo",
                        hozAlign: "center",
                    },
                    {
                        title: "Tipo",
                        field: "tipo",
                        hozAlign: "center",
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
                    },
                ],
            });

            function eliminarFestivo(value){
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
    </script>
@endsection