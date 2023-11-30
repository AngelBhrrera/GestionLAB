@extends('layouts/prestador-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="container">

        @if (isset(Auth::user()->horario))
            <h1 class="text-center">Horario: {{Auth::user()->horario}}</h1>
        @else
            <h1 class="text-center">No tienes horario asignado</h1>
        @endif



      
    </div>
      <!-- BEGIN: Calendar Content -->
      <div class="container" style="padding: 20px 20px 20px 20px" >
            <div class="col-span-12 xl:col-span-8 2xl:col-span-9">
                <div class="box p-5">
                    <div class="full-calendar" id="calendar"></div>
                </div>
            </div>
        </div>
        <!-- END: Calendar Content -->


@endsection

