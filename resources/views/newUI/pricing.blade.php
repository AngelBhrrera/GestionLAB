@extends('../layout/' . $layout)

@section('subhead')
    <title>Pricing - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Pricing</h2>
    </div>
    <div class="intro-y box pt-16 px-5 pb-24 mt-7 flex flex-col items-center text-center">
        <!-- BEGIN: Pricing Title -->
        <div class="text-base text-slate-500">Free trial for 7 days.</div>
        <div class="text-4xl font-bold mt-5">Buy once, use it forever.</div>
        <div class="text-base text-slate-500 mt-3">Get lifetime access to all features today, plus any updates <br> we release in the future for a simple one-time price.</div>
        <a href="" class="mt-7 block text-primary text-base">Have a question? Chat with us.</a>
        <!-- END: Pricing Title -->
        <!-- BEGIN: Pricing Content -->
        <div class="intro-y flex flex-col lg:flex-row border border-slate-200 rounded-lg md:w-5/6 mt-20">
            <div class="intro-y flex-1 px-5 py-16 lg:mr-4 bg-slate-50 rounded-l-md dark:bg-darkmode-600">
                <i data-lucide="credit-card" class="block w-12 h-12 text-primary mx-auto"></i>
                <div class="text-xl font-medium text-center mt-10">Basic Plan</div>
                <div class="text-slate-600 dark:text-slate-500 text-center mt-5">
                    1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies
                </div>
                <div class="text-slate-500 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                <div class="flex justify-center">
                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                        <span class="absolute text-2xl top-0 left-0 -ml-4">$</span> 35
                    </div>
                </div>
                <button type="button" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">PURCHASE NOW</button>
            </div>
            <div class="intro-y box -mx-1 md:-mx-5 -my-8 border-b border-t flex-1 p-5 lg:border-l lg:border-r border-slate-200/60 dark:border-darkmode-400 dark:bg-darkmode-500 py-16 !z-50">
                <i data-lucide="shopping-bag" class="block w-12 h-12 text-primary mx-auto"></i>
                <div class="text-xl font-medium text-center mt-10">Enterprise</div>
                <div class="text-slate-600 dark:text-slate-500 text-center mt-5">
                    1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies
                </div>
                <div class="text-slate-500 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                <div class="flex justify-center">
                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                        <span class="absolute text-2xl top-0 left-0 -ml-4">$</span> 120
                    </div>
                </div>
                <button type="button" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">PURCHASE NOW</button>
            </div>
            <div class="intro-y flex-1 px-5 py-16 lg:ml-4 bg-slate-50 rounded-r-md dark:bg-darkmode-600">
                <i data-lucide="briefcase" class="block w-12 h-12 text-primary mx-auto"></i>
                <div class="text-xl font-medium text-center mt-10">Business</div>
                <div class="text-slate-600 dark:text-slate-500 text-center mt-5">
                    1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies
                </div>
                <div class="text-slate-500 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                <div class="flex justify-center">
                    <div class="relative text-5xl font-semibold mt-8 mx-auto">
                        <span class="absolute text-2xl top-0 left-0 -ml-4">$</span> 60
                    </div>
                </div>
                <button type="button" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">PURCHASE NOW</button>
            </div>
        </div>
        <!-- END: Pricing Content -->
    </div>
@endsection
