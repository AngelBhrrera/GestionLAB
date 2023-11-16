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
        <div class="main-gallery owl-carousel owl-theme">
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/imagenLat.jpg')}}" alt="lab" class="img-fluid"></div>
            <div class="img-holder mt-3"><img src="{{asset('build/assets/images/imagenLab2.jpg')}}" alt="lab" class="img-fluid"></div>
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

                                <h4 class="card-title">Crear</h4>
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
                                    <h4 class="card-title">Innovar</h4>
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
                                    <h4 class="card-title">Aprender</h4>
                                    <p class="card-text">Creamos un ambiente de aprendizaje en los 
                                        jóvenes llevándolos por el camino de diferentes ámbitos 
                                        académicos y de desarrollo personal que los ayudara en su camino 
                                        a un futuro laboral productivo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4" >
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-panel gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">Objetivo</h4>
                                    <p class="card-text">Ser el mejor laboratorio de  innovación tecnológica  
                                        de la red UDG el cual vincule a los estudiantes con tecnologías  de 
                                        vanguardia en proyectos enfocados a impresión   3D, sistemas interactivos, 
                                        realidad virtual, videojuegos ente otros.</p>
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
                                    <h4 class="card-title">¿Te gustaría formar parte de la comunidad?</h4>
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
            </div>
            <div class="container">
                <div class="container">
                    <div class="grid-container">
                        <div class="grid-item">
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
