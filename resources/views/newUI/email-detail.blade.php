@extends('../layout/' . $layout)

@section('subhead')
    <title>Email Detail - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Inbox</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="mail"></i> Compose New Mail
            </button>
            <button class="btn box">
                <i class="w-4 h-4 mr-2" data-lucide="settings"></i> Settings
            </button>
        </div>
    </div>
    <div class="box grid grid-cols-12 mt-5">
        <!-- BEGIN: Inbox Side Menu -->
        <div class="col-span-12 xl:col-span-4 2xl:col-span-2 border-b xl:border-r border-slate-200/60 bg-slate-50 dark:bg-darkmode-600 p-5 rounded-l-md">
            <div>
                <a href="" class="flex items-center px-3 py-2 rounded-md bg-primary dark:bg-darkmode-800 font-medium text-white">
                    <i class="w-4 h-4 mr-2" data-lucide="mail"></i> Inbox
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                    <i class="w-4 h-4 mr-2" data-lucide="star"></i> Marked
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                    <i class="w-4 h-4 mr-2" data-lucide="inbox"></i> Draft
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                    <i class="w-4 h-4 mr-2" data-lucide="send"></i> Sent
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                    <i class="w-4 h-4 mr-2" data-lucide="trash"></i> Trash
                </a>
            </div>
            <div class="border-t border-slate-400/20 dark:border-darkmode-400 mt-4 pt-4">
                <a href="" class="flex items-center px-3 py-2 truncate">
                    <div class="w-2 h-2 bg-pending rounded-full mr-3"></div> Custom Work
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                    <div class="w-2 h-2 bg-success rounded-full mr-3"></div> Important Meetings
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                    <div class="w-2 h-2 bg-warning rounded-full mr-3"></div> Work
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                    <div class="w-2 h-2 bg-pending rounded-full mr-3"></div> Design
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                    <div class="w-2 h-2 bg-danger rounded-full mr-3"></div> Next Week
                </a>
                <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md truncate">
                    <i class="w-4 h-4 mr-2" data-lucide="plus"></i> Add New Label
                </a>
            </div>
        </div>
        <!-- END: Inbox Side Menu -->
        <!-- BEGIN: Inbox Content -->
        <div class="col-span-12 xl:col-span-8 2xl:col-span-10 p-5">
            <div class="flex flex-wrap gap-y-5 items-center">
                <h2 class="text-2xl font-medium mr-auto">{{ $fakers[0]['news'][0]['title'] }}</h2>
                <div class="flex items-center">
                    <div class="">March 25, 09:29</div>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="settings"></i>
                    </a>
                    <div class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle w-5 h-5 ml-5 flex items-center justify-center" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="corner-up-right" class="w-4 h-4"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i> Reply to all
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i> Forward
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="archive" class="w-4 h-4 mr-2"></i> Report spam
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                    </a>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="flex items-center mt-5">
                <div class="w-9 h-9 flex-none image-fit relative">
                    <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $fakers[0]['photos'][0]) }}">
                </div>
                <div class="ml-3 mr-auto">
                    <div class="flex items-center flex-wrap gap-y-1">
                        <div class="font-medium mr-2">{{ $fakers[0]['users'][0]['name'] }}</div>
                        <div class="text-xs text-slate-500">{{ $fakers[0]['users'][0]['email'] }}</div>
                    </div>
                    <div class="dropdown" data-tw-placement="bottom-start">
                        <a href="javascript:;" class="dropdown-toggle flex items-center text-xs text-slate-500 mt-0.5" aria-expanded="false" data-tw-toggle="dropdown">
                            to me <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i> Mark as read
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i> Mark as unread
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="archive" class="w-4 h-4 mr-2"></i> Move to spam
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i> Move to trash
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <p class="mt-5">Hi {{ $fakers[0]['users'][1]['name'] }},</p>
                <p class="mt-5">{{ $fakers[1]['news'][0]['content'] }}</p>
                <p class="mt-5">{{ $fakers[2]['news'][0]['content'] }}</p>
                <p class="mt-5">{{ $fakers[3]['news'][0]['content'] }}</p>
                <p class="mt-5">{{ $fakers[4]['news'][0]['content'] }}</p>
                <p class="mt-5">Regards, <br> {{ $fakers[0]['users'][0]['name'] }}</p>
            </div>
            <div class="mt-10 pb-16">
                <div class="flex flex-wrap gap-y-2 mb-5">
                    <div class="mr-auto font-medium">Attachments (2 files, 200,05 MB)</div>
                    <div class="flex">
                        <a href="javascript:;" class="text-primary w-24">View All</a>
                        <a href="javascript:;" class="text-primary w-24 ml-2">Download All</a>
                    </div>
                </div>
                <div class="flex flex-wrap gap-y-2 mt-3">
                    <div class="mr-auto flex items-center">
                        <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> annual-report-2022.pdf (180.05 MB)
                    </div>
                    <div class="flex">
                        <a href="javascript:;" class="text-primary w-24">View</a>
                        <a href="javascript:;" class="text-primary w-24 ml-2">Download</a>
                    </div>
                </div>
                <div class="flex flex-wrap gap-y-2 mt-3">
                    <div class="mr-auto flex items-center">
                        <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> weekly-report-2022.pdf (20 MB)
                    </div>
                    <div class="flex">
                        <a href="javascript:;" class="text-primary w-24">View</a>
                        <a href="javascript:;" class="text-primary w-24 ml-2">Download</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Inbox Content -->
    </div>
@endsection
