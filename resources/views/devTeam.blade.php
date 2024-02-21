<!-- LANDING PAGE-->
<!doctype html>
<html lang="es">

<head>
    <title>Equipo de desarrollo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('build/assets/images/inventores.png')}}" rel="shortcut icon">
    <meta name="keywords" content="HTML5, bootstrap, CUCEI , SOCIAL, Node">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main css -->
    <link href="{{asset('build/assets/css/devTeamPage.css')}}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">
    
    <div class="main-container">
        <h2>Equipo de desarrollo</h2>
        <hr>
        <div class="members">
            <div class="team-member">
                <img src="build/assets/images/bonilla.jpg" alt="client.jgp" class="client-img">
                <h5 class="mt-4 mb-2">José Luis David </h5>
                <h5>Bonilla Carranza</h5>
                <p class="text-primary">Asesor del proyecto</p> 
            </div>
            <div class="team-member">
                <img src="build/assets/images/chavoya.jpg" alt="client" class="client-img">
                <h5 class="mt-4 mb-2">Carlos Chavoya</h5>
                <p class="text-primary">Desarrollo web</p>
            </div>
            <div class="team-member">
                <img src="build/assets/images/barrera.jpg" alt="client" class="client-img">
                <h5 class="mt-4 mb-2">Angel Barrera</h5>
                <p class="text-primary">Desarrollo web</p>
            </div>
            <div class="team-member">
                <img src="build/assets/images/barrera.jpg" alt="client" class="client-img">
                <h5 class="mt-4 mb-2">Bryan Barragán</h5>
                <p class="text-primary">Desarrollo web</p>
            </div>
        </div>
    </div>
</body>