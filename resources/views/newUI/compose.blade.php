@extends('../layout/' . $layout)

@section('subhead')
    <title>Compose - Rocketman - Tailwind HTML Admin Template</title>
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
                <a href="" class="flex items-center px-3 py-2 rounded-md">
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
        <div class="col-span-12 xl:col-span-8 2xl:col-span-10 p-5 pb-16">
            <div class="form-inline flex-col 2xl:flex-row gap-y-3 items-start 2xl:items-center">
                <label for="to" class="form-label sm:w-20 !text-left 2xl:!text-right">To</label>
                <select class="tom-select w-full flex-1" id="to" multiple>
                    @foreach (array_slice($fakers, 0, 10) as $faker)
                        <option value="{{ $faker['users'][0]['email'] }}" {{ $faker['true_false'][0] ? '' : 'selected' }}>{{ $faker['users'][0]['email'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-inline flex-col 2xl:flex-row gap-y-3 items-start 2xl:items-center mt-5">
                <label for="cc" class="form-label sm:w-20 !text-left 2xl:!text-right">Cc</label>
                <select class="tom-select w-full flex-1" id="cc" multiple>
                    @foreach (array_slice($fakers, 0, 10) as $faker)
                        <option value="{{ $faker['users'][0]['email'] }}">{{ $faker['users'][0]['email'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-inline flex-col 2xl:flex-row gap-y-3 items-start 2xl:items-center mt-5">
                <label for="mail" class="form-label sm:w-20 !text-left 2xl:!text-right">Subject</label>
                <input id="mail" type="text" class="form-control">
            </div>
            <div class="form-inline flex-col 2xl:flex-row gap-y-3 items-start 2xl:items-center mt-5">
                <label class="form-label sm:w-20 !text-left 2xl:!text-right">Mail</label>
                <div class="w-full flex-1">
                    <div class="editor">
                        <p>Content of the editor.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 2xl:ml-20 2xl:pl-5">
                <button type="button" class="btn btn-primary w-24 mr-1">Send</button>
                <button type="button" class="btn btn-outline-secondary w-24">Cancel</button>
            </div>
        </div>
        <!-- END: Inbox Content -->
    </div>
@endsection

@section('script')
    <script src="{{ mix('build/assets/js/ckeditor-classic.js') }}"></script>
@endsection
