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
                            <h2>Faire un paiement</h2>
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
                <div class="col-12">
                    <div class="row"><div class="col-12"><h3>Informations de facturation et livraison</h3></div></div>
                    @if ($errors->any())  
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">  
                                    <strong>Bon...</strong> Ca y est, ca essaye de frauder le fisc!<br>
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
                            <form class="form-contact contact_form" action="/validerPaiement" method="post" id="ajouterPaiement" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="province">Achat</label>
                                            <select class="w-100 valid" value="{{ old('vente') }}" name="vente" id="vente" >
                                                <option>Choisissez un achat</option>
                                                @foreach($listeVentes as $vente)
                                                    <option {{ old('vente') == $vente->idVente ? "selected" : "" }} value="{{$vente->idVente}}">[{{$vente->idVente}}] {{$vente->nomVoyage}}</option>
                                                @endforeach
                                            </select>
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
                                            <label for="montant">Montant</label>
                                            <input class="form-control valid" value="{{ old('montant') }}" name="montant" id="montant" type="number" step='.01' min='1' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Montant'" placeholder="Montant">
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
                                    <button type="submit" class="button button-contactForm boxed-btn">Payer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection