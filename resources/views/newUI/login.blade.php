@extends('../layout/' . $layout)

@section('head')
    <title>Login - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('content')
    <div class="container">
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-16" alt="Rocketman - Tailwind HTML Admin Template" src="{{ asset('build/assets/images/logo.svg') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-14">Login to Your Account!</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <input type="text" class="form-control py-3 px-4 block" placeholder="Email">
                    <input type="password" class="form-control py-3 px-4 block mt-4" placeholder="Password">
                    <div class="text-slate-500 flex text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input type="checkbox" class="form-check-input border mr-2" id="remember-me">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="">Forgot Password?</a>
                    </div>
                    <div class="mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary w-full xl:mr-3">Login</button>
                        <button class="btn btn-outline-secondary w-full mt-3">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
