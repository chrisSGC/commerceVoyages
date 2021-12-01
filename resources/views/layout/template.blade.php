@if(\App\Http\Controllers\CompteControleur::obtenirTypeCompte() == 1)
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>[DEV 1.0] Administration | YvanDVoyages</title>
            <style>
                .bd-placeholder-img {
                    font-size: 1.125rem;
                    text-anchor: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    user-select: none;
                }
        
                @media (min-width: 768px) {
                    .bd-placeholder-img-lg {
                        font-size: 3.5rem;
                    }
                }
            </style>
        
            
            <!-- Custom styles for this template -->
            <link href="{{ asset('css/admin/bootstrap.css') }}" rel="stylesheet">
            <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
        </head>
        <body>
            <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/dashboard">YvanDVoyages</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <input class="form-control form-control-dark w-100" type="text" placeholder="Rechercher un client ou un produit" aria-label="Search">
                <div class="navbar-nav">
                    <div class="nav-item text-nowrap">
                        <a class="nav-link px-3" href="/deconnexion">Quitter</a>
                    </div>
                </div>
            </header>
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/dashboard"><span data-feather="home"></span> Tableau de bord</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/ventes"><span data-feather="file"></span> Ventes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/listeVoyages"><span data-feather="shopping-cart"></span> Voyages</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="/clients"><span data-feather="users"></span> Clients</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><span data-feather="bar-chart-2"></span> Statistiques</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        @yield('contenuAdmin')
                    </main>
                </div>
            </div>
        </body>
        <script src="{{ asset('js/admin/bootstrap.bundle.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="{{ asset('js/admin/dashboard.js')}}"></script>
    </html>
@else
    <!doctype html>
    <html class="no-js" lang="fr">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>[DEV 1.0] Yvan Des Voyages - Leader Nord-Americian de la vente de voyages en france</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="manifest" href="site.webmanifest">
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

            <!-- CSS here -->
            <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
            <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
            <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
            <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
            <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
            <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
            <link rel="stylesheet" href="{{ asset('css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        </head>
        {{ \App\Http\Controllers\PanierControleur::initialiserPanier() }}
        <body>
            <!-- Preloader Start -->
            <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="preloader-img pere-text">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Preloader Start -->
            <header>
                <!-- Header Start -->
            <div class="header-area">
                    <div class="main-header ">
                        <div class="header-top top-bg d-none d-lg-block">
                        <div class="container">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-lg-8">
                                    <div class="header-info-left">
                                        <ul>                          
                                            <li>contact@yvandvoyages.ca</li>
                                            <li>418 846 5471</li>
                                            <li>Boulevard Hotel de ville - Riviere-du-Loup</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="header-info-right f-right">
                                        <ul class="header-social">    
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="header-bottom  header-sticky">
                            <div class="container">
                                <div class="row align-items-center">
                                    <!-- Logo -->
                                    <div class="col-xl-2 col-lg-2 col-md-1">
                                        <div class="logo">
                                        <a href="/"><img src="assets/img/logo/logo.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10 col-md-10">
                                        <!-- Main-menu -->
                                        <div class="main-menu f-right d-none d-lg-block">
                                            <nav>               
                                                <ul id="navigation">
                                                    <li><a href="/">Acceuil</a></li>
                                                    <li><a href="/voyages">Nos voyages</a>
                                                        <ul class="submenu">
                                                            <li><a href="/voyages">Tous</a></li>
                                                            @foreach (\App\Http\Controllers\RegionControleur::regions() as $region)
                                                                <li><a href="/voyages/{{$region->id}}">{{$region->nomRegion}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><a href="/agence">L'agence</a></li>
                                                    <li><a href="/panier">Panier <span id="articles" class="total-count">{{\App\Http\Controllers\PanierControleur::$nombreArticles}}</span></a></li>
                                                    <li><a href="/contact">Contactez-nous</a></li>
                                                    @if(\App\Http\Controllers\CompteControleur::verifierConnexion())
                                                        <li><a href="/historique">Mes achats</a></li>
                                                        <li><a href="/deconnexion" class="button button-contactForm boxed-btn">Déconnexion</a></li>
                                                    @else
                                                        <li><a href="/connexion" class="button button-contactForm boxed-btn">Connexion / Inscription</a></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <!-- Mobile Menu -->
                                    <div class="col-12">
                                        <div class="mobile_menu d-block d-lg-none"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
            </div>
                <!-- Header End -->
            </header>

            <main>
                @yield('contenuPage')
            </main>
            <footer>
                <!-- Footer Start-->
                <div class="footer-area footer-padding footer-bg" data-background="{{ asset('img/service/footer_bg.jpg') }}">
                    <div class="container">
                        <div class="row d-flex justify-content-between">
                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="index.html"><img src="{{ asset('img/logo/logo2_footer.png') }}" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera text-danger">
                                            <p style="color: red!important; font-weight: bold;">Ce site est 300% illégal car il n'est en aucun cas titulaire d'un permis du Québec valide aupres de l'OPC et n'est pas non plus affilié à une agence de voyage quelquonque titulaire d'un permis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>En bref</h4>
                                        <ul>
                                            <li><a href="#">A propos</a></li>
                                            <li><a href="#">Offres spéciales</a></li>
                                            <li><a href="#">Offrez une carte cadeau</a></li>
                                            <li><a href="/contact">Nous contacter</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>nouveaux voyages</h4>
                                        <ul>
                                            <li><a href="#">Paris de nuit</a></li>
                                            <li><a href="#">La Loire au fil des siècles</a></li>
                                            <li><a href="#">Reims, la cité des rois</a></li>
                                            <li><a href="#">Avignon, résidence forcée des Papes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>Support</h4>
                                        <ul>
                                        <li><a href="#">Question fréquentes</a></li>
                                        <li><a href="#">CGV</a></li>
                                        <li><a href="#">Politique de confidentialité</a></li>
                                        <li><a href="#">Plaintes</a></li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer bottom -->
                        <div class="row pt-padding">
                            <div class="col-xl-7 col-lg-7 col-md-7">
                                <div class="footer-copy-right">
                                    <p>Christophe Ferru - Programmation web avancee - Cegep de Riviere-du-Loup - Aut 2021</p>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5">
                                    <!-- social -->
                                    <div class="footer-social f-right">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-behance"></i></a>
                                        <a href="#"><i class="fas fa-globe"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End-->
            </footer>

            <!-- JS here -->

            <!-- All JS Custom Plugins Link Here here -->
            <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js')}}"></script>
            
            <!-- Jquery, Popper, Bootstrap -->
            <script src="{{ asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
            <script src="{{ asset('js/popper.min.js')}}"></script>
            <script src="{{ asset('js/bootstrap.min.js')}}"></script>
            <!-- Jquery Mobile Menu -->
            <script src="{{ asset('js/jquery.slicknav.min.js')}}"></script>

            <!-- Jquery Slick , Owl-Carousel Plugins -->
            <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
            <script src="{{ asset('js/slick.min.js')}}"></script>
            <!-- One Page, Animated-HeadLin -->
            <script src="{{ asset('js/wow.min.js')}}"></script>
            <script src="{{ asset('js/animated.headline.js')}}"></script>
            <script src="{{ asset('js/jquery.magnific-popup.js')}}"></script>

            <!-- Scrollup, nice-select, sticky -->
            <script src="{{ asset('js/jquery.scrollUp.min.js')}}"></script>
            <script src="{{ asset('js/jquery.nice-select.min.js')}}"></script>
            <script src="{{ asset('js/jquery.sticky.js')}}"></script>
            
            <!-- contact js -->
            <!--<script src="{{ asset('js/contact.js')}}"></script>-->
            <script src="{{ asset('js/jquery.form.js')}}"></script>
            <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
            <script src="{{ asset('js/mail-script.js')}}"></script>
            <script src="{{ asset('js/jquery.ajaxchimp.min.js')}}"></script>
            
            <!-- Jquery Plugins, main Jquery -->	
            <script src="{{ asset('js/plugins.js')}}"></script>
            <script src="{{ asset('js/main.js')}}"></script>
            <script src="{{ asset('js/app.js')}}"></script>
        </body>
    </html>
@endif