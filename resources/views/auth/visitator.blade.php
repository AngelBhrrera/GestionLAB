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
    <div class="container">
        @include('alerta')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" id="envio" action="{{ route('api.registrarVisita') }}">
                            @csrf
                            <div class="form-group row justify-content-center"> 
                                <label  class="col-md-3 col-form-label text-md-right text-lg">{{ __('Telefono') }}</label> 
                                <div class="col-md-6">
                                    <input id="codigo" class="form-control form-control-lg" name="codigo"> 
                                </div>
                            </div>
                            <div class="form-group row mb-0">
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
</main>

@endsection


@section('script')

    <script src={{asset('plugins/jquery/jquery.min.js')}}></script>
    <!-- Bootstrap 4 -->
    <script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src={{asset('dist/js/adminlte.min.js')}}></script>
    <!-- Bootstrap 4 -->

    <script type="text/javascript">
    $('#alert').fadeIn();
    setTimeout(function() {
        $("#alert").fadeOut();
    },5000);
    </script>

@endsection

