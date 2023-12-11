@extends('layouts/admin-layout')

<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->

<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Visitas</li>
@endsection


@section('subcontent')
<main class="py-5">
    <div class="intro-y box p-5" style="margin: 0 20% 0 20%">
        <div class="container">
            @include('alerta')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" id="envio" action="{{ route('api.registrarVisita') }}">
                                @csrf
                                <div class="form-group row justify-content-center"> 
                                    <label  class="col-md-3 col-form-label text-md-right text-lg">{{ __('Check-In Visitante') }}</label> 
                                    <div class="col-md-6">
                                        <input id="codigo" class="form-control form-control-lg" name="codigo"> 
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <br>
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary btn-block center"> 
                                            {{ __('Registrar visita') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('script')

    <script type="text/javascript">
    $('#alert').fadeIn();
    setTimeout(function() {
        $("#alert").fadeOut();
    },5000);
    </script>

@endsection

