
@extends('../layouts/login-layout')


@section('head')
    <title>LOGIN</title>
@endsection

@section('content')

    <div class="container">
        
              
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
            <div class="text-center" style="margin: 10px 25% 15px 25%;">
                    <div class="box px-5 py-5 mt-10 relative" style="width: 200px; height: 120px;">
                        <a href="{{route('landing')}}"><img class="mx-auto my-auto" alt="Inventores" width="200px" height="150px" src="{{ asset('build/assets/images/logosInventores/InventoresBannerHDWhiteBorder.png') }}"></a>
                    </div>
                </div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    @if(session('FAIL'))
                        <div class="intro-y col-span-12 lg:col-span-6">
                            <h6 class="alert alert-danger">{{session('FAIL')}}</h6>
                        </div>
                    @endif
                    <div class="container pt-3">
                    <form method="POST" id="login-form">
                        @csrf
                        <input id="opc" name="opc" type="hidden" value="0">
                        <input id="correo" type="email" class="form-control py-3 px-4 block" placeholder="Correo"  name="correo" autocomplete="off">    
                        <div id="error-email" class="login__input-error text-danger mt-2"></div>                    
                        <input id="password" type="password" class="form-control py-3 px-4 block mt-4 " placeholder="Contraseña" name="password"  autocomplete="current-password">
                        <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        <div class="text-slate-500 flex text-xs sm:text-sm mt-4 ">
                            <a href="{{route('password.request')}}">Recuperar contraseña</a>
                        </div>
                        <div class="mt-5 xl:mt-8 text-center xl:text-left">                        
                            <button id="btn-login" type="submit" class="btn btn-primary w-full xl:mr-3 " >Iniciar Sesion</button>
                        </div>
                    </form>
                        <div class="text-center xl:text-left">
                            <a href="{{route('register')}}">
                                <button class="btn btn-outline-secondary w-full mt-3" type="submit">
                                    Registrarse
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="success-notification-content" class="toastify-content hidden flex">
        <i class="text-success" data-lucide="check-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Registration success!</div>
        </div>
    </div>

    <div id="failed-notification-content" class="toastify-content hidden flex">
        <i class="text-danger" data-lucide="x-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Registro fallido</div>
            <div class="text-slate-500 mt-1">
                Los datos ingresados son incorrectos.
            </div>
        </div>
    </div>

    {{-- <button  class="btn btn-lg btn-block btn-primary" href="{{ route('admin.firmas') }}">bot</button> --}}
@endsection

@section('script')
<script type="module" src="{{ asset('/build/assets/js/app.6c589841.js')}}"></script>

{{-- 
<script>
        (function () {
            async function login() {

                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let email = $('#email').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password
                }).then(res => {
                    location.href = '/'
                }).catch(err => {
                    $('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script>
 --}}

@endsection
