
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
                        <a class="navbar-brand" href="/"><img src="build/assets/images/Inventores.png" width=150 height =150 class="img-fluid" alt="logo"></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="#home">Inicio <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#features">Detalles</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#gallery">Capturas</a> </li>
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

    <header class="bg-gradient" id="home">
        <script>
			var server = 'global'
			var nombre = 'Invitado'
			if(server==''){
				server="global"
			}
		</script>

        <div class="img-holder mt-3"><img src="build/assets/images/imagenLat.jpg" alt="lab" class="img-fluid"></div>

    </header>   

    <div class="section" id="features"> </div>
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

    <div class="section light-bg">
        <div class="container">
            <div class="section-title">
                <h3>Características principales</h3>
            </div>

            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Goal">Objetivo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages">Reglas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#livechat">Chat en tiempo real</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#trade">Intercambios</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#emotions">Emociones</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="Goal">
                    <div class="d-flex flex-column flex-lg-row">
                        <img src="build/assets/images/placeholders/200x200.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                        <div>
                            <h2>Conéctate desde tu PC</h2>
                            <p class="lead">Conoce las instalaciones de CUCEI desde la comodidad de tu hogar.</p>
                            <p>CUCEI Virtual estará al alcance de cualquier persona interesada en ser parte de esta comunidad <a href="login">¡Regístrate ya!</a>
                            </p>                            
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="messages">
                    <div class="d-flex flex-column flex-lg-row">
                        <img src="build/assets/images/placeholders/200x200.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                        <div>
                            <h2>Participa de manera respetuosa</h2>
                            <p class="lead">
                                Recuerda que hay una persona del otro lado de la pantalla y lo que buscamos es formar una comunidad sana.
                            </p>            
                            <p>
                                Por cuestiones de seguridad, el historial de tus conversaciones será guardado en la base de datos del juego.
                            </p>
                        </div>
                    </div>
                </div>                

                <div class="tab-pane fade" id="livechat">
                    <div class="d-flex flex-column flex-lg-row">
                        <div>
                            <h2>Chat de texto</h2>
                            <p class="lead">Participa en el chat global.</p>
                            <p>Para acceder a esta característica necesitas <a href="login">registrarte.</a></p>
                        </div>
                        <img src="build/assets/images/placeholders/200x200.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    </div>
                </div>

                <div class="tab-pane fade" id="trade">
                    <div class="d-flex flex-column flex-lg-row">
                        <img src="build/assets/images/placeholders/200x200.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                        <div>
                            <h2>Recoge e intercambia objetos</h2>
                            <p class="lead">
                                Una de las nuevas características añadidas fue la opción de realizar intercambios de objetos con otros usuarios.
                            </p>            
                            <p>
                                Si deseas un objeto distinto al que posees, manda una petición de intercambio a un usuario.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="emotions">
                    <div class="d-flex flex-column flex-lg-row">
                        <div>
                            <h2>Detección de emociones</h2>
                            <p class="lead">CUCEIVirtual cuenta con un sistema de Inteligencia Artificial que permite reconocer patrones emocionales
                                con base a horarios de conexión y palabras clave compartidas en el chat en tiempo real.
                            </p>
                            <p>No olvides leer el <a href="">acuerdo de privacidad</a> para conocer qué se hará con tu información.</p>
                        </div>
                        <img src="build/assets/images/placeholders/200x200.jpg" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- // end .section -->



    <div class="section" id="gallery">  </div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>Capturas del LABORATORIO DE INVENTORES</h3>
            </div>

            <div class="img-gallery owl-carousel owl-theme">
                <img src="build/assets/images/labMedia (1).png" alt="image">
                <img src="build/assets/images/labMedia (2).png" alt="image">
                <img src="build/assets/images/labMedia (3).png" alt="image">
                <img src="build/assets/images/labMedia (4).png" alt="image">
            </div>
        </div>
    </div>
    <!-- // end .section -->

    <div class = "section light-bg" id = "leaderboard">  </div>
    <div class = "section"> 
        <div class="container">
            <div class="section-title">
                <h3>¡Usuarios con mejor reputación!</h3>
            </div>
            
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active">Posición</a>
                    <p class="nav-link">#1</p>
                    <p class="nav-link">#2</p>
                    <p class="nav-link">#3</p>
                </li>

                <li class="nav-item">
                    <a class="nav-link active">Usuario</a>
                    <p class="nav-link">Arturo99</p>
                    <p class="nav-link">Andres99</p>
                    <p class="nav-link">Luis00</p>
                </li>

                <li class="nav-item">
                    <a class="nav-link active">Votos a favor</a>
                    <p class="nav-link">256</p>
                    <p class="nav-link">256</p>
                    <p class="nav-link">256</p>
                </li>

                <li class="nav-item">
                    <a class="nav-link active">Objetos</a>
                    <p class="nav-link">30</p>
                    <p class="nav-link">30</p>
                    <p class="nav-link">30</p>
                </li>
            </ul>

        </div>
    </div>
    <!-- // end .section -->

    <div class="section" id="faq"></div>
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

    <div class="section light-bg">
        <div class="container">
            <div class="section-title">
                <h3>Equipo de desarrollo</h3>
            </div>
            
            <div class="testimonials owl-carousel">     
                <div class="testimonials-single">
                    <img src="build/assets/images/coordBonilla.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">José Luis David Bonilla Carranza</h5>
                    <p class="text-primary">Asesor del proyecto</p>
                </div>      
                <div class="testimonials-single">
                    <img src="build/assets/images/placeholders/200x200.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">Adriana Peña Pérez Negrón</h5>
                    <p class="text-primary">Departamento de Innovación Basada en la Información y el Conocimiento</p>
                </div>           
                <div class="testimonials-single">
                    <img src="build/assets/images/placeholders/200x200.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">Carlos Chavoya</h5>
                    <p class="text-primary">Desarrollo web</p>
                </div>
                <div class="testimonials-single">
                    <img src="build/assets/images/placeholders/200x200.jpg" alt="client" class="client-img">
                    <h5 class="mt-4 mb-2">Angel Barrera</h5>
                    <p class="text-primary">Desarrollo web</p>
                </div>
            </div>
                
            </div>



        </div>

    </div>
    <!-- // end .section -->
    <!-- Contacto -->
    <div class="section" id="contact"></div>
    <div class="section">
        <div class="container table-responsive">
            <div class="section-title">
                <h3>CONTACTO</h3>
            </div>
            <div class="container">
                <table class="table">
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>José Luis David Bonilla Carranza</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">cdcomp@cucei.udg.mx</a>                            
                                </p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>Carlos Chavoya</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">javier.hernandez5094@alumnos.udg.mx</a>                            
                                </p>
                            </td>
                            <td>
                                <p class="mb-2">
                                    <span class="ti-user mr-2"></span> <a>Angel Barrera</a>
                                </p>
                                <p class="mb-2">                            
                                    <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">jaime.sandoval4112@alumnos.udg.mx</a>                            
                                </p>                            
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- // end .section -->
    
    <div class="section light-bg">  <!-- Footer -->
        <div class="container table-responsive">
            <div class="row">
                <div class="col align-self-start">
                    <img class="mb-4" src="build/assets/images/logoB.png" height="120" width="480" >
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
                    <p class="light-font mb-1 text-center">Derechos reservados ©2021 - 2022. Universidad de Guadalajara.
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

    <script>$('.owl-carousel').owlCarousel({
            margin:10,
            loop:true,
            autoWidth:true,
            items:3, 
        })</script>
</body>
</html>
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views//landingPageTEMP.blade.php ENDPATH**/ ?>