@extends('layouts/admin-layout')

@section('subhead')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{'home'}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{'home'}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Check-In</li>
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
                                @error('codigo')
                                <div class="alert alert-error alert-dismissible fade show auto-fade-out" role="alert" id="alert">
                                    <i class="fa fa-exclamation-triangle" style="margin-right: 10px"></i>
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                                <form method="POST" id="envio" action="{{ route('api.marcar') }}">
                                    @csrf
                                    <div class="form-group row justify-content-center">
                                        <label  class="col-md-3 col-form-label text-md-right text-lg">{{ __('Check-In') }}</label>
                                        <div class="col-md-6">
                                            <input id="codigo" class="form-control form-control-lg" name="codigo" placeholder="Ingresa tu codigo UDG">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <br>
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Marcar') }}
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

 @endsection

