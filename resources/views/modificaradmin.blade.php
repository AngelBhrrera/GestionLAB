<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de acceso</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Modificar Datos Generales</div>
            <div class="card-body">
              <form action="POST" action="{{isset($ruta) ?  route($ruta) :route('update')}}">
                
                <div class="form-group">
                <label for="">Nombre</label>
                <input type="text"
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    id="name" 
                    value="{{isset($dV[0]->name) ? $dV[0]->name : old('name')}}" 
                    placeholder="nombre">
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="">Apellido</label>
                  <input type="text"
                      class="form-control @error('apellido') is-invalid @enderror" 
                      name="apellido" 
                      id="apellido" 
                      value="{{isset($dV[0]->apellido) ? $dV[0]->apellido : old('apellido')}}" 
                      placeholder="apellido">
                      @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Correo</label>
                    <input type="email"
                        class="form-control @error('correo') is-invalid @enderror" 
                        name="correo" 
                        id="correo" 
                        value="{{isset($dV[0]->correo) ? $dV[0]->correo : old('correo')}}" 
                        placeholder="ejemplo@ejemplo.com">
                        @error('correo')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        id="password" 
                        value="{{isset($dV[0]->password) ? $dV[0]->correo : old('password')}}" 
                        placeholder="123qwer%&$&">
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  <div class="form-group" id="cpassword" style="display: none">
                    <label for="">Confirmar Contraseña</label>
                    <input type="password"
                        class="form-control @error('cpassword') is-invalid @enderror" 
                        name="cpassword" 
                        id="cpassword" 
                        value="{{isset($dV[0]->cpassword) ? $dV[0]->correo : old('cpassword')}}" 
                        placeholder="123qwer%&$&">
                        @error('cpassword')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  <button type="submit" class="btn btn-lg btn-block btn-primary">Actualizar</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>