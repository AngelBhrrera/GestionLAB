@extends('../layout/' . $layout)

@section('subhead')
    <title>Products - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="flex items-center text-lg font-medium mr-auto">
            Products <i class="w-4 h-4 mx-2 !stroke-2" data-lucide="arrow-right"></i> {{ $fakers[0]['products'][0]['name'] }}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> View Full Report
            </button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Product Detail Side Menu -->
        <div class="col-span-12 2xl:col-span-3">
            <div class="box intro-y p-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Product Details</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> Stock-Keeping Unit: INV-33807556
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> Release Date: 24 March 2022
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-500 mr-2"></i> Condition: <span class="text-xs text-success bg-success/20 border border-success/20 rounded-md px-1.5 py-0.5 ml-1">New</span>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="map" class="w-4 h-4 text-slate-500 mr-2"></i>  Category: <a href="" class="underline decoration-dotted ml-1">{{ $fakers[0]['products'][0]['category'] }}</a>
                </div>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Spesification</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="flex items-center">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> Brand: <a href="" class="underline decoration-dotted ml-1">Apple</a>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-500 mr-2"></i> Signal Status: Activated
                </div>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Description</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div>{{ $fakers[0]['news'][0]['short_content'] }}</div>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Product Images</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-2">
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][0]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][1]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][2]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][3]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][4]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][5]) }}">
                    </div>
                    <div class="image-fit col-span-3 h-16 cursor-pointer">
                        <img alt="Rocketman - HTML Admin Template" class="rounded-md" src="{{ asset('build/assets/images/' . $fakers[0]['images'][6]) }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Product Detail Side Menu -->
        <!-- BEGIN: Product Detail Content -->
        <div class="col-span-12 2xl:col-span-9">
            <div class="box intro-y p-3">
                <ul class="nav nav-pills flex-col md:flex-row" role="tablist">
                    <li id="active-transactions-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full flex items-center justify-center !rounded-lg py-3 active"
                            data-tw-toggle="pill"
                            data-tw-target="#active-transactions"
                            type="button"
                            role="tab"
                            aria-controls="active-transactions"
                            aria-selected="true"
                        >
                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Active Transactions
                        </button>
                    </li>
                    <li id="transaction-history-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full flex items-center justify-center !rounded-lg py-3"
                            data-tw-toggle="pill"
                            data-tw-target="#transaction-history"
                            type="button"
                            role="tab"
                            aria-selected="false"
                        >
                            <i data-lucide="inbox" class="w-4 h-4 mr-2"></i> Transaction History
                        </button>
                    </li>
                    <li id="stock-management-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full flex items-center justify-center !rounded-lg py-3"
                            data-tw-toggle="pill"
                            data-tw-target="#stock-management"
                            type="button"
                            role="tab"
                            aria-selected="false"
                        >
                            <i data-lucide="hard-drive" class="w-4 h-4 mr-2"></i> Stock Management
                        </button>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="active-transactions" class="tab-pane active" role="tabpanel" aria-labelledby="active-transactions-tab">
                    <div class="box p-5 intro-y mt-5">
                        <div class="flex flex-col xl:flex-row gap-y-3">
                            <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
                                <label for="crud-form-1" class="form-label">Invoice</label>
                                <input id="crud-form-1" type="text" class="form-control w-full" placeholder="Invoice..">
                            </div>
                            <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
                                <label for="crud-form-1" class="form-label">Status</label>
                                <select class="form-select w-full" aria-label="Default select example">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                            <button class="btn btn-primary shadow-md">
                                <i class="w-4 h-4 mr-2" data-lucide="search"></i> Filter
                            </button>
                        </div>
                        <div class="overflow-auto lg:overflow-visible">
                            <table class="table table-striped mt-5">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap !py-5">Invoice</th>
                                        <th class="whitespace-nowrap">Status</th>
                                        <th class="whitespace-nowrap">Buyer Name</th>
                                        <th class="whitespace-nowrap">Payment</th>
                                        <th class="whitespace-nowrap text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (array_slice($fakers, 0, 12) as $faker)
                                        <tr>
                                            <td class="!py-7">
                                                <a href="" class="underline decoration-dotted whitespace-nowrap">{{ '#INV-' . $faker['totals'][0] . '807556' }}</a>
                                            </td>
                                            <td>
                                                <div class="font-medium whitespace-nowrap">{{ $faker['users'][0]['name'] }}</div>
                                                @if ($faker['true_false'][0])
                                                    <div class="mt-1 text-xs text-slate-500">Ohio, Ohio</div>
                                                @else
                                                    <div class="mt-1 text-xs text-slate-500">California, LA</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($faker['true_false'][0])
                                                    <span class="text-xs whitespace-nowrap text-success bg-success/20 border border-success/20 rounded-full px-2 py-1">Shipping</span>
                                                @else
                                                    <span class="text-xs whitespace-nowrap text-warning bg-warning/20 border border-warning/20 rounded-full px-2 py-1">Pending Payment</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($faker['true_false'][0])
                                                    <div class="whitespace-nowrap">Checking payments</div>
                                                    <div class="mt-1 text-xs text-slate-500">25 March, 12:55</div>
                                                @else
                                                    <div class="whitespace-nowrap">Direct bank transfer</div>
                                                    <div class="mt-1 text-xs text-slate-500">30 March, 11:00</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="flex items-center whitespace-nowrap justify-center" href="javascript:;">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- BEGIN: Pagination -->
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5 mb-16">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <select class="w-20 form-select box mt-3 sm:mt-0">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                    <!-- END: Pagination -->
                </div>
            </div>
        </div>
        <!-- END: Product Detail Content -->
    </div>
@endsection
