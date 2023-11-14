@extends('../layout/' . $layout)

@section('subhead')
    <title>Products - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Products</h2>
        <div class="w-full sm:w-auto flex flex-wrap gap-y-3 mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="plus"></i> Add New Product
            </button>
            <button class="btn box">
                <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> Download Report
            </button>
        </div>
    </div>
    <!-- BEGIN: Filter -->
    <div class="intro-y box p-5 mt-7 flex flex-col xl:flex-row gap-y-3">
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="crud-form-1" class="form-label">Product Name</label>
            <input id="crud-form-1" type="text" class="form-control w-full" placeholder="Product name..">
        </div>
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="crud-form-2" class="form-label">Category</label>
            <select class="tom-select w-full flex-1" id="crud-form-2" multiple>
                @foreach (array_slice($fakers, 0, 10) as $key => $faker)
                    <option value="{{ $faker['products'][0]['category'] }}" {{ $key < 1 ? 'selected' : '' }}>{{ $faker['products'][0]['category'] }}</option>
                @endforeach
            </select>
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
    <!-- END: Filter -->
    <!-- BEGIN: Data List -->
    <div class="intro-y overflow-auto lg:overflow-visible">
        <table class="table table-report">
            <tbody>
                @foreach (array_slice($fakers, 0, 9) as $faker)
                    <tr class="intro-x">
                        <td class="w-40 !py-5">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][1]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][2]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $faker['products'][0]['name'] }}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $faker['products'][0]['category'] }}</div>
                        </td>
                        <td class="text-center">{{ $faker['products'][0]['price'] }}</td>
                        <td class="text-center">{{ $faker['stocks'][0] }}</td>
                        <td class="w-40">
                            <div class="form-check form-switch">
                                <input class="form-check-input mx-auto" type="checkbox" {{ $faker['true_false'][0] ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="javascript:;">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
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
