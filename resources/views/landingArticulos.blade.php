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
                        <a class="navbar-brand" href="{{route('landing')}}"><img src="build/assets/images/logosInventores/InventoresLOGOHDWhiteBorder.png" width=70 height =70 class="img-fluid" alt="logo"></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a href="{{route('landing')}}" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Regresar</a></li>
                                <li class="nav-item"><a href="login" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Regístrate / Iniciar sesión</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section light-bg" id="features"></div>
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h3>Artículos publicados</h3>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-comments gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <p class="card-text"><a href="https://www.researchgate.net/publication/368779614_Introduccion_al_desarrollo_de_videojuegos_con_GODOT">
                                            Introducción al desarrollo de videojuegos con GODOT</a></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-comments gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <p class="card-text">
                                        <a href="https://www.researchgate.net/publication/371636352_Diseno_de_videojuegos_para_el_analisis_de_habilidades_personales">
                                            Diseño de videojuegos para el análisis de habilidades personales</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-comments gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <p class="card-text">
                                        <a href="https://www.researchgate.net/publication/368433014_Introduction_to_scientific_video_game_design">
                                            Introduction to scientific video game design</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4" style="margin: 20px 0 0 0">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-comments gradient-fill ti-3x mr-3"></span>
                                <div class="media-body">
                                    <p class="card-text">
                                    <a href="https://www.researchgate.net/publication/358856987_RYUJIN_Interfaz_de_Rehabilitacion_y_Juego_Serio_para_la_Patologias_Neuromuscular_de_Miembro_Superior">
                                        RYUJIN, Interfaz de Rehabilitación y Juego Serio para la Patologías Neuromuscular de Miembro Superior</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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