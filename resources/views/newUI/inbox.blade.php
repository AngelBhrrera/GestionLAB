@extends('../layout/' . $layout)

@section('subhead')
    <title>Inbox - Rocketman - Tailwind HTML Admin Template</title>
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
        <div class="inbox col-span-12 xl:col-span-8 2xl:col-span-10">
            <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 border-b border-slate-200/60 dark:border-darkmode-400 mb-4 pb-5">
                <button class="btn btn-outline-secondary mr-2">
                    <i class="w-4 h-4 mr-2" data-lucide="users"></i> Create Group
                </button>
                <button class="btn btn-outline-secondary mr-auto">
                    <i class="w-4 h-4 mr-2" data-lucide="video"></i> Start a Video Call
                </button>
                <div class="w-[350px] relative">
                    <input type="text" class="form-control pl-10" placeholder="Search for messages or users...">
                    <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
                </div>
            </div>
            <div class="px-5 pb-4 flex flex-col-reverse sm:flex-row text-slate-500 border-b border-slate-200/60">
                <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-slate-200/60 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                    <input class="form-check-input" type="checkbox">
                    <div class="dropdown ml-1" data-tw-placement="bottom-start">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </a>
                        <div class="dropdown-menu w-32">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item">All</a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">None</a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">Read</a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">Unread</a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">Starred</a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">Unstarred</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="refresh-cw"></i>
                    </a>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="more-horizontal"></i>
                    </a>
                </div>
                <div class="flex items-center sm:ml-auto">
                    <div class="">1 - 50 of 5,238</div>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                    </a>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </a>
                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="settings"></i>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto sm:overflow-x-visible">
                @foreach ($fakers as $faker)
                    <div class="intro-y">
                        <div class="inbox__item{{ $faker['true_false'][0] ? ' inbox__item--active' : '' }} inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                            <div class="flex px-5 py-3">
                                <div class="w-72 flex-none flex items-center mr-5">
                                    <input class="form-check-input flex-none" type="checkbox" {{ !$faker['true_false'][0] ? 'checked' : '' }}>
                                    <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-slate-400">
                                        <i class="w-4 h-4" data-lucide="star"></i>
                                    </a>
                                    <a href="javascript:;" class="w-5 h-5 flex-none ml-2 flex items-center justify-center text-slate-400">
                                        <i class="w-4 h-4" data-lucide="bookmark"></i>
                                    </a>
                                    <div class="w-6 h-6 flex-none image-fit relative ml-5">
                                        <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                                    </div>
                                    <div class="inbox__item--sender truncate ml-3">{{ $faker['users'][0]['name'] }}</div>
                                </div>
                                <div class="w-64 sm:w-auto truncate">
                                    <span class="inbox__item--highlight">{{ $faker['news'][0]['super_short_content'] }}</span> {{ $faker['news'][0]['short_content'] }}
                                </div>
                                <div class="inbox__item--time whitespace-nowrap ml-auto pl-10">{{ $faker['times'][0] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-slate-500">
                <div>4.41 GB (25%) of 17 GB used Manage</div>
                <div class="sm:ml-auto mt-2 sm:mt-0">Last account activity: 36 minutes ago</div>
            </div>
        </div>
        <!-- END: Inbox Content -->
    </div>
@endsection
