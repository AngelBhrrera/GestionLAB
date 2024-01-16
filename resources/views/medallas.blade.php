@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="gradiente-texto text-center">Medallas:</h1>
  <div class="row justify-content-center">
    @foreach($medallas as $medalla)
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card profile-medal">
        <div class="medal-wrapper d-flex align-items-center justify-content-center">
          <img src="{{ asset($medalla->ruta) }}" alt="{{ $medalla->descripcion }}" class="card-img-top medal-image" style="width: 100px; height: 100px;">
          <h5 class="card-title text-center">{{ $medalla->descripcion }}</h5>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
</div>

@endsection
