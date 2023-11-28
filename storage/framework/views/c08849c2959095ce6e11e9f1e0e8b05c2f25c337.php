
<?php if($nota == ""): ?>
    <button type="button" class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modelIda" onclick="mymodalnota('<?php echo e($nota); ?>','<?php echo e($id); ?>','<?php echo e($fechaQ); ?>','<?php echo e($fecha); ?>','<?php echo e($origen); ?>', '<?php echo e($srcimagen); ?>')" >Reporte</button>
<?php else: ?>
    <button type="button" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" data-target="#modelIda" onclick="mymodalnota('<?php echo e($nota); ?>','<?php echo e($id); ?>','<?php echo e($fechaQ); ?>','<?php echo e($fecha); ?>','<?php echo e($origen); ?>','<?php echo e($srcimagen); ?>')" >Reporte</button>

<?php endif; ?>

<script type="text/javascript">
  function mymodalnota(nota,id,fecha,fechaAct, origen, imagen){
    $('#modelId').modal({
        keyboard: true,
        backdrop: "static",
        show:false,

    })

    if(imagen){
        var img = document.getElementById('divimage');
        img.style.display='block';
    }else{
        var img = document.getElementById('divimage');
        img.style.display='none';
    }
        //make your ajax call populate items or what even you need
    document.getElementById("myTextarea").value = nota;
    document.getElementById("modalid").value = id;
    document.getElementById("imagenSeleccionada").src = "../imagen/notas/"+imagen;
    // if((fecha != fechaAct) || ("<?php echo e(Auth::user()->tipo); ?>" == "prestador"  || ("<?php echo e(Auth::user()->tipo); ?>" == "Superadmin" && origen != 'Superadmin' ) || ("<?php echo e(Auth::user()->tipo); ?>" == "admin" && origen != 'checkin' ))){
    if("<?php echo e(Auth::user()->tipo); ?>" == "prestador"){
        document.getElementById("guardarBtn").disabled = true;
        document.getElementById("myTextarea").readOnly = true;
    }
    else{
        document.getElementById("guardarBtn").disabled = false;
        document.getElementById("myTextarea").readOnly = false;
    }
}

</script>
<?php /**PATH C:\laragon\www\GestionLAB\resources\views/columnTable/asistencia/btnnota.blade.php ENDPATH**/ ?>