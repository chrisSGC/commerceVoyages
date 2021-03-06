@extends('layout.template')

@section('contenuPage')
        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider hero-overly  slider-height d-flex align-items-center" data-background="{{ asset('img/hero/h1_hero.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="hero__caption">
                                    <h1>Trouvez le <span>Tour de France...</span> </h1>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- form -->
                                <form action="#" class="search-box">
                                    <div class="input-form mb-30">
                                        <input type="text" placeholder="Dites-nous ou vous voulez aller ? (NON FONCTIONNELLE)">
                                    </div>
                                    <div class="search-form mb-30">
                                        <a href="#">Recherche</a>
                                    </div>	
                                </form>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- Our Services Start -->
        <div class="our-services servic-padding">
            <div class="container">
                <div class="row d-flex justify-contnet-center">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="services-cap">
                                <h5>8000+ Nos experts<br>de la France</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-ion">
                                <span class="flaticon-pay"></span>
                            </div>
                            <div class="services-cap">
                                <h5>100% de satisfaction<br>client truqu??e</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-ion">
                                <span class="flaticon-experience"></span>
                            </div>
                            <div class="services-cap">
                                <h5>28+ ann??es d'anraques<br>organis??es</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-ion">
                                <span class="flaticon-good"></span>
                            </div>
                            <div class="services-cap">
                                <h5>98% voyageurs refoul??s<br>?? la douane</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Our Services End -->
        <!-- Favourite Places Start -->
        <div class="favourite-place place-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>VOYAGES VEDETTES</span>
                            <h2>Nos voyages favoris</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($sixVoyages as $voyage)
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-place mb-30">
                                <div class="place-img">
                                    <img src="{{ asset('img/service/services1.jpg') }}" alt="">
                                </div>
                                <div class="place-cap">
                                    <div class="place-cap-top">
                                        <span><i class="fas fa-star"></i><span>8.0 Superb</span> </span>
                                        <h3><a href="/voyages/fiche/{{$voyage->id}}">{{$voyage->nomVoyage}}</a></h3>
                                        <p class="dolor">{{$voyage->prix}}$ <span>/ Par Personne</span></p>
                                    </div>
                                    <div class="place-cap-bottom">
                                        <ul>
                                            <li><i class="far fa-clock"></i>{{$voyage->duree}} jours</li>
                                            <li><i class="fas fa-map-marker-alt"></i>{{$voyage->ville}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Favourite Places End -->
        <!-- Video Start Arera -->
        <div class="video-area video-bg pt-200 pb-200"  data-background="{{ asset('img/service/video-bg.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="video-caption text-center">
                            <div class="video-icon">
                                <a class="popup-video" href="https://youtu.be/1SBS_Y2q528" tabindex="0"><i class="fas fa-play"></i></a>
                            </div>
                            <p class="pera1">Aimez ce qu'offrent nos concurents</p>
                            <p class="pera2">YvanDvoyages est le leader mondial</p>
                            <p class="pera3"> de l'arnaque au voyage</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start End -->
        <!-- Support Company Start-->
        <div class="support-company-area support-padding fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img mb-50">
                            <img src="{{ asset('img/service/support-img.jpg') }}" alt="">
                            <div class="support-img-cap">
                                <span>Depuis 1992</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <span>A propos de nous</span>
                                <h2>nous sommes <br>YvanDvoyages</h2>
                            </div>
                            <div class="support-caption">
                                <p>Le leader de la vente de voyages ill??gaux vers la France car nous n'avons aucun permis de l'OPC.</p>
                                <div class="select-suport-items">
                                    <label class="single-items">Aucun permis de l'OPC
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Totallement illegal
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Support 24/24 7/7 avant encaissement
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Nous aimons nos clients
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="#" class="btn">A propos de nous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- Testimonial Start -->
        <div class="testimonial-area testimonial-padding" data-background="{{ asset('img/testmonial/testimonial_bg.jpg') }}">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-11 col-lg-11 col-md-9">
                        <div class="h1-testimonial-active">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="assets/img/icon/testimonial.png" alt="">
                                        <p>J'ai achet?? sur YvanDVoyages 3 fois et tout s'est bien pass?? en graissant la patte du douanier en arrivant ?? papeette.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="{{ asset('img/testmonial/Homepage_testi.png') }}" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="{{ asset('img/icon/testimonial.png') }}" alt="">
                                        <p>Oubliez le pr??c??dent commentaire, je viens de me faire arreter pour immigration ill??gal ?? mon 4e voyage. On  m'a dit que je n'avais pas mon autorisation de voyage ?? mon arriv??e alros que Yvan m'avait assur?? que oui.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="{{ asset('img/testmonial/Homepage_testi.png') }}" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
@endsection