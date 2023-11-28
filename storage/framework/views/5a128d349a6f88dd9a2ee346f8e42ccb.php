
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>limelight</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
       <!-- bootstrap css -->
       <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
      <!-- style css -->
      <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
      <!-- Responsive-->
      <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
      <!-- fevicon -->
      <link rel="icon" href="<?php echo e(asset('assets/images/fevicon.png')); ?>" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="<?php echo e(asset('assets/css/jquery.mCustomScrollbar.min.css')); ?>">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="<?php echo e(asset('assets/images/loading.gif')); ?>" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.html"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-10 offset-md-1">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                 <a class="nav-link" href="index">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="about">About</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="service">Services</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="gallery">Gallery</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="testimonial"> Testimonial </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact">Contact Us</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Design <br>Of Furniture</h1>
                                 <span>There are many variations of passages of Lorem Ipsum available</span>
                                 <a class="read_more" href="Javascript:void(0)">Read More</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Design <br>Of Furniture</h1>
                                 <span>There are many variations of passages of Lorem Ipsum available</span>
                                 <a class="read_more" href="Javascript:void(0)">Read More</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Design <br>Of Furniture</h1>
                                 <span>There are many variations of passages of Lorem Ipsum available</span>
                                 <a class="read_more" href="Javascript:void(0)">Read More</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </section>
      <!-- end banner -->
      <!-- about -->
      <div id="about" class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="titlepage">
                     <h2>About <span class="green">Us</span></h2>
                     <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humourThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                     <a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure><img src="<?php echo e(asset('assets/images/about.png')); ?>" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!--  service -->
      <div id="service" class="service">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our <span class="green">Services</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="row">
                     <div class="col-md-4 col-sm-6">
                        <div class="service_box">
                           <i><img src="<?php echo e(asset('assets/images/service1.png')); ?>" alt="#"/></i>
                           <h3>Retina Ready</h3>
                           <p>many variations of passages <br>of Lorem Ipsum available,</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-1 col-sm-6">
                        <div class="service_box">
                           <i><img src="<?php echo e(asset('assets/images/service2.png')); ?>" alt="#"/></i>
                           <h3>Creative Elements</h3>
                           <p>many variations of passages <br>of Lorem Ipsum available,</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-3 col-sm-6 mar_top">
                        <div class="service_box">
                           <i><img src="<?php echo e(asset('assets/images/service3.png')); ?>" alt="#"/></i>
                           <h3>Easy-to-Use</h3>
                           <p>many variations of passages <br>of Lorem Ipsum available,</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-1 col-sm-6 mar_top">
                        <div class="service_box">
                           <i><img src="<?php echo e(asset('assets/images/service4.png')); ?>" alt="#"/></i>
                           <h3>Easy Import</h3>
                           <p>many variations of passages <br>of Lorem Ipsum available,</p>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <a class="read_more" href="Javascript:void(0)"> Read More</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end service -->
      <!-- gallery -->
      <div id="gallery"  class="gallery">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our <span class="green">gallery</span></h2>
                     <p>here are many variations of passages of Lorem Ipsum available, but the majority have suffer</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_text">
                     <div class="galleryh3">
                        <h3>Interior Design</h3>
                        <p>of passages of Lorem <br>
                           Ipsum available <br>
                           , but the majority <br>
                           have suffer
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery1.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery2.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery3.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery4.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_text">
                     <div class="galleryh3">
                        <h3>Interior Design</h3>
                        <p>of passages of Lorem <br>
                           Ipsum available <br>
                           , but the majority <br>
                           have suffer
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_text">
                     <div class="galleryh3">
                        <h3>Interior Design</h3>
                        <p>of passages of Lorem <br>
                           Ipsum available <br>
                           , but the majority <br>
                           have suffer
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery5.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="<?php echo e(asset('assets/images/gallery6.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end gallery -->
      <!-- design -->
      <div class="design">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-5">
                  <div id="design" class="carousel slide banner_design" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#design" data-slide-to="0" class="active"></li>
                        <li data-target="#design" data-slide-to="1"></li>
                        <li data-target="#design" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>New Ideas <span class="green">Design</span></h2>
                                          </div>
                                          <p>There are many variations of passages of Lorem Ipsum available, but theThere are many variations of passages of Lorem Ipsum available, but the</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>New Ideas <span class="green">Design</span></h2>
                                          </div>
                                          <p>There are many variations of passages of Lorem Ipsum available, but theThere are many variations of passages of Lorem Ipsum available, but the</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>New Ideas <span class="green">Design</span></h2>
                                          </div>
                                          <p>There are many variations of passages of Lorem Ipsum available, but theThere are many variations of passages of Lorem Ipsum available, but the</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#design" role="button" data-slide="prev">
                     <i class="fa fa-angle-left" aria-hidden="true"></i>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#design" role="button" data-slide="next">
                     <i class="fa fa-angle-right" aria-hidden="true"></i>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
               <div class="col-md-7 pad_roght0">
                  <div class="design_img">
                     <figure><img src="<?php echo e(asset('assets/images/desi.jpg')); ?>" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end design -->
      <!-- latest news -->
      <div  class="latest_news">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Read Our <span class="green">Latest News</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 offset-md-2">
                  <div id="new" class="news_box">
                     <div class="news_img">
                        <figure><img src="<?php echo e(asset('assets/images/blog1.jpg')); ?>" alt="#"/></figure>
                     </div>
                     <div class="news_room">
                        <span>Post By :limelight</span>
                        <ul>
                           <li><a href="Javascript:void(0)">Like <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Comment <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Share <i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                        </ul>
                        <h3>Interior Design</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content  </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 ">
                  <div id="new" class="news_box">
                     <div class="news_img mr_le">
                        <figure><img src="<?php echo e(asset('assets/images/blog1.jpg')); ?>" alt="#"/></figure>
                     </div>
                     <div class="news_room">
                        <span>Post By :limelight</span>
                        <ul>
                           <li><a href="Javascript:void(0)">Like <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Comment <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Share <i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                        </ul>
                        <h3>Artictecture</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content  </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <a class="read_more" href="Javascript:void(0)"> Read More</a>
               </div>
            </div>
         </div>
      </div>
      <!-- end latest news -->
      <!-- testimonial -->
      <div id="testimonial" class="Testimonial">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-8 pad_left0">
                  <div id="testimon" class="carousel slide banner_testimonial" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#testimon" data-slide-to="0" class="active"></li>
                        <li data-target="#testimon" data-slide-to="1"></li>
                        <li data-target="#testimon" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett1.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett2.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett1.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett2.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett1.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="<?php echo e(asset('assets/images/tett2.png')); ?>" alt="#"/></i>
                                          <span>HumouThere</span>
                                          <p>T suffered alteration in some form, by injected humouThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humou</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#testimon" role="button" data-slide="prev">
                     <i class="fa fa-angle-left" aria-hidden="true"></i>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#testimon" role="button" data-slide="next">
                     <i class="fa fa-angle-right" aria-hidden="true"></i>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 ">
                  <div class="titlepage">
                     <h2>Testimonial</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end design -->
      <!--  contact -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form id="request" class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Name" type="type" name="Name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="type" name="Email"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">                          
                        </div>
                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Send</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="345" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-3 col-sm-6">
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                     </ul>
                     <p class="variat pad_roght2">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by 
                     </p>
                  </div>
                  <div class=" col-md-3 col-sm-6">
                     <h3>LET US HELP YOU </h3>
                     <p  class="variat pad_roght2">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by 
                     </p>
                  </div>
                  <div class="col-md-3 col-sm-6">
                     <h3>INFORMATION</h3>
                     <ul class="link_menu">
                     <li><a href="index">Home</a></li>
                        <li><a href="about"> About</a></li>
                        <li><a href="service">Services</a></li>
                        <li><a href="gallery">Gallery</a></li>
                        <li><a href="testimonial">Testimonial</a></li>
                        <li><a href="contact">Contact Us</a></li>
                     </ul>
                  </div>
                  <div class="col-md-3 col-sm-6">
                     <h3>OUR Design</h3>
                     <p  class="variat">There are many variat
                        ions of passages of L
                        orem Ipsum available
                        , but the majority h
                        ave suffered altera
                        tion in some form, by 
                     </p>
                  </div>
                  <div class="col-md-6 offset-md-6">
                     <form id="hkh" class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/jquery-3.0.0.min.js')); ?>"></script>
      <!-- sidebar -->
      <script src="<?php echo e(asset('assets/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\appTest\resources\views//templateL/index.blade.php ENDPATH**/ ?>