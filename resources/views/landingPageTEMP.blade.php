<!-- LANDING PAGE-->
<!doctype html>
<html lang="es">

<head>
    <title>Gestion Laboratorio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <a class="navbar-brand" href="/land"><img src="build/assets/logosInventores/InventoresLOGOHDWhiteBorder.png" width=70 height =70 class="img-fluid" alt="logo"></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="#home">Inicio <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#features">Detalles</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#servicios">Servicios</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#gallery">Galería</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#leaderboard">Torneo</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#faq">FAQ</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#contact">Contactos</a> </li>
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
        <div class="img-holder mt-3"><img src="build/assets/images/imagenLat.jpg" alt="lab" class="img-fluid"></div>

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

                                <h4 class="card-title">Creamos</h4>
                                    <p class="card-text">Llevamos a cabo increíbles proyectos de Robótica, Computación, Informática, Mecánica, Electrónica, Industriales, Biomédicos, Diseño de modas.</p>
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
                                    <h4 class="card-title">Innovamos</h4>
                                    <p class="card-text">Contamos con un variado inventario de tecnologia que incluye Impresoras 3D, drones, gafas de RV y equipos de computo que nos permiten llevar nuestros proyectos al siguiente nivel!</p>
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
                                    <h4 class="card-title">Objetivo</h4>
                                    <p class="card-text">Ser el mejor laboratorio de  innovación tecnológica  
                                        de la red UDG el cual vincule a los estudiantes con tecnologías  de 
                                        vanguardia en proyectos afocados a impresión   3D, sistemas interactivos, 
                                        realidad virtual, videojuegos ente otros.</p>
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
                                    <h4 class="card-title">Funciones</h4>
                                    <p class="card-text">Crear un ambiente de aprendizaje en los 
                                        jóvenes llevándolos por el camino de diferentes ámbitos 
                                        académicos y de desarrollo personal que los ayudara en su camino 
                                        a un futuro laboral productivo.</p>
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
                                <span class="ti-bell gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Únete</h4>
                                    <a class="card-text" href="register">Crear una cuenta</a>
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
            </div>
            <div class="container" >
                <div class="container" >
                    <div class="grid-container" >
                        <div class="grid-item" >
                            <img src="build/assets/images/creacion-de-piezas-3D.png" alt="image">
                            <p class="pdescripcion">Creación de modelos digitales 3D</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/capacitacion-de-uso-de-impresoras-3D.png" alt="image">
                            <p class="pdescripcion">Capacitación de uso de impresoras 3D</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/creacion-de-aplicaciones-de-realidad-virtual.png" alt="image">
                            <p class="pdescripcion">Creación de aplicaciones de realidad virtual (Próximamente)</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/creacion-de-prototipos.png" alt="image">
                            <p class="pdescripcion">Creación de prototipos</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/creacion-de-sistemas-web.png" alt="image">
                            <p class="pdescripcion">Creación de sistemas web</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/creacion-de-videojuegos.png" alt="image">
                            <p class="pdescripcion">Creación de videojuegos</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/nivel.png" alt="image">
                            <p class="pdescripcion">Capacitación de desarrollo de videojuegos</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/uso-de-impresoras-3D.png" alt="image">
                            <p class="pdescripcion">Solicitud de impresión de modelos 3D</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/capacitacion-de-app-de-realidad-virtual.png" alt="image">
                            <p class="pdescripcion">Capacitación de app de realidad virtual</p>
                        </div>
                    </div>
                    <div class="grid-containerSec">
                        <div class="grid-item">
                            <img src="build/assets/images/capacitacion-de-desarrollo-de-aplicacion-interactiva.png" alt="image">
                            <p class="pdescripcion">Capacitación de desarrollo de aplicación interactiva</p>
                        </div>
                        <div class="grid-item">
                            <img src="build/assets/images/capacitacion-de-modelado-3D.png" alt="image">
                            <p class="pdescripcion">Capacitación de modelado 3D</p>
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
                <h3>Galería</h3>
            </div>

            <div class="img-gallery owl-carousel owl-theme">

                <img src="build/assets/images/labMedia.jpg" alt="image">
                <img src="build/assets/images/labMedia2.jpg" alt="image">
                <img src="build/assets/images/labMedia3.jpg" alt="image">
                <img src="build/assets/images/labMedia4.jpg" alt="image">
            </div>
        </div>
    </div>
    <!-- // end .section -->

    <div class = "section light-bg" id = "leaderboard"></div>
    <div class = "section"> 
        <div style="padding:0 10%;">
            <div class="section-title">
                <h3>¡Mejores prestadores!</h3>
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
                                <p class="nav-link">#1</p>
                                <p class="nav-link">#2</p>
                                <p class="nav-link">#3</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                <p class="nav-link">{{$users[0]->name}}</p>
                                <p class="nav-link">{{$users[1]->name}}</p>
                                <p class="nav-link">{{$users[2]->name}}</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiecia</a>
                                <p class="nav-link">{{$users[0]->experiencia}}</p>
                                <p class="nav-link">{{$users[1]->experiencia}}</p>
                                <p class="nav-link">{{$users[2]->experiencia}}</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Actividades completadas</a>
                                <p class="nav-link">30</p>
                                <p class="nav-link">30</p>
                                <p class="nav-link">30</p>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="mensual">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active">Posición</a>
                                    <p class="nav-link">#1</p>
                                    <p class="nav-link">#2</p>
                                    <p class="nav-link">#3</p>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Usuario</a>
                                    <p class="nav-link">{{$users[0]->name}}</p>
                                    <p class="nav-link">{{$users[1]->name}}</p>
                                    <p class="nav-link">{{$users[2]->name}}</p>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Experiecia</a>
                                    <p class="nav-link">{{$users[0]->experiencia}}</p>
                                    <p class="nav-link">{{$users[1]->experiencia}}</p>
                                    <p class="nav-link">{{$users[2]->experiencia}}</p>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Actividades completadas</a>
                                    <p class="nav-link">30</p>
                                    <p class="nav-link">30</p>
                                    <p class="nav-link">30</p>
                                </li>
                            </ul>
                    </div>                

                    <div class="tab-pane fade" id="global">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Posición</a>
                                <p class="nav-link">#1</p>
                                <p class="nav-link">#2</p>
                                <p class="nav-link">#3</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                <p class="nav-link">{{$users[0]->name}}</p>
                                <p class="nav-link">{{$users[1]->name}}</p>
                                <p class="nav-link">{{$users[2]->name}}</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiecia</a>
                                <p class="nav-link">{{$users[0]->experiencia}}</p>
                                <p class="nav-link">{{$users[1]->experiencia}}</p>
                                <p class="nav-link">{{$users[2]->experiencia}}</p>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Actividades completadas</a>
                                <p class="nav-link">30</p>
                                <p class="nav-link">30</p>
                                <p class="nav-link">30</p>
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
                    <h4 class="mb-3">¿Puedo participar si no soy estudiante?</h4>
                    <p class="light-font mb-5">
                        Sí, puedes ingrisar como un usuario invitado (Pero te invitamos a leer y aceptar el aviso de privacidad y los térmios
                        de condiciones de uso).
                    </p>
                    <h4 class="mb-3">¿Cuál es su objetivo?</h4>
                    <p class="light-font mb-5">
                        Brindar una herramienta innovadora para las personas interesadas en conocer el centro universitario o bien para el
                        uso de la comunidad estudiantil incluyendo alumnos y docentes, ya sea para hacer un recorrido por las instalaciones, conocer aulas, auditorios o
                        simplemente pasar el rato. Defendemos la idea de fomentar la sana convivencia y mantener orden en la comunidad.
                    </p>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">¿Cómo puedo contactarlos?</h4>
                    <p class="light-font mb-5">
                        En la siguiente sección puedes encontar la información correspondiente tanto para los desarrolladores del proyecto,
                        como para el asesor del mismo.
                    </p>
                    <h4 class="mb-3">¿Es de paga?</h4>
                    <p class="light-font mb-5">No, es totalmente gratuito.</p> 
                </div>
            </div>
        </div>
    </div>
    <!-- // end .section -->
    <div class = "section light-bg"></div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>Equipo de desarrollo</h3>
            </div>
            
            <div class="testimonials owl-carousel">     
                <div class="testimonials-single">
                    <img src="build/assets/images/bonilla.jpg" alt="client.jgp" class="client-img">
                    <h5 class="mt-4 mb-2">José Luis David Bonilla Carranza</h5>
                    <p class="text-primary">Asesor del proyecto</p>
                </div>      
                         
                <div class="testimonials-single">
                    <img src="build/assets/images/chavoya.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">Carlos Chavoya</h5>
                    <p class="text-primary">Desarrollo web</p>
                </div>
                <div class="testimonials-single">
                    <img src="build/assets/images/barrera.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">Angel Barrera</h5>
                    <p class="text-primary">Desarrollo web</p>
                </div>
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
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">cdcomp@cucei.udg.mx</a>                            
                                </p>
                            </td>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>Luis Felipe Muñoz Mendoza</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">luis.munoz.m@academicos.udg.mx</a>                            
                                </p>
                            </td>
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
    <script>
        $('.owl-carousel').owlCarousel({
            items:1,
            margin:10,
        });
    </script>

</body>
</html>
