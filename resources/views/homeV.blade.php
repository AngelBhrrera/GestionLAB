@extends('layouts/app')

@section('content')

<head>

    <!-- Google Font: Source Sans Pro test -->
    <link rel="stylesheet" href={{asset("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback")}}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("plugins/fontawesome-free/css/all.min.css")}}>
    <!-- daterange picker -->
    <link rel="stylesheet" href={{asset("plugins/daterangepicker/daterangepicker.css")}}>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href={{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href={{asset("plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css")}}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href={{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}>
    <!-- Select2 -->
    <link rel="stylesheet" href={{asset("plugins/select2/css/select2.min.css")}}>
    <link rel="stylesheet" href={{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}>
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href={{asset("plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css")}}>
    <!-- BS Stepper -->
    <link rel="stylesheet" href={{asset("plugins/bs-stepper/css/bs-stepper.min.css")}}>
    <!-- dropzonejs -->
    <link rel="stylesheet" href={{asset("plugins/dropzone/min/dropzone.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("dist/css/adminlte.min.css")}}>
    <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
  <!-- DataTables -->
  <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
</head>


<script src={{asset("plugins/jquery/jquery.min.js")}}></script>
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


<body>
    @include($opcion)
</body>

@endsection
