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
                <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
            @endif
            @if(session('warning'))
                <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
            @endif
            @error('nombre')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
            @error('nombreSub')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
            @error('categoria')
                <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
            @enderror
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
        <!-- BEGIN: Modal 1 Content -->
    <div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5"></div>
                        <h2 class="text-2xl mt-5 font-small">Modificar nombre de categoría</h2><br>
                        
                        <form action="{{route('admin.modificar_categoria')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <label for="nombre">Nombre</label>
                            <input pattern="[A-Za-z]*" id="nombre" value="" type="text" class="form-control" name="nombre" placeholder="nombre" style="width: 200px">
                        
                            <div class="intro-y col-span-12 sm:col-span-6" id="divCarrera">
                                <br>
                                <div class="text-center">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Cancelar</button>
                                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Modal 2 Content -->
    <div id="static-backdrop-modal-preview-2" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5"></div>
                        <h2 class="text-2xl mt-5 font-small">Modificar nombre de categoría</h2><br>
                        
                        <form action="{{route('admin.modificar_subCategoria')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id_subCategoria" name="id_subCategoria">
                            <label class="mr-2" for="nombre">Nombre</label>
                            <input  id="nombreSub" value="" type="text" class="form-control" name="nombreSub" placeholder="nombre" style="width: 200px">
                            <br><br><label for="categoria">Categoría</label>
                            <select style="width: 200px" class="form-control" name="categoria" id="categoria">
                                <option value="{{null}}">Seleccione una categoría</option>
                                @foreach(json_decode($tabla_categorias) as $categoria)
                                    <option class="opcion_cat" value="{{$categoria->id}}" id="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <br>
                                <div class="text-center">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Cancelar</button>
                                    <button type="submit" class="btn btn-primary w-24">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                },{
                    title: "Categoria",
                    field: "categoria",
                    sorter: "string",
                },  
                {
                    title: "Editar",
                    field: "editar",
                    formatter: customButtonFormatter2,
                },
                {
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
                },
                {
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
                    formatter: customButtonFormatter,
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
                            eliminarActividad(value);
                        });
                        return button;
                    },     
                },
            ]
        });

        function customButtonFormatter(cell, formatterParams, onRendered) {
            var div = document.createElement("div");
            div.classList.add("text-center");
            
            var a = document.createElement("a");
            a.href = "javascript:;";
            a.setAttribute("data-tw-toggle", "modal");
            a.setAttribute("data-tw-target", "#static-backdrop-modal-preview");
            a.classList.add("btn", "btn-primary");
            a.textContent = "Modificar";

            div.appendChild(a);
            a.addEventListener('click', function(){
                var data = cell.getRow().getData();
                document.getElementById('nombre').value = data.nombre;
                document.getElementById('id_categoria').value = data.id;
            });
            return div;
        }

        function customButtonFormatter2(cell, formatterParams, onRendered) {
            var div = document.createElement("div");
            div.classList.add("text-center");
            
            var a = document.createElement("a");
            a.href = "javascript:;";
            a.setAttribute("data-tw-toggle", "modal");
            a.setAttribute("data-tw-target", "#static-backdrop-modal-preview-2");
            a.classList.add("btn", "btn-primary");
            a.textContent = "Modificar";

            div.appendChild(a);
            a.addEventListener('click', function(){
                var data = cell.getRow().getData();
                document.getElementById('nombreSub').value = data.nombre;
                document.getElementById('id_subCategoria').value = data.id;
                var cats = document.querySelectorAll('.opcion_cat');
                cats.forEach(function(c){
                    if(c.id == data.categoria){
                        c.selected = true;
                    }
                });
            });
            return div;
        }

        function eliminarActividad(value) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`eliminar_actividad/${value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al eliminar la actividad');
                }
                return response.json();
            })
            .then(data => {
                // La redirección al volver atrás refrescará la página, lo que
                // hará que se muestren los mensajes de sesión
                window.location.href = window.location.href;
            })
            .catch(error => {
                console.error('Error al eliminar:', error);
            });
        }


    </script>

@endsection