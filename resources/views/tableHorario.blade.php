<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href={{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}>
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
  <!-- DataTables -->
  <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>

  <link rel="stylesheet" href={{ asset('css/dobletabla.css') }}>
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
  <link rel="icon" href="{{asset('img/recursos/logo-bowser.ico') }}"/>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="modal fade" id="modeldeletefecha" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                </div>


                    <form  method="POST" id="formeliminar" action="{{ route('api.eliminarhorario') }}">

                        <input  id="opcionEliminar" name="opcion" type="hidden">
                        <input  id="idEliminar" name="id" type="hidden">
                        <input  id="tipoEliminar" name="TipoOriginal" type="hidden" >

                        @csrf

                        <p id="txtmodalEliminar">Hello World!</p>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                            <button type="submit"  class="btn btn-danger">borrar</button>

                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="content">
        @include('alerta')
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">{{'Nueva horario'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{route('api.guardarhorario')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Horario</label>
                                <div class="col-md-6">
                                      <input type="text"
                                        class="form-control" name="horario" id="horario">

                                        {{-- checkbox de dias --}}
                                        <br>
                                        <div class="btn-group" data-toggle="buttons">
                                            <input type='hidden' value='0' name='lunes'>
                                            <input type='hidden' value='0' name='martes'>
                                            <input type='hidden' value='0' name='miercoles'>
                                            <input type='hidden' value='0' name='jueves'>
                                            <input type='hidden' value='0' name='viernes'>
                                            <input type='hidden' value='0' name='sabado'>
                                            <input type='hidden' value='0' name='domingo'>
                                            <label class="btn btn-primary active">
                                                Lunes
                                                <input type="checkbox" name="lunes" id="lunes" value="1"  autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Martes
                                                <input type="checkbox" name="martes" id="martes" value="1" autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Miercoles
                                                <input type="checkbox" name="miercoles" id="miercoles" value="1" autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Jueves
                                                <input type="checkbox" name="jueves" id="jueves" value="1" autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Viernes
                                                <input type="checkbox" name="viernes" id="viernes" value="1" autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Sabado
                                                <input type="checkbox" name="sabado" id="sabado" value="1" autocomplete="off">
                                            </label>
                                            <label class="btn btn-primary">
                                                Domingo
                                                <input type="checkbox" name="domingo" id="domingo" value="1" autocomplete="off">
                                            </label>
                                        </div>
                                </div>

                            </div>
                            <div class="col-md-12 text-right" >
                                <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                            </div>
                        </form>
                      <!-- /.card-body -->
                    </div>
                </div>
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">{{$titulo}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover display" style="overflow-x:auto;">
                        <thead>
                        <tr>
                            @foreach ($datos as $dato )
                            <th>{{$dato}}</th>
                            @endforeach
                        </tr>
                        </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <script src={{asset('plugins/jquery/jquery.min.js')}}></script>
    <!-- Bootstrap 4 -->
    <script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src={{asset('dist/js/adminlte.min.js')}}></script>
    <!-- Bootstrap 4 -->
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
    {{-- <script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script> --}}
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/moment/moment.min.js')}}"></script> --}}
    <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
    <script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

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
                            "_token": "{{ csrf_token() }}",

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
        });
    </script>
</body>
</html>