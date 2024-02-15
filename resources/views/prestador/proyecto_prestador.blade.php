@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actividades</li>
    <li class="breadcrumb-item active" aria-current="page">Mi proyecto</li>
@endsection

@section('subcontent')

<div class="col-span-12">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> MIS PROYECTOS </h3>
                </div>
        <div class="box intro-y px-3 pt-3 pb-5">
                    
            <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                <div class="flex flex-col items-center 2xl:mr-10 mt-5">
                    <div class="box intro-y p-5 mt-5 square-box">
                        <h2 class="text-2xl font-medium"> </h2>
                        <h4 class="text-sm font-medium smaller-text">

                        </h4>
                    </div>
                </div>
                                                                        

        </div>
</div>
@endsection
