@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a>Crear</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categorias</li>
@endsection

@section('subcontent')

    <div class="grid grid-cols-12 gap-6 mt-5" >
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

    
        
    <div class="grid grid-cols-12 gap-4 gap-y-5">
        <div class="col-span-12 sm:col-span-6">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Crear nueva categoria</h3>
                <form action="{{route('admin.nuevaCateg')}}" method="POST">
                @csrf
                    <div class="intro-y col-span-12 sm:col-span-6" >

                        <input required id="nombreCateg" type="text" class="form-control" name="nombreCateg" placeholder="Nueva categoria" style="width: 40%">
                    </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    
        <div class="col-span-12 sm:col-span-6">
            <div class="intro-y box p-5 mt-5">
                <h3 class="text-2xl mt-5 font-small">Crear nueva subcategoria</h3>
                <form action="{{route('admin.nuevaSubcateg')}}" method="POST">
                @csrf
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <select id="categ" name="categ" class="form-control @if(old('opc')=='1') @error('categ') is-invalid @enderror @endif" style="width: 40%">
                            @if (isset($categoria))
                                <option id="null" value="null">Selecciona una categoria</option>
                                @foreach ($categoria as $dato )
                                <option id="{{$dato->nombre}}" value="{{$dato->id}}" {{old('categ') == $dato->id ? 'selected="selected"' : '' }}> {{$dato->nombre }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">

                        <input required id="nombreSubc" type="text" class="form-control" name="nombreSubc" placeholder="Nueva subcategoria" style="width: 40%">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-6">
        <div class="intro-y box p-5 mt-5">
            <h3 class="text-2xl mt-5 font-small">Lista de subcategorias</h3>
            <div class="text-center mx-auto" style="padding-left: 10px" id="categs"></div>
        </div>
    </div>

    <div style="height: 65px;"></div>

@endsection

@section('script')
    <script>
        setTimeout(function(){
            document.getElementById("alerta").style.display="none";
        }, 4000);
    </script>

<script type="text/javascript">

        var c = {!! $tabla_subcategorias !!};

        var table = new Tabulator("#categs", {
            height: "10%",
            data: c,
            resizableColumns: false, 
            fitColumns: true,
            pagination: "local",
            paginationSize: 10,
            tooltips: true,
            groupBy: "categoria",
            groupHeader:function(value, count, data, group){ 
                return "<span style='font-weight:bold; font-size:14px;'>" + value + " (" + count + " items)</span>";
            },
            columns: [
                {
                    title: "ID",
                    field: "id",
                    visible: false,
                    width: 2,
                }, 
                {
                    title: "Nombre",
                    field: "nombre",
                    headerFilter: "input",
                    sorter: "string",
                }
            ],
        });
    </script>

@endsection