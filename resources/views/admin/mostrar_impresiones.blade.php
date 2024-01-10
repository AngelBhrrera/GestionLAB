@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Impresion</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Impresión</h3>
                </div>
                <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="impresoras">

                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">No. de Impresora</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->impresora}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Proyecto</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->proyecto}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Prestador</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->Prestador}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Fecha</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->fecha}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Modelo STL</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->nombre_modelo_stl}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Tiempo</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->tiempo_impresion}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Color</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->color}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Piezas</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->piezas}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Estado</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->estado}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Peso</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->peso}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Observaciones</a>
                                @foreach ($impresiones as $impresion)
                                    <p id="leaderBoard" class="nav-link">{{$impresion->observaciones}}</p>
                                @endforeach
                            </li>

                        </ul>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection




<script>
    $('#alert').fadeIn();
      setTimeout(function() {
           $("#alert").fadeOut();
      },5000);
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var files = Array.from(this.files)
  var fileName = files.map(f =>{return f.name}).join(", ")
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
(function(){
$('.from-prevent-multiple-submits').on('submit', function(){
    $('.from-prevent-multiple-submits').attr('disabled','true');
})
})();
</script>

<script type="text/javascript">
    $(document).ready(function(){
        cambiar();
    });
    function cambiar(){
        var divAlumno = document.getElementById('divAlumno');
        if(document.getElementById('opcMaestro').selected){
            divalumno.style.display = "none";
        }else{
            divalumno.style.display = "";
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#enviar').click(function(){
            var correo = document.getElementById("correo").value;
            var nombre = document.getElementById("nombre").value;
            var telefono = document.getElementById("telefono").value;
            var enlaceDrive = document.getElementById("enlaceDrive").value;
            var N_piezas = document.getElementById("N_piezas").value;
            var proyecto = document.getElementById("proyecto").value;
            var palabrasClave = document.getElementById("palabrasClave").value;
            var introduccion = document.getElementById("introduccion").value;
            var trabajosRelacionados = document.getElementById("trabajosRelacionados").value;
            var observaciones = document.getElementById("observaciones").value;
            var propuesta = document.getElementById("propuesta").value;
            var conclusion = document.getElementById("conclusion").value;

            localStorage.setItem("correo", correo);
            localStorage.setItem("nombre", nombre);
            localStorage.setItem("telefono", telefono);
            localStorage.setItem("enlaceDrive", enlaceDrive);
            localStorage.setItem("N_piezas", N_piezas);
            localStorage.setItem("proyecto", proyecto);
            localStorage.setItem("palabrasClave", palabrasClave);
            localStorage.setItem("introduccion", introduccion);
            localStorage.setItem("trabajosRelacionados", trabajosRelacionados);
            localStorage.setItem("observaciones", observaciones);
            localStorage.setItem("propuesta", propuesta);
            localStorage.setItem("conclusion", conclusion);

            // document.getElementById("correo").value = "";
            // document.getElementById("nombre").value = "";
            // document.getElementById("telefono").value = "";
            // document.getElementById("enlaceDrive").value = "";
            // document.getElementById("N_piezas").value = "";
            // document.getElementById("proyecto").value = "";
            // document.getElementById("palabrasClave").text = "";
            // document.getElementById("introduccion").text = "";
            // document.getElementById("trabajosRelacionados").text = "";
            // document.getElementById("observaciones").text = "";
            // document.getElementById("propuesta").text = "";
            // document.getElementById("conclusion").text = "";

        });
    });
</script>

    <!-- Bootstrap 4 -->

    <!-- Page specific script -->
    <script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date picker
          $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY hh:mm A',
            icons: { time: 'far fa-clock' }

          });

          //Timepicker
          $('#timepicker').datetimepicker({
            format: 'LT'
          })

          //Bootstrap Duallistbox
          $('.duallistbox').bootstrapDualListbox()

          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()

          $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
          })

          $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })

        })
    </script>
