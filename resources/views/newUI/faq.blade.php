@extends('../layout/' . $layout)

@section('subhead')
    <title>FAQ - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">FAQ</h2>
    </div>
    <div class="intro-y box pt-16 px-5 pb-24 mt-7 flex flex-col items-center">
        <!-- BEGIN: Invoice Title -->
        <div class="text-center">
            <div class="text-4xl font-bold mt-5">Frequently Asked Questions.</div>
            <div class="text-base text-slate-500 mt-3">Below you will find answers to questions that are most often we get about Rocketman.</div>
            <a href="" class="mt-7 block text-primary text-base">Still have no clue? Chat with us.</a>
        </div>
        <!-- END: Invoice Title -->
        <!-- BEGIN: Invoice Content -->
        <div id="faq-accordion-1" class="accordion accordion-boxed md:w-5/6 mt-16">
            <div class="accordion-item">
                <div id="faq-accordion-content-1" class="accordion-header">
                    <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                        OpenSSL Essentials: Working with SSL Certificates, Private Keys
                    </button>
                </div>
                <div id="faq-accordion-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div id="faq-accordion-content-2" class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2">
                        Understanding IP Addresses, Subnets, and CIDR Notation
                    </button>
                </div>
                <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-tw-parent="#faq-accordion-1">
                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div id="faq-accordion-content-3" class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-3" aria-expanded="false" aria-controls="faq-accordion-collapse-3">
                        How To Troubleshoot Common HTTP Error Codes
                    </button>
                </div>
                <div id="faq-accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-3" data-tw-parent="#faq-accordion-1">
                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div id="faq-accordion-content-4" class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-4" aria-expanded="false" aria-controls="faq-accordion-collapse-4">
                        An Introduction to Securing your Linux VPS
                    </button>
                </div>
                <div id="faq-accordion-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-4" data-tw-parent="#faq-accordion-1">
                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center flex-wrap gap-y-3 mt-5">
            <div class="mr-3">Was this information helpful?</div>
            <div class="flex">
                <button class="btn btn-outline-secondary w-16 px-2 py-1 mr-2">
                    <i class="w-4 h-4 mr-2" data-lucide="check"></i> Yes
                </button>
                <button class="btn btn-outline-secondary w-16 px-2 py-1">
                    <i class="w-4 h-4 mr-2" data-lucide="x"></i> No
                </button>
            </div>
        </div>
        <!-- END: Invoice Content -->
    </div>
@endsection
