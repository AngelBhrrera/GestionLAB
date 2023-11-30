@extends('../layout/' . $layout)

@section('subhead')
    <title>Orders - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Orders</h2>
        <div class="w-full sm:w-auto flex flex-wrap gap-y-3 mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="download"></i> Download Report
            </button>
            <button class="btn box">
                <i class="w-4 h-4 mr-2" data-lucide="upload-cloud"></i> Cloud Backup
            </button>
        </div>
    </div>
    <!-- BEGIN: Filter -->
    <div class="intro-y box p-5 mt-7 flex flex-col xl:flex-row gap-y-3">
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="invoice" class="form-label">Invoice</label>
            <input id="invoice" type="text" class="form-control w-full" placeholder="Invoice..">
        </div>
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="buyer-name" class="form-label">Buyer Name</label>
            <input id="buyer-name" type="text" class="form-control w-full" placeholder="Buyer name..">
        </div>
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="status" class="form-label">Status</label>
            <select id="status" class="form-select w-full" aria-label="Default select example">
                <option selected>Pending Payment</option>
                <option>Confirmed</option>
                <option>Packing</option>
                <option>Shipping</option>
                <option>Completed</option>
            </select>
        </div>
        <button class="btn btn-primary shadow-md">
            <i class="w-4 h-4 mr-2" data-lucide="search"></i> Filter
        </button>
    </div>
    <!-- END: Filter -->
    <!-- BEGIN: Data List -->
    <div class="intro-y overflow-auto lg:overflow-visible">
        <table class="table table-report">
            <tbody>
                @foreach (array_slice($fakers, 0, 9) as $faker)
                    <tr class="intro-x">
                        <td class="w-40 !py-8">
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
                                <span class="text-xs whitespace-nowrap text-success bg-success/20 border border-success/20 rounded-full px-2 py-1">Completed</span>
                            @else
                                <span class="text-xs whitespace-nowrap text-warning bg-warning/20 border border-warning/20 rounded-full px-2 py-1">Pending Payment</span>
                            @endif
                        </td>
                        <td>
                            @if ($faker['true_false'][0])
                                <div class="whitespace-nowrap">Direct bank transfer</div>
                                <div class="mt-1 text-xs text-slate-500">25 March, 12:55</div>
                            @else
                                <div class="whitespace-nowrap">Checking payments</div>
                                <div class="mt-1 text-xs text-slate-500">30 March, 11:00</div>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="pr-16">${{ $faker['totals'][0] . ',000,00' }}</div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center whitespace-nowrap mr-3" href="javascript:;">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> View Details
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5 mb-12">
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
@endsection
