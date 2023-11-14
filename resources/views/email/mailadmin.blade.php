<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Link Bootstrap JS and JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <div class="container">
        <img src="{{ $message->embed(public_path().'/img/recursos/logo_pedorro.png') }}"  class="img-responsive" alt="Responsive image">
    </div>
    <div class="mailbox-read-message">
        <p>Hola {{$details['nombre']}} </p>
        <p>{{ $details['body'] }}</p>
    </div>



    <p>{{ $details['despedida'] }}</p>
</body>
</html>
