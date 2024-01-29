@extends('layouts/visitante-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('cliente.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item">Home</li>
@endsection

@section('subcontent')
    <div>---Pendiente de codificar---</div>
    <br><br><br> 
    <h2  class="text-2xl font-medium leading-none mt-3">Políticas de solicitud de uso de impresoras</h2>
    <br>
    <div class="font-semibold">
        1. Para comenzar a  imprimir su proyecto es necesario entregar su filamento en laboratorio después de llenar el formulario correspondiente.
    </div>
    <div class="font-semibold">
        2. La cantidad de material de donación es acorde al gramaje de proyecto (Consultar tabla).
    </div>
    <div class="font-semibold">
        3. Una vez terminado el proyecto se le citara para hacer el pesaje de las piezas impresas y determinar cuanto material debe ser donado.
    </div>
    <div class="font-semibold">
        4. El donativo dependerá del inventario del laboratorio en su momento, este puede cambiar por donativos en especie como:
        filamento, microSD, resina, refacciones o papelería.
    </div>
    <div class="font-semibold">
        5. Una vez entregado el material de donación se le entregarán las piezas impresas y se deberá llenar la hoja de conformidad.
    </div>
    <br>
    <div>
        <div class="overflow-x-auto">
            <div style="width: 50%">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap"><div class="text-center">Gramaje total <br>del proyecto</div></th>
                            <th class="whitespace-nowrap"><div class="text-center">Filamento que se <br>puede proporcionar </div></th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td><div class="text-center">1g - 100g</div></td>
                            <td><div class="text-center">250g</div></td>                        
                        </tr>
                        <tr>
                            <td><div class="text-center">101g - 250g</div></td>
                            <td><div class="text-center">500g</div></td>
                        </tr>
                        <tr>
                            <td><div class="text-center">251g - 500g</div></td>
                            <td><div class="text-center">750g</div></td>
                        </tr>
                        <tr>
                            <td><div class="text-center">501g - 1kg o más</div></td>
                            <td><div class="text-center">1kg o más</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>**Nota: Se contempla el gramaje de filamento usado y donativo equivalente.
        </div>
    </div>                  
        
@endsection
