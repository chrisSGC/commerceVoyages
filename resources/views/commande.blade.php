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
                            <h2>Finaliser ma commande</h2>
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
                <div class="col-12 col-xl-6">
                    <div class="row"><div class="col-12"><h3>Informations de facturation et livraison</h3></div></div>
                    @if ($errors->any())  
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">  
                                    <strong>Bon...</strong> Ca yest, ca essaye de frauder le fisc!<br>
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
                        <div class="col-12">
                            <form class="form-contact contact_form" action="/commande/validerCommande" method="post" id="achatForm" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="prenom">Prénom</label>
                                            <input class="form-control valid" value="{{ $utilisateur->prenom }}" readonly name="prenom" id="prenom" type="text" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input class="form-control valid" value="{{ $utilisateur->nom }}" readonly name="nom" id="nom" type="text" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="courriel">Adresse courriel</label>
                                            <input class="form-control valid" value="{{ $utilisateur->courriel }}" name="courriel" id="courriel" type="email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input class="form-control valid" value="{{ old('adresse') }}" name="adresse" id="adresse" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre adresse postale'" placeholder="Adresse postale">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="ville">Ville</label>
                                            <input class="form-control valid" value="{{ old('ville') }}" name="ville" id="ville" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre ville'" placeholder="Ville">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="codePostal">Code postal</label>
                                            <input class="form-control valid" value="{{ old('codePostal') }}" name="codePostal" id="codePostal" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre code postal'" placeholder="Code postal">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="province">Province</label>
                                            <select class="w-100 valid" value="{{ old('province') }}" name="province" id="province" >
                                                <option>Choisissez votre province</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->id}}">[{{$province->codeProvince}}] {{$province->province}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="telephone">Téléphone</label>
                                            <input class="form-control valid" value="{{ old('telephone') }}" name="telephone" id="telephone" type="tel" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre téléphone'" placeholder="téléphone">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nomCarte">Nom sur la carte</label>
                                            <input class="form-control valid" value="{{ old('nomCarte') }}" name="nomCarte" id="nomCarte" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Titulaire de la carte'" placeholder="Titulaire de la carte">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="numeroCarte">Numéro de carte</label>
                                            <div class="input-group">
                                                <input class="form-control" value="{{ old('numeroCarte') }}" type="text" placeholder="0000 0000 0000 0000" name="numeroCarte" id="numeroCarte">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="mdi mdi-credit-card"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="ccmonth">Mois</label><br>
                                                    <select value="{{ old('moisCarte') }}" class="form-control w-100" name="moisCarte" id="ccmonth">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="ccyear">Année</label><br>
                                                <select value="{{ old('anneeCarte') }}" class="form-control w-100" name="anneeCarte" id="ccyear">
                                                    <option>2021</option>
                                                    <option>2022</option>
                                                    <option>2023</option>
                                                    <option>2024</option>
                                                    <option>2025</option>
                                                    <option>2026</option>
                                                    <option>2027</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="cvv">CVV/CVC</label>
                                                    <input value="{{ old('cvv') }}" class="form-control" name="cvv" id="cvv" type="text" placeholder="123">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="button button-contactForm boxed-btn">Commander</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="row"><div class="col-12"><h3>Résumé de la commande</h3></div></div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Shopping Summery -->
                            <table class="table shopping-summery">
                                <thead>
                                    <tr class="main-hading">
                                        <th>NOM PRODUIT</th>
                                        <th class="text-center">PU</th>
                                        <th class="text-center">NOMBRE DE VOYAGEURS</th>
                                        <th class="text-center">TOTAL</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contenuPanier as $itemPanier)
                                        <tr class="main-hading">
                                            <th>{{$itemPanier->nomVoyage}}</th>
                                            <th class="text-center">{{number_format($itemPanier->prix, 2, ',', ' ')}} $</th>
                                            <th class="text-center"><span class="qteObj">{{$itemPanier->quantite}}</span></th>
                                            <th class="text-center">{{number_format($itemPanier->prix * $itemPanier->quantite, 2, ',', ' ')}} $</th> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--/ End Shopping Summery -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Total Amount -->
                            <div class="total-amount">
                                <div class="row">
                                    <div class="col-lg-4 col-md-3 col-12">
                                        <div class="left">
                                            <!--<p class="mt-4"><strong>les-meilleurs-jeux.fr</strong> est basé à Paris et est donc soumis à la loi fiscale française. De ce fait, vous payez la TVA. De plus, la loi française impose d'indiquer les prix TTC. Les prix affichés de nos jeux comportent donc déjà les taxes.</p>
                                            <p class="mt-4">Dans un soucis de simplicité pour vous, <strong>les-meilleurs-jeux.fr</strong> vous propose de regler vos achats dans votre devise locale. Vous pouriez observer des variations de prix de jour en jour dûes au taux de change.</p>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-12">
                                        <div class="right">
                                            <ul>
                                                <li>Sous total<span id="montantSousTotal">{{number_format($montant, 2, ',', ' ')}}</span> $</li>
                                                <li>TPS (5%)<span id="montantTPS">{{number_format($montant * 5 / 100, 2, ',', ' ')}}</span> $</li>
                                                <li>TVQ (9, 975%)<span id="montantTVQ">{{number_format($montant * 9.975 / 100, 2, ',', ' ')}}</span> $</li>
                                                <li class="last">Total<span id="grandTotal">{{number_format(($montant + ($montant * 5 / 100) + ($montant * 9.975 / 100)), 2, ',', ' ')}}</span> $</li>
                                            </ul>
                                            <!--<div class="button5">
                                                <a href="/connexion" class="btn btn-block mb-2">COMMANDER</a>
                                                <a href="/voyages" class="btn btn-block">Continuer mes achats</a>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Total Amount -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection