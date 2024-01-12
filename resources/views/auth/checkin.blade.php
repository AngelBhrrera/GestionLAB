@extends('layouts/admin-layout')

@section('subhead')
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
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
                                <form method="POST" id="envio" action="{{ route('api.marcar') }}">
                                    @csrf
                                    <div class="form-group row justify-content-center">
                                        <label  class="col-md-3 col-form-label text-md-right text-lg">{{ __('Check-In') }}</label>
                                        <div class="col-md-6">
                                            <input id="codigo" class="form-control form-control-lg" name="codigo">
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


