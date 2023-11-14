@extends('layouts/app')

@section('content')
<div class="container">
    @include('table')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card-footer" style="background-color: white">
                <h4 class=" float-left">Horas Totales: {{$horas}}</h4>
                <h4 class=" float-right">Horas Pendientes: {{$horasT}}</h4>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
