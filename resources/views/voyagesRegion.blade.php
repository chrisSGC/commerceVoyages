@extends('layout.template')

@section('contenuPage')
        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('img/hero/contact_hero.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Nos voyages</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <!-- Favourite Places Start -->
        <div class="favourite-place place-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Nos voyages</span>
                            <h2>[{{$region->codeRegion}}] {{$region->nomRegion}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row" id="listeVoyages">
                    @foreach ($voyagesRegion as $voyage)
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
@endsection