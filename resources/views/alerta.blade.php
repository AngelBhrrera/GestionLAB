@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show auto-fade-out" role="alert" id="alert">
        <i class="fa fa-check" style="margin-right: 10px"></i>
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-error alert-dismissible fade show auto-fade-out" role="alert" id="alert">
        <i class="fa fa-exclamation-triangle" style="margin-right: 10px"></i>
        <strong>{{ session('error') }}</strong>
    </div>
@endif

<script>
    $(document).ready(function(){
        $('.auto-fade-out').addClass('show');

        setTimeout(function(){
            $('.auto-fade-out').removeClass('show');
        }, 3000);
    });
</script>


