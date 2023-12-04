<!-- LANDING PAGE-->
<!doctype html>
<html lang="es">

<head>
    <title>Gestion Laboratorio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('build/assets/images/inventores.png')}}" rel="shortcut icon">
    <meta name="keywords" content="HTML5, bootstrap, CUCEI , SOCIAL, Node">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="build/assets/bootstrap.min.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="build/assets/owl.carousel.min.css">
    <!-- Main css -->
    <link href="build/assets/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

    <!-- Nav Menu -->
    <div class="nav-menu fixed-top is-scrolling">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-dark navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('landing')}}"><img src="build/assets/logosInventores/InventoresLOGOHDWhiteBorder.png" width=70 height =70 class="img-fluid" alt="logo"></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="#home">Inicio <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#features">Antecedentes</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#servicios">Servicios</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#gallery">Investigación</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#leaderboard">Torneo</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#faq">FAQ</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#contact">Contacto</a> </li>
                                <li class="nav-item"><a href="login" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Regístrate / Iniciar sesión</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <header class="" id="home">
        <script>
			var server = 'global'
			var nombre = 'Invitado'
			if(server==''){
				server="global"
			}
		</script>
        <h3 class="pt-3">¡Bienvenido al Laboratorio de Inventores!</h3>
        <div class="main-gallery owl-carousel owl-theme">
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/imagenLat.jpg')}}" alt="lab" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/imagenLab2.jpg')}}" alt="lab" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia2.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia3.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia4.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia6.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia7.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia8.jpg')}}" alt="image" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/labMedia9.jpg')}}" alt="image" class="img-fluid"></div>
        </div>
        

    </header>   

    <div class="section light-bg" id="features"></div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>¿Qué puedes hacer aquí?</h3>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-comments gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">

                                <h4 class="card-title">Proyectos</h4>
                                    <p class="card-text">Llevamos a cabo increíbles proyectos de Robótica, Computación, Informática, Mecánica, Electrónica, Industriales, Biomédicos, Diseño de modas.</p>
                                    <p class="card-text">Aquí puedes ver algunos de nuestros <a href="https://inventores.org/blog/">proyectos</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-4" style="margin: 20px 0 0 0">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-panel gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Beneficios</h4>
                                    <p class="card-text">Formar parte de este laboratorio trae 
                                        consigo distintos beneficios:
                                    <ul>
                                        <li><p class="card-text">Conocer personas de distintas carreras.</p></li>
                                        <li><p class="card-text">Aplicar tus conocimientos obtenidos en distintas áreas dentro del laboratorio.</p></li>
                                        <li><p class="card-text">Adquirir nuevos conocimientos, que te ayudarán en tu formación profesional y personal.</p></li>
                                    </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-panel gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Artículos</h4>
                                    <p class="card-text">Se han escrito diversos artículos que puedes consultar  <a href="{{route('articulos')}}">aquí</a>.</p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12 col-lg-4" style="margin: 20px 0 0 0">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-panel gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Capítulos de libros</h4>
                                    <p class="card-text">Creamos un ambiente de aprendizaje en los 
                                        jóvenes llevándolos por el camino de diferentes ámbitos 
                                        académicos y de desarrollo personal que los ayudara en su camino 
                                        a un futuro laboral productivo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4" style="margin: 20px 0 0 0">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-panel gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Libros</h4>
                                    <p class="card-text">Ser el mejor laboratorio de  innovación tecnológica  
                                        de la red UDG el cual vincule a los estudiantes con tecnologías  de 
                                        vanguardia en proyectos enfocados a impresión   3D, sistemas interactivos, 
                                        realidad virtual, videojuegos, entre otros.</p>
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-4" style="margin: 20px 0 0 0">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-bell gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Patentes</h4>
                                    <p class="card-text">En el siguiente enlace podrás registrarte para solicitar algún servicio, 
                                        ser prestador de servicio social o voluntario de laboratorio.</p>
                                    <a class="card-text" href="register">¡Regístrate!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- // end .section -->
    <div class = "section light-bg" id="servicios"></div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>Servicios que ofrecemos</h3>
                <p>Puedes solicitar cualquiera de nuestros servicios, con gusto te atenderemos.</p>
            </div>
            <div class="container">
                <div class="container">
                    <div class="grid-container">
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLScPiGL-g7Os1pJoHGtLqpiA2vJAKslYmVKqW9Mp6mZuTUr2mQ/viewform">
                                <img src="build/assets/images/creacion-de-piezas-3D.png" alt="image">
                                <p class="pdescripcion">Creación de modelos digitales 3D</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdtHIY-jHHlseVQNvtwobPxLEdkk0JXSpYXmodqwCdMGMJIHg/viewform">
                                <img src="build/assets/images/capacitacion-de-uso-de-impresoras-3D.png" alt="image">
                                <p class="pdescripcion">Capacitación de uso de impresoras 3D</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSd2KBuqIvoCTGOX8rx8hihQNkO17cbSaC9V01Iix9I3pW1-Ew/viewform">
                               <img src="build/assets/images/creacion-de-aplicaciones-de-realidad-virtual.png" alt="image">
                               <p class="pdescripcion">Creación de aplicaciones de realidad virtual</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLScijczjpr9Klw9XVV4ynSR-mNrRwzwEVESFOQLYI_LKCz1clg/viewform">
                                <img src="build/assets/images/creacion-de-prototipos.png" alt="image">
                                <p class="pdescripcion">Creación de prototipos</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdoTy4RdctUfzyZGzHQYkDXqA1A_OY80-9ex9CwcpB0jE-MGQ/viewform">
                                <img src="build/assets/images/creacion-de-sistemas-web.png" alt="image">
                                <p class="pdescripcion">Creación de sistemas web</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSerKEtn2s3XaeNaXEw_PQhelRVc2TlPdeVrlTIQmVetotby0g/closedform">
                                <img src="build/assets/images/creacion-de-videojuegos.png" alt="image">
                                <p class="pdescripcion">Creación de videojuegos</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfkOt8vekS_ix9Y8ePYk-SQARCiVuz9rjPzWFOBYTrGJ6WpvA/viewform">
                                <img src="build/assets/images/nivel.png" alt="image">
                                <p class="pdescripcion">Capacitación de desarrollo de videojuegos</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLScN0dNRm0MbuRs9uT6d-WoUmuizEa7Z5JwI4Bt4BHvuraHATQ/viewform">
                                <img src="build/assets/images/uso-de-impresoras-3D.png" alt="image">   
                                <p class="pdescripcion">Solicitud de impresión de modelos 3D</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdQUseThOoCQ3gz287sDFoXRRV7BHA6Vti74_8tWXxKcqaOFA/viewform">
                              <img src="build/assets/images/capacitacion-de-app-de-realidad-virtual.png" alt="image">
                              <p class="pdescripcion">Capacitación de app de realidad virtual</p>
                            </a>
                            
                        </div>
                    </div>
                    <div class="grid-containerSec">
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe4_sPzMttqcztP821RoMMNY5K9GMxij7xDD86cE05px57u2Q/viewform">
                               <img src="build/assets/images/capacitacion-de-desarrollo-de-aplicacion-interactiva.png" alt="image">
                               <p class="pdescripcion">Capacitación de desarrollo de aplicación interactiva</p>
                            </a>
                            
                        </div>
                        <div class="grid-item">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeOcS6S_OwXiBvDWrflv5AQ44H1DUYQWN8aPMymLa3d-XvSWw/viewform">
                                <img src="build/assets/images/capacitacion-de-modelado-3D.png" alt="image">
                                <p class="pdescripcion">Capacitación de modelado 3D</p>
                            </a>
                           
                        </div>
                    </div>
                </div>
                
                

            </div>
        </div>
    </div>
    <!-- // end .section -->



    <div class="section light-bg" id="gallery"></div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>Investigación</h3>
            </div>

            <div class="img-gallery owl-carousel owl-theme">
                <img src="build/assets/images/labMedia.jpg" alt="image">
                <img src="build/assets/images/labMedia2.jpg" alt="image">
                <img src="build/assets/images/labMedia3.jpg" alt="image">
                <img src="build/assets/images/labMedia4.jpg" alt="image">
                {{--<img src="build/assets/images/labMedia5.jpg" alt="image" width="200px" height="500px">--}}
            </div>
        </div>
    </div>
    <!-- // end .section -->

    <div class = "section light-bg" id = "leaderboard"></div>
    <div class = "section"> 
        <div style="padding:0 10%;">
            <div class="section-title">
                <h3>¡Mejores prestadores!</h3>
                <p>Aquí podrás ver los mejores prestadores que realizan servicio social en
                 el laboratorio de inventores de acuerdo a sus puntos de experiencia.</p>
            </div>


                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#semanal">Semana</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#mensual">Mes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#global">Todos los tiempos</a>
                    </li>

                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="semanal">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Posición</a>
                                @foreach ($leaderBoard as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                @foreach ($leaderBoard as $top)
                                    <p id="leaderBoard"  class="nav-link">{{$top->Inventor}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiecia</a>
                                @foreach ($leaderBoard as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->experiencia}}</p>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    
                    <div class="tab-pane fade" id="mensual">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active">Posición</a>
                                    @foreach ($leaderBoard as $top)
                                        <p id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                    @endforeach
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Usuario</a>
                                    @foreach ($leaderBoard as $top)
                                        <p id="leaderBoard" class="nav-link leaderBoard">{{$top->Inventor}}</p>
                                    @endforeach
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Experiecia</a>
                                    @foreach ($leaderBoard as $top)
                                        <p  id="leaderBoard"class="nav-link">{{$top->experiencia}}</p>
                                    @endforeach
                                </li>
                            </ul>
                    </div>                

                    <div class="tab-pane fade" id="global">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Posición</a>
                                @foreach ($leaderBoard as $top)
                                    <p  id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                @foreach ($leaderBoard as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->Inventor}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiecia</a>
                                @foreach ($leaderBoard as $top)
                                    <p  id="leaderBoard" class="nav-link">{{$top->experiencia}}</p>
                                @endforeach
                            </li>
                        </ul>
                    </div> 
                </div>

        </div>
    </div>
    <!-- // end .section -->

    <div class="section light-bg" id="faq"></div>
    <div class = "section">
        <div class="container">
            <div class="section-title">
                <h4>FAQ</h4>
                <h3>PREGUNTAS FRECUENTES</h3>
            </div>
                
            <div class="row pt-4">
                <div class="col-md-6">
                    <h4 class="mb-3">¿Qué es el laboratorio de inventores?</h4>
                    <p class="light-font mb-5">
                        El laboratorio de inventores DIVTIC es un lugar donde se realizan increíbles proyectos de muchas áreas,
                        la principal actividad que se realiza es la impresión 3D. El laboratorio promueve la integración de las 
                        TIC para mejorar la enseñanza y el aprendizaje en todas las modalidades y niveles educativos ademas de promover también el 
                        uso de las nuevas tecnologías de creación y desarrollo.
                    </p>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Donde puedo consultar información sobre sus actividades?</h4>
                    <p class="light-font mb-5">
                        Tenemos tanto nuestras redes sociales como nuestro blog donde compartimos información sobre lo que realizamos
                        dentro del laboratorio, puedes echar un vistazo y ver cosas interesantes.
                    </p>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Cómo puedo formar parte el laboratorio?</h4>
                    <p class="light-font mb-5">
                        Existen diversas maneras de unirte al laboratorio, para más información puedes asistir al laboratorio 
                        en el Módulo N planta alta en el Centro Universitario de Ciencias Exactas e Ingenierías en un horario de 
                        lunes a viernes de 8am a 8 pm o sábados de 8am a 2pm. Puedes venir y registrarte como visitante, podrás solicitar impresiones
                        3D o bien conocer las actividades que se realizan. Si eres estudiante puedes aplicar para realizar tu servicio social aquí siguiendo
                        los lineamientos de la convocatoria al 60% de tus créditos escolares. Se te puee solicitar asistir a una entrevista en la cual se te preguntará
                        sobre tus aptitudes y resolver dudas que puedas tener sobre el laboratorio de forma más directa, se hará un seguimiento de los alumnos
                        que hicieron su entrevista para apoyarlos al momento de hacer su registro en el servicio social (esto no garaniza tu plaza dentro del laboratorio).
                    </p>
                </div>
                
                <div class="col-md-6">
                    <h4 class="mb-3">¿Que actividades se realizan en el laboratorio?</h4>
                    <p class="light-font mb-5">
                        Ofrecemos distintos servicios como diseño de modelos en 3D, impresiones, 
                        cursos de impresión en 3D, desarrollo de proyectos web, videojuegos, y mucho más.
                    </p>
                    <h4 class="mb-3">¿Dónde se ubican?</h4>
                    <p class="light-font mb-5">
                        Nuestra sede se encuentra en el Módulo N planta alta del Centro Universitario de Ciencias Exactas e Ingenierías
                        con domicilio en Blvd. Marcelino García Barragán #1421, esq Calzada Olímpica, 
                        C.P. 44430, Guadalajara, Jalisco, México.
                    </p>
                   
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Cuál es el horario de atención?</h4>
                    <p class="light-font mb-5">
                        El laboratorio ofrece sus servicios de 8:00 am a 8:00 pm de lunes a viernes
                        y sábados de 8:00 am a 2:00 pm.
                    </p>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Que aptitudes se espera que tengas?</h4>
                    <p class="light-font mb-5">Gusto por la tecnología y disposición para adquirir nuevos 
                        conocimientos son las principales aptitudes con las que debes contar</p> 
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Cuál es su objetivo?</h4>
                    <p class="light-font mb-5">
                        Ser el mejor laboratorio de  innovación tecnológica  
                        de la red UDG el cual vincule a los estudiantes con 
                        tecnologías  de vanguardia en proyectos enfocados a impresión  
                        3D, sistemas interactivos, realidad virtual, videojuegos ente otros.
                    </p>
                    
                </div>
                <div class="col-md-6">
                <h4 class="mb-3">¿Pueden entrar alumnos de cualquier carrera?</h4>
                    <p class="light-font mb-5">
                        Todos los alumnos son bienvenidos y pueden formar parte de nuestro laoratorio,
                        dentro del laboratorio se realizan proyectos de distintas áreas y puedes participar en el desarrollo
                        de algún proyecto relacionado con tu carrera.
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3">¿Puedo solicitar servicios?</h4>
                    <p class="light-font mb-5">
                        Puedes solicitar cualquiera de nuestros servicios, sólo debes llenar los formularios correspondientes
                        según el servicio que desees, puedes acudir presencialmente al laboratorio o contactarnos para recibir informes.
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3">¿Qué puedo aprender en el laboratorio?</h4>
                    <p class="light-font mb-5">
                        Puedes recibir capacitación para realizar modelado e impresiones 3D, 
                        sobre desarrollo de videojuegos, sistemas web, y mucho más.
                    </p>
                </div>

                <div class="col-md-6">
                <h4 class="mb-3">¿Cómo puedo conocer más sobre ustedes?</h4>
                    <p class="light-font mb-5">
                        Visita nuestras redes sociales, donde compartimos información sobre nuestras actividades,
                        ahí podrás encontrar fotos sobre impresiones 3D y diversos proyectos realizados en el laboratorio.
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3">¿Cómo es el ambiente dentro del laboratorio?</h4>
                    <p class="light-font mb-5">
                    El laboratorio promueve un ambiente de aprendizaje en los jóvenes llevándolos 
                    por el camino de diferentes ámbitos académicos y de desarrollo personal 
                    que los ayudara en su camino a un futuro laboral productivo, con respeto y responsabilidad.
                    </p>
                </div>
                
                
                <div class="col-md-6">
                <h4 class="mb-3">¿Puedo ingresar al laboratorio a cualquier hora?</h4>
                    <p class="light-font mb-5">
                        Puedes asistir al laboratorio en nuestros horarios de atención de 8am a 8pm lunes a viernes y de 8am a 2pm los sábados,
                        con gusto te atenderemos. No es necesario un registro previo para pedir informes.
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3">Quiero una impresión ¿Qué necesito?</h4>
                    <p class="light-font mb-5">
                        Comprar el filamento suficiente, preparar un donativo, que puede ser material para el laboratorio
                        llenar el formulario correspondiente.
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3"></h4>
                    <p class="light-font mb-5">
                        
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3"></h4>
                    <p class="light-font mb-5">
                        
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3"></h4>
                    <p class="light-font mb-5">
                        
                    </p>
                </div>
                <div class="col-md-6">
                <h4 class="mb-3"></h4>
                    <p class="light-font mb-5">
                        
                    </p>
                </div>
                
            </div>
        </div>
    </div>

    <!-- // end .section -->
    <!-- Contacto -->

    <div class="section light-bg" id="contact"></div>
    <div class="section">
        <div class="container table-responsive">
            <div class="section-title">
                <h3>CONTACTO</h3>
            </div>
            <div class="container">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>José Luis David Bonilla Carranza</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">jose.bcarranza@academicos.udg.mx</a>                            
                                </p>
                                <p class="mb-2 ml-2">                            
                                    Titular del Laboratorio | Coordinador de ICOM
                                </p>

                            </td>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>Luis Felipe Muñoz Mendoza</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">luis.munoz.m@academicos.udg.mx</a>                            
                                </p>
                                <p class="mb-2 ml-2">                            
                                    Profesor del laboratorio
                                </p>
                            </td>
                        </tr>

                        <tr>
                            @foreach ($matutino as $mat)

                                <td>
                                    <p class="mb-2">
                                        <span class="ti-user mr-2"></span> <a>{{$mat->Nombre}}</a>
                                    </p>
                                    <p class="mb-2">                            
                                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">{{$mat->correo}}</a>                            
                                    </p>
                                    <p class="mb-2 ml-2">                            
                                        Encargado del turno {{$mat->horario}}
                                    </p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($mediodia as $mid)

                                <td>
                                    <p class="mb-2">
                                        <span class="ti-user mr-2"></span> <a>{{$mid->Nombre}}</a>
                                    </p>
                                    <p class="mb-2">                            
                                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">{{$mid->correo}}</a>                            
                                    </p>
                                    <p class="mb-2 ml-2">                            
                                        Encargado del turno {{$mid->horario}}
                                    </p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($vespertino as $v)

                                <td>
                                    <p class="mb-2">
                                        <span class="ti-user mr-2"></span> <a>{{$v->Nombre}}</a>
                                    </p>
                                    <p class="mb-2">                            
                                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">{{$v->correo}}</a>                            
                                    </p>
                                    <p class="mb-2 ml-2">                            
                                        Encargado del turno {{$v->horario}}
                                    </p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($sabatino as $s)

                                <td>
                                    <p class="mb-2">
                                        <span class="ti-user mr-2"></span> <a>{{$s->Nombre}}</a>
                                    </p>
                                    <p class="mb-2">                            
                                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">{{$s->correo}}</a>                            
                                    </p>
                                    <p class="mb-2 ml-2">                            
                                        Encargado del turno {{$s->horario}}
                                    </p>
                                </td>
                            @endforeach
                        </tr>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- // end .section -->
    
    <div class = "section light-bg"></div>
    <div class="section">  <!-- Footer -->
        <div class="container table-responsive">
            <div class="row">
                <div class="col align-self-start">
                    <img class="mb-4" src="build/assets/images/logoB.png" height="120" width="480" >
                </div>
                
                <div class="col align-self-start">
                    <h3 style="font-size:15pt">¡Síguenos en nuestras redes sociales!</h3>
                    <a href="https://www.facebook.com/Comunidadinventores"><img class="mb-4" src="build/assets/images/image-1.png" height="60" width="60" ></a>
                    <a href="https://www.instagram.com/inventores_lab_cucei/"><img class="mb-4" src="build/assets/images/image-4.png" height="60" width="60" ></a>
                    <a href="https://www.tiktok.com/@inventoresudg"><img class="mb-4" src="build/assets/images/tiktok.png" height="60" width="60" ></a>
                    <h3 style="font-size:15pt">¡Vísita nuestro <a href="https://inventores.org/blog/">blog</a>!</h3>
                    <a href="https://inventores.org/blog/"></a>
                </div>
            </div>

            <div class="row">
                <div class="col align-self-start">
                    <p class="light-font mb-2">UNIVERSIDAD DE GUADALAJARA</p>
                </div>
            </div>

            <div class="row">
                <div class="col align-self-start">
                    <p class="light-font mb-2">CENTRO UNIVERSITARIO DE CIENCIAS EXACTAS E INGENIERÍAS</p>
                </div>
              </div>

              <div class="row">
                <div class="col align-self-start">
                    <p class="light-font mb-2">Blvd. Marcelino García Barragán #1421, esq Calzada Olímpica, C.P. 44430, Guadalajara, Jalisco, México.</p>
                </div>
              </div>

            <div class="row">
                <div class="col align-self-start">
                    <p class="bold-font mb-2">Teléfono: +52 33 1378 5900.</p>
                </div>
            </div>

            <div class="row">
                <div class="col align-self-start"></div>
                <div class="col-6">
                    <p class="light-font mb-1 text-center">Derechos reservados ©2021 - 2023. Universidad de Guadalajara.
                        <a class="mr-4 mb-5" href="http://inventoreslab.cucei.udg.mx/">Laboratorio de inventores</a>
                        <a class="mr-4 mb-5" href="{{route('devTeam')}}">Equipo de desarrollo</a>
                    </p>
                </div>
                <div class="col align-self-end"></div>
            </div>

        </div>
    </div>
    <!-- // end .section -->

    </footer>

    <!-- jQuery and Bootstrap -->
    <script src="plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="build/assets/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="build/assets/owl.carousel.min.js"></script>

    <!-- Custom JS -->
    <script src="build/assets/script.js"></script>
    <!-- Dialogflow -->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

</body>
</html>
