@extends('layouts/prestador-layout')

<style>

  .profile-image {
    width: 250px;
    height: 250px;
    margin: 0 auto;
    overflow: hidden;
    /* border-radius: 50%; */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .profile-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  /* Estilos para las medallas */
  .profile-medal {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    /* margin-left: -75px; */
  }

  .medal-image {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .gradiente-texto {
    background: linear-gradient(to right, #ffd700, #ffa500, #ff8c00, #ff4500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradient 10s ease infinite;
  }

  @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }
</style>


@section('subcontent')

      <div class="container">

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        <script>
          setTimeout(function() {
                  location.reload();
              }, 1500); // La página se recargará automáticamente después de 1.5 segundos
        </script>
        @endif

        @if ($errors->has('imagen_perfil'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('imagen_perfil.max') }}</strong>
        </span>
        @endif

          <div class="col-md-3 text-center">

          <div class="col-md-9"> 
            <div class="col-md-4">
              <h1>Mi Perfil</h1>
              <hr>
              <p><strong>Nombre:</strong> {{$user->name}}</p>
              <p><strong>Apellido:</strong> {{$user->apellido}}</p>
              <p><strong>Correo:</strong> {{$user->correo}}</p>
              <p><strong>Codigo:</strong> {{$user->codigo}}</p>
              <p><strong>Centro:</strong> {{$user->centro}}</p>
              <p><strong>Carrera:</strong> {{ $user->carrera }}</p>
              <p><strong>Experiencia:</strong> {{ $user->experiencia ?? '0' }}</p>
              <p><strong>Nivel:</strong> {{ $nivel_str }}</p>
            </div>
          </div>


            <div class="profile-image d-flex justify-content-center overflow-hidden">

              @if($user->imagen_perfil)
              {{-- <img src="{{ asset('storage/app/public/imagen/' . $user->imagen_perfil) }}"
                alt="{{ $user->imagen_perfil }}" width="50" height="50"> --}}
              {{-- <img src="{{ asset('storage/imagen/' . $user->imagen_perfil) }}" alt="{{ $user->imagen_perfil }}"
                width="100" height="100"> --}}
              <img src="{{ asset('storage/imagen/' . $user->imagen_perfil) }}" alt="{{ $user->imagen_perfil }}"
                class="profile-image">
              {{-- <img src="{{ asset('storage/app/public/imagen/imagen' . $user->imagen_perfil) }}"
                alt="{{ $user->imagen_perfil }}" class="profile-image"> --}}
              {{-- <img src="{{ 'storage/app/public/imagen/' . $user->imagen_perfil }}" alt="{{ $user->imagen_perfil }}"
                class="profile-image"> --}}
              {{-- <img src="{{ 'storage\app\public\imagen/' . $user->imagen_perfil }}" alt="{{ $user->imagen_perfil }}"
                class="profile-image"> --}}
              {{-- <img src="{{ asset('storage/app/public/imagen/' . $user->imagen_perfil) }}"
                alt="{{ $user->imagen_perfil }}" class="profile-image"> --}}
              @else
              <img src="{{ asset('build/assets/images/barrera.jpg') }}" alt="{{ $user->name }}" width="150" height="150">
              @endif
            </div>
            <button type="button" class="btn btn-sm btn-outline-success mt-3" data-toggle="modal"
              data-target="#imagenModal">Cambiar Imagen</button>
          </div>

            <div class="col-md-3 text-center  text-align: center; display: block;">
              <h1 class="ml-3 gradiente-texto">Insignia:</h1>
              <div class="d-flex align-items-center justify-content-center">
                <div class="profile-medal d-flex justify-content-center overflow-hidden">
                  <img src="{{ $medalla }}" alt="Medalla del usuario" class="medal-image">
                </div>
              </div>
              <h1 class="ml-3">{{ $descripcion_medalla }}</h1>
            </div>

          {{-- </div> --}}

        {{-- </div> --}}
        <h1 class="gradiente-texto text-center">Total de insignias obtenidas:</h1>
        <div class="row justify-content-center">
          @foreach($todasMedallasUsuario as $medalla)
          <div class="col-md-3 col-sm-6 mb-4 col-12 text-center">
            <div class="card profile-medal d-flex flex-column align-items-center justify-content-center">
              <div class="medal-wrapper d-flex align-items-center justify-content-center">
                <img src="{{ asset($medalla->ruta) }}" alt="{{ $medalla->descripcion }}" class="medal-image" >
                <h5 class="card-title text-center">{{ $medalla->descripcion }}</h5>
              </div>
            </div>
          </div>
          @endforeach
        </div>


        
@endsection

    <!-- Modal para cambiar la imagen -->
    <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imagenModalLabel">Cambiar imagen de perfil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('cambiarImagenPerfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="imagen_perfil">Imagen de perfil</label>
                <input type="file" class="form-control-file" id="imagen_perfil" name="imagen_perfil">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END : Modal para cambiar la imagen -->
