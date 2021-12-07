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
            @if ($errors->any())  
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">  
                            <strong>Woop woop</strong> Hmmm ca sent l'illégalité ici! On va te balancer à la maréchaussée!!<br>
                            <ul class="list-unstyled">  
                                @foreach ($errors->all() as $error)  
                                    <li>{{ $error }}</li>  
                                @endforeach  
                            </ul>  
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h2>Inscription</h2>
                    <form class="form-contact contact_form" action="/connexion/validerInscription" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="provenance" value="{{$provenance}}" />
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input class="form-control valid" value="{{ old('prenom') }}" name="prenom" id="prenom" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez vote prénom'" placeholder="Prénom">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input class="form-control valid" value="{{ old('nom') }}" name="nom" id="nom" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre nom de famille'" placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <select class="w-100 valid" value="{{ old('genre') }}" name="genre" id="genre" >
                                        <option>Choisissez votre genre</option>
                                        <option {{ old('genre') == "M" ? "selected" : "" }} value="M">Homme</option>
                                        <option {{ old('genre') == "F" ? "selected" : "" }} value="F">Femme</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="courriel">Adresse courriel</label>
                                    <input class="form-control valid" value="{{ old('courriel') }}" name="courriel" id="courriel" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre adresse courriel'" placeholder="Courriel">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label for="premierContact">Comment vous avez-nous trouvé?</label>
                                    <select class="w-100 valid" value="{{ old('premierContact') }}" name="premierContact" id="premierContact" >
                                        <option>Choisissez votre moyen de premier contact</option>
                                        @foreach($premierContact as $contact)
                                            <option {{ old('premierContact') == $contact->id ? "selected" : "" }} value="{{$contact->id}}">{{$contact->premierContact}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="motDePasse">Mot de passe</label>
                                    <input class="form-control valid" value="{{ old('motDePasse') }}" name="motDePasse" id="motDePasse" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre mot de passe'" placeholder="Mot de passe">
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
                    <form class="form-contact contact_form" action="/connexion/validerConnexion" method="post" id="connexion" novalidate="novalidate">
                        @if($erreurConnexion == 1)
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh non!</strong> Il semblerait que vous essayez d'entrer illégalement en France? Tssss la PAF va vous tomber dessus!
                            </div>
                        @endif
                        <div id="csrfConnexion">@csrf</div>
                        <input type="hidden" name="provenance" value="{{$provenance}}" />
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Adresse courriel</label>
                                    <input class="form-control valid" value="{{ old('email') }}" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="identifiant">Mot de passe</label>
                                    <input class="form-control valid" value="{{ old('identifiant') }}" name="identifiant" id="identifiant" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Mot de passe">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--================Blog Area =================-->
@endsection