@extends('../layouts/main')

@section('head')
<html class='dark'>
    @yield('subhead')
@endsection


@section('content')
<body class="main">
    <div class="xl:pl-5 xl:py-5 flex h-screen">
        <nav class="side-nav">
            <!-- BEGIN: Side Menu -->
            <div class="pt-4 mb-4">
                <div class="side-nav__header flex items-center">
                    <a href="" class="intro-x flex items-center">
                        <img alt="logo" class="side-nav__header__logo" src="{{ asset('build/assets/images/Inventores.png') }}">
                        <span class="side-nav__header__text pt-0.5 text-lg ml-2.5"> Menu </span> 
                    </a>
                    <a href="javascript:;" class="side-nav__header__toggler hidden xl:block ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="arrow-left-circle" class="w-5 h-5"></i> </a>
                    <a href="javascript:;" class="mobile-menu-toggler xl:hidden ml-auto text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5"> <i data-lucide="x-circle" class="w-5 h-5"></i> </a>
                </div>
            </div>

            <div class="scrollable">
                <ul class="scrollable__content">
                    <li class="side-nav__devider mb-4">MENU</li>

                    <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                    REGISTROS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.registro')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Usuarios</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Visita</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Recompensas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.C_Actividades')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Actividades a prestadores</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.faltas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Nueva categoria</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                    ASISTENCIAS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.firmas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Registro de Asistencia</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.firmasPendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Registro de Asistencia Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.faltas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Faltas</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                    PRESTADORES
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.prestadores')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Activos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadoresPendientes')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_inactivos')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Inactivos</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_terminados')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Servicio concluido</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.prestadores_liberados')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Servicio liberado</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                    USUARIOS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.general')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">General</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.clientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Clientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Visitas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.administradores') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="x"></i> </div>
                                        <div class="side-menu__title">Administradores</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:;" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                                <div class="side-menu__title">
                                    ACTIVIDADES
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{ route('admin.actividades') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                        <div class="side-menu__title"> Creadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.actividades_en_progreso') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                                        <div class="side-menu__title">En Proceso </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.actividades_revision') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-plus-2"></i> </div>
                                        <div class="side-menu__title">En Revisión</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tabla_terminados') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-input"></i> </div>
                                        <div class="side-menu__title">Aprobadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tabla_actividades_canceladas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="list-checks"></i> </div>
                                        <div class="side-menu__title">Canceladas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('actividades_prestadores_revisadas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-check-2"></i> </div>
                                        <div class="side-menu__title"> Actividades revisadas </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('actividades_canceladas')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="file-x-2"></i> </div>
                                        <div class="side-menu__title"> Actividades con error </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title">
                                CATALOGOS
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{route('admin.horarios')}}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="clock"></i> </div>
                                        <div class="side-menu__title">Horario Prestadores</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.clientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Tipos de Actividades</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.diasfestivos') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="check"></i> </div>
                                        <div class="side-menu__title">Dias no Laborales</div>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript:;" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                                <div class="side-menu__title">
                                    IMPRESIONES
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="{{ route('admin.citas') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="plus-circle"></i> </div>
                                        <div class="side-menu__title">Solicitudes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.citas_pendientes') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">Citas por confirmar </div>
                                    </a>
                                </li>
                                <li>
                                    <a hhref="{{ route('admin.ProyectosCitados') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">Programadas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">Prestador Pendientes</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos2') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">Prestadore Terminadas</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.prestadoresProyectos3') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                                        <div class="side-menu__title">Completadass</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    {{ __('Cerrar sesion') }}
                                </p>
                            </a>
                            </form>
                        </li>

                    </li>
                </ul>
            </div>
        <!-- END: Side Menu -->
        </nav>

        <div class="wrapper">
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                    <!-- END: Breadcrumb -->

                    <!-- BEGIN: Intermede -->
                        <!-- Navbar -->
                            <nav class="main-header navbar navbar-expand navbar-white navbar-light">

                                    <li class="nav-item d-none d-sm-inline-block">
                                        <a class="nav-link" type="button" href="{{ route('admin.checkin')  }}">Check-In</a>
                                    </li>
                                    
                                    @if (Auth::user()->can_admin == 1)
                                    <li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.cambiorol') }}">
                                                <i class="nav-icon fas fa-sync-alt"></i>
                                                <p>
                                                {{ __('Cambiar a prestador') }}
                                                </p>
                                            </a>
                                    </li>
                                    @endif

                            </nav>
                        <!-- /.navbar -->
                    <div class="intro-x relative ml-auto sm:mx-auto"> </div>
                    <!-- END: Intermede -->
                       
                    <!-- Comienza menu cuenta-->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                            @if(isset(Auth::user()->image))
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('build/assets/images/placeholders/avatar5.png')}}">
                            @else
                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('build/assets/images/placeholders/'.Auth::user()->imagen_perfil)}}">
                            @endif
                            </div>
                            <div class="hidden md:block ml-3">
                                <div class="max-w-[7rem] truncate font-medium">{{$username=Auth::user()->name}}</div>
                                <div class="text-xs text-slate-400">{{$userRol=ucfirst(Auth::user()->tipo)}}</div>
                            </div>
                        </div>

                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="{{ route('perfil') }}" class="dropdown-item"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil </a>
                                </li>
                                <li>
                                    <a href="{{route('password.request')}}" class="dropdown-item"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Cambiar contraseña </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Ayuda </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar sesión </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div  class="container" style="padding: 20px 15px 0px 15px">
                @yield('subcontent')

            </div>
        </div>  
    </div>    

</body>

@endsection



@section('script')
    
        <!-- JQuery -->
        <script src={{asset('plugins/jquery/jquery.min.js')}}></script>
        <!-- Bootstrap 4 -->
        <script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
        <!-- AdminLTE App -->
        <script src={{asset('dist/js/adminlte.min.js')}}></script>
        <!-- DataTables  & Plugins -->
        <script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
        <script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
        <script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
        <script src={{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
        <script src={{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
        <script src={{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
        <script src={{asset('plugins/jszip/jszip.min.js')}}></script>
        <script src={{asset('plugins/pdfmake/pdfmake.min.js')}}></script>
        <script src={{asset('plugins/pdfmake/vfs_fonts.js')}}></script>
        <script src={{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
        <script src={{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
        <script src={{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>
        <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
        <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>

        {{-- <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
        {{-- <script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script> --}}
        {{-- <script src="{{asset('plugins/moment/moment.min.js')}}"></script> --}}

    <script type="text/javascript">
        $('#alert').fadeIn();
        setTimeout(function() {
            $("#alert").fadeOut();
        },5000);

        $(function () {
            tabla = $("#example1").DataTable({
                "order": [[ 0, 'desc' ]],
                serverSide: true,
                buttons:true,
                ajax: {
                    url:'{{route($ajaxroute)}}',
                    data:{
                        "token": "{{ csrf_token() }}",
                    },
                },
                columns:{!!$columnas!!},
                pageLength: 9,
                ordering: true,
                "responsive": true, "lengthChange": true, "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    {extend: 'copy', text: 'Copiar'},
                    {extend: 'print', text: 'Imprimir'},
                    "csv",
                    "excel",
                    "pdf",
                    ],
                "oLanguage": {
                    "sSearch": "Buscar:",
                    "sEmptyTable": "No hay informacion que mostrar",
                    "sInfo": "Mostrando  del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    },


            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('.dataTables_length').addClass('bs-select');

            $('.duallistbox').bootstrapDualListbox()
            $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-calendar' },
                    daysOfWeekDisabled: [0],
                    format: 'DD/MM/YYYY',
                    minDate:new Date(),
                    });
            });


        //actualizar horas
        function actualizarb(src, responsable){

            var url = '{{route('api.actualizarb')}}';
            var horas = src.value;
            var nombre = src.name;
        //alert(responsable.id+" "+responsable.name+" "+responsable.apellido);

            if(src.value == ""){
                horas = 0;
            }
            $.ajax({
                type:"POST",
                url: url,
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id":src.name,
                    "horas":horas,
                    "responsable":responsable.id+" "+responsable.name+" "+responsable.apellido
                },
            });
        }

        function actualizarstatus(src){

            var url = '{{route('api.actualizarstatus')}}';
            $.ajax({
                type:"POST",
                url: url,
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id":src.name,
                    "status":src.value,
                },
            });
        }

        function modalhoras(id,nombre){
            $('#modeldelete').modal({
                keyboard: true,
                backdrop: "static",
                show:false,
            })
            document.getElementById("Mhid").value = id;
            document.getElementById("txtmodalhoras").innerHTML ='Usuario: ' + nombre;
        }

        function modelId(id) {
                $('#modalcomp').modal({
                    keyboard: true,
                    backdrop: "static",
                    show: false,
                })
                //alert(id);
                document.getElementById("id_actividad2").value = id;
        }

        function modalvalidar(id){
            $('#modeldelete').modal({
                keyboard: true,
                backdrop: "static",
                show:false,
            })
            document.getElementById("idvalidar").value = id;
            document.getElementById("tipoEliminar").value = "admin.prestadoresPendientes";
        }

        function modalact(actividad){
            $('#modelact').modal({
                keyboard: true,
                backdrop: "static",
                show:false,
            })

            document.getElementById("ida").value = actividad["id_actividad"];
            document.getElementById("idinfoact").innerHTML = actividad['id_actividad'];
            document.getElementById("nombreinfoact").innerHTML = actividad['nombre_act'];
            document.getElementById("descinfoact").innerHTML = actividad['descripcion'];
            document.getElementById("objinfoact").innerHTML = actividad['objetivo'];
            document.getElementById("fechainfo").innerHTML = actividad['fecha'];
            document.getElementById("statusact").innerHTML = actividad['status'];
            document.getElementById("imagenreporte").src = "../imagen/registros/imagenes/"+actividad['imagen'];
            document.getElementById("estimacion_tiempo").innerHTML = actividad['estimacion_tiempo'];
            document.getElementById("duracion").innerHTML = actividad['duracion'];
            document.getElementById("nombre_categoria").innerHTML = actividad['nombre_categoria'];
            document.getElementById("nombre_actividad").innerHTML = actividad['nombre_actividad'];
            document.getElementById("asignado_a").innerHTML = actividad['nombre_prestador'];

            // document.getElementById("enlaceZip").href =  "../imagen/registros/zips/"+actividad['archivo'];
            // document.getElementById("asignado_a").innerHTML = actividad['asignado_a'];
            // document.getElementById("tipoinfoact").innerHTML = actividad['tipo_act'];

            if(actividad['archivo']){
                document.getElementById("divzipactividad").style.display = "block";
            }else{
                document.getElementById("divzipactividad").style.display = "none";
            }
            if(actividad['imagen']){
                document.getElementById("divimagenactividad").style.display = "block";
            }else{
                document.getElementById("divimagenactividad").style.display = "none";
            }

            if (actividad['experiencia_obtenida'] && actividad['experiencia_obtenida'].trim().length > 0) {
                document.getElementById("divexperienciaobtenida").style.display = "block";
                document.getElementById("experiencia_obtenida").innerHTML = actividad['experiencia_obtenida'];
            } else {
                document.getElementById("divexperienciaobtenida").style.display = "none";
            }
        }

    </script>

@endsection

