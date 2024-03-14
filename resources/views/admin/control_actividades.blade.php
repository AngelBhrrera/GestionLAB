@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Control de Actividades</a></li>
@endsection

@section('subcontent')

<div class="container" style="padding-top: 20px; padding-left: 20px;">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
            @if (session('success'))
                <div class="alert alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('nombre')
                <div class="alert alert-danger w-full px-4">{{$message}}</div>
            @enderror
                </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified" role="tablist">  
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#lact">Lista de Actividades Registradas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lcat">Lista de Categorias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#lsub">Lista de Subcategorias</a>
        </li>
        @if(Auth::user()->tipo == 'Superadmin' || Auth::user()->tipo == 'jefe sede')
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#rcat">Crear nueva Categoria</a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#rsub">Crear nueva Subcategoria</a>
        </li>
        
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="lact">

                <div class="intro-y box p-5 mt-5">
                    <h3 class="text-2xl mt-5 font-small">Lista de Actividades</h3>
                    <div class="text-center mx-auto" style="padding-left: 10px" id="activ"></div>
                </div>

        </div>

        <div class="tab-pane" id="lcat">
            <div class="col-span-12 sm:col-span-6">
                <div class="intro-y box p-5 mt-5">
                    <h3 class="text-2xl mt-5 font-small">Lista de Categorias</h3>
                    <div class="text-center mx-auto" style="padding-left: 10px" id="categs"></div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="lsub">
            <div class="col-span-12 sm:col-span-6">
                <div class="intro-y box p-5 mt-5">
                    <h3 class="text-2xl mt-5 font-small">Lista de Subcategorias</h3>
                    <div class="text-center mx-auto" style="padding-left: 10px" id="subcategs"></div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="rcat">
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

        <div class="tab-pane" id="rsub">
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
</div>

@endsection

@section('script')
    <script>
        setTimeout(function(){
            document.getElementById("alerta").style.display="none";
        }, 4000);
    </script>

<script type="text/javascript">


        var a = {!! $tabla_actividades !!}; 
        var c = {!! $tabla_categorias !!};
        var sc = {!! $tabla_subcategorias !!};

        function createTabulatorInstance(selector, data, config) {
                return new Tabulator(selector, {
                    ...config,
                    data: data,
                });
            }

        var commonConfig = {
            paginationSize: 20,
            pagination: "local",
            layout: "fitDataFill",
            resizableColumns:false,
            virtualDomHoz:true,
            tooltips: true,
        };

        var table = createTabulatorInstance("#subcategs", sc, {
            ...commonConfig,
            columns: [
                {
                    title: "ID",
                    field: "id",
                    visible: false,
                    width: 2,
                },  {
                    title: "Nombre",
                    field: "nombre",
                    sorter: "string",
                },  {
                    title: "Eliminar",
                    field: "id",
                    formatter: function (cell, formatterParams, onRendered) {
                        var value = cell.getValue();
                        var button = document.createElement("button");
                        button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                        button.textContent = "Eliminar X";
                        button.addEventListener("click", function() {
                            eliminarUsuario(value);
                        });
                        return button;
                    },     
                },
            ]
        });

        var table2 = createTabulatorInstance("#categs", c, {
            ...commonConfig,
            columns: [
                {
                    title: "ID",
                    field: "id",
                    visible: false,
                    width: 2,
                },  {
                    title: "Nombre",
                    field: "nombre",
                    sorter: "string",
                },   {
                    title: "Actividades relacionadas",
                    field: "total_actividades",
                    sorter: "number",
                },   {
                    title: "Subcategorias relacionadas",
                    field: "total_subcategorias",
                    sorter: "number",
                }, {
                    title: "Modificar",
                    field: "datos",
                }, {
                    title: "Eliminar",
                    field: "id",
                    formatter: function (cell, formatterParams, onRendered) {
                        var value = cell.getValue();
                        var button = document.createElement("button");
                        button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                        button.textContent = "Eliminar X";
                        button.addEventListener("click", function() {
                            eliminarUsuario(value);
                        });
                        return button;
                    },     
                },
            ]

        });

        var table3 = createTabulatorInstance("#activ", a, {
            ...commonConfig,
            columns: [
                {
                    title: "ID",
                    field: "id",
                    visible: false,
                    width: 2,
                },  {
                    title: "Titulo",
                    field: "titulo",
                    sorter: "string",
                },   {
                    title: "TEC",
                    field: "TEC",
                    sorter: "number",
                },   {
                    title: "Experiencia",
                    field: "exp_ref",
                    sorter: "number",
                }, {
                    title: "Categoria",
                    field: "categoria",
                    sorter: "string",
                },   {
                    title: "Subcategoria",
                    field: "subcategoria",
                    sorter: "string",
                },   {
                    title: "Descripcion",
                    field: "descripcion",
                }, {
                    title: "Recursos",
                    field: "recursos",
                }, {
                    title: "Objetivos",
                    field: "objetivos",
                }, {
                    title: "Modificar",
                    field: "datos", 
                },  {
                    title: "Eliminar",
                    field: "id",
                    formatter: function (cell, formatterParams, onRendered) {
                        var value = cell.getValue();
                        var button = document.createElement("button");
                        button.style = "background-color: red; color: white; border: 1px solid dark-red; padding: 5px 15px; border-radius: 5px; font-size: 16px;";
                        button.textContent = "Eliminar X";
                        button.addEventListener("click", function() {
                            eliminarUsuario(value);
                        });
                        return button;
                    },     
                },
            ]
        });


    </script>

@endsection