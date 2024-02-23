@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion</li>
    <li class="breadcrumb-item active" aria-current="page">Ver reportes parciales</li>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col  mt-8 ml-5">
        <h2 class="text-lg font-medium mr-auto">Reportes</h2>
        <div class="grid grid-cols-12 gap-6 mt-5 mb-5">
            <div class="intro-y col-span-12 lg:col-span-6" id="alerta">
                @if (session('success'))
                    <h6 class="alert alert-success">{{session('success')}}</h6>     
                @endif
                
                @if(session('warning'))
                    <h6 class="alert alert-warning">{{session('warning')}}</h6>  
                @endif

                @error('nombre')
                    <h6 class="alert alert-danger">{{$message}}</h6>
                @enderror
            </div>
        </div>
        <form action="{{route('admin.busqueda_reportes_parciales')}}", method="POST">
            @csrf
            <input type="hidden" value="porCodigo" name="modo">
            <div class="w-[350px] relative mr-5">
                <input name="busqueda" type="text" class="form-control pl-10" placeholder="Buscar por código">
                <i class="w-5 h-5 absolute inset-y-0 left-0 my-auto text-slate-400 ml-3" data-lucide="search"></i>
            </div>
            <br>
            <div class="w-[350px] relative">
                <button class="btn btn-primary">
                    Buscar
                </button>
            </div>
        </form>
    </div>
    
    <div class="box grid grid-cols-12 mt-5 ml-5 mr-5">
        <!-- BEGIN: Inbox Content -->
        <div class="inbox col-span-12 xl:col-span-8 2xl:col-span-10">
            <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 border-b border-slate-200/60 dark:border-darkmode-400 mb-4 pb-5">
                Reportes guardados: -
            <br>
            </div>
           

                <div class="flex flex-wrap gap-y-3 items-center px-5 pt-5 ">
                    No hay reportes para mostrar
                </div>
            <div class="px-5 pb-4 grid grid-cols-12 gap-3 sm:gap-6 border-b border-slate-200/60">
                
            </div>
        </div>
    </div>
    <!-- END: Inbox Content -->

    <div class="box grid grid-cols-12 mt-5 ml-5 mr-5">
        <!-- BEGIN: Inbox Content -->
        <div class="inbox col-span-12 xl:col-span-8 2xl:col-span-10">
            <div class="flex gap-y-3 items-center px-5 pt-5 border-b border-slate-200/60 dark:border-darkmode-400 mb-4 pb-5">
                 <h3 class="text-2xl mt-5 font-small">Lista de prestadores</h3>
            </div>
            <div class="px-5 pb-4 sm:gap-6 border-b border-slate-200/60">
                <div class="text-center mx-auto" style="padding-left: 10px" id="prestadores"></div>
            </div>
        </div>    
    </div>

@endsection

@section('script')
    <script type="text/javascript">

    var prestadores = {!! $prestadores !!};

    var table = new Tabulator("#prestadores", {
        height:"100%",
        data: prestadores,
        resizableColumns: "false",
        layout: "fitColumns",
        pagination: "local",
        paginationSize: 10,
        tooltips: true,
        columns: [{
                title: "ID",
                field: "id",
                visible: false,
                width: 2,
            }, {
                title: "Nombre",
                field: "name",
                headerFilter: "input",
                sorter: "string",
                editor: "input",
            },{
                title: "Apellido",
                field: "apellido",
                headerFilter: "input",
                sorter: "string",
                editor: "input",
            },{
                title: "Ver Reportes",
                field: "total_personal",
                width: 100,
                sorter: "string",
            },
        ],
    });
    </script>
@endsection