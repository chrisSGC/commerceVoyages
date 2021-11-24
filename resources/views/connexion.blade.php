@extends('layout.template')

@section('contenuPage')

     <!-- slider Area Start-->
     <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Zone membre</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
     <!-- slider Area End-->
    <!--================Blog Area =================-->
    
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h2>Inscription</h2>
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input class="form-control valid" name="prenom" id="prenom" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez vote prénom'" placeholder="Prénom">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input class="form-control valid" name="nom" id="nom" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre nom de famille'" placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="courriel">Adresse courriel</label>
                                    <input class="form-control valid" name="courriel" id="courriel" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre adresse courriel'" placeholder="Courriel">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="identifiantComtpe">Mot de passe</label>
                                    <input class="form-control valid" name="identifiantComtpe" id="identifiantComtpe" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre mot de passe'" placeholder="Mot de passe">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">M'inscrire</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <h2>Connexion</h2>
                    <form class="form-contact contact_form" action="" method="post" id="connexion" novalidate="novalidate">
                        <div id="csrfConnexion">@csrf</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Adresse courriel</label>
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="identifiant">Mot de passe</label>
                                    <input class="form-control valid" name="identifiant" id="identifiant" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Mot de passe">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div onClick="connexion()" class="button button-contactForm boxed-btn">Connexion</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/connexion.js')}}"></script>
    <!--================Blog Area =================-->
@endsection