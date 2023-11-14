@extends('../layout/' . $layout)

@section('head')
    <title>Register - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('content')
    <div class="container">
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-16" alt="Rocketman - Tailwind HTML Admin Template" src="{{ asset('build/assets/images/logo.svg') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-14">Register a New Account</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <input type="text" class="form-control py-3 px-4 block" placeholder="First Name">
                    <input type="text" class="form-control py-3 px-4 block mt-4" placeholder="Last Name">
                    <input type="text" class="form-control py-3 px-4 block mt-4" placeholder="Email">
                    <input type="password" class="form-control py-3 px-4 block mt-4" placeholder="Password">
                    <div class="w-full grid grid-cols-12 gap-4 h-1 mt-3">
                        <div class="col-span-3 h-full rounded bg-success"></div>
                        <div class="col-span-3 h-full rounded bg-success"></div>
                        <div class="col-span-3 h-full rounded bg-success"></div>
                        <div class="col-span-3 h-full rounded bg-slate-100 dark:bg-darkmode-800"></div>
                    </div>
                    <a href="" class="text-slate-500 block mt-2 text-xs sm:text-sm">What is a secure password?</a>
                    <input type="text" class="form-control py-3 px-4 block mt-4" placeholder="Password Confirmation">
                    <div class="flex items-center text-slate-500 mt-4 text-xs sm:text-sm">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                        <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
                    </div>
                    <div class="mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary w-full xl:mr-3">Register</button>
                        <button class="btn btn-outline-secondary w-full mt-3">Sign in</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
