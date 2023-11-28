
    <div class="col-12">
        <input class="form-control"
        type="number"
        value=<?php echo e($horas); ?>

        name=<?php echo e($id); ?>

        id=<?php echo e("inputh".$id); ?>

        onkeyup="actualizarb(this, <?php echo e(Auth::user()); ?>)"
        onchange="actualizarb(this, <?php echo e(Auth::user()); ?>)"
        <?php echo e((Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''); ?>

        > 
    </div>

<script type="text/javascript">
    //actualizar horas
    function actualizarb(src, responsable){

    var url = '<?php echo e(route('api.actualizarb')); ?>';
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
                "_token": "<?php echo e(csrf_token()); ?>",
                "id":src.name,
                "horas":horas,
                "responsable":responsable.id+" "+responsable.name+" "+responsable.apellido

        },
        }
        );
    }
</script>
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/columnTable/asistencia/selecthoras.blade.php ENDPATH**/ ?>