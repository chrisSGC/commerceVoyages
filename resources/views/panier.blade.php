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
                            <h2>Mon panier</h2>
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
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>NOM PRODUIT</th>
                                <th class="text-center">PU</th>
                                <th class="text-center">NOMBRE DE VOYAGEURS</th>
                                <th class="text-center">TOTAL</th> 
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contenuPanier as $itemPanier)
                                <tr id="ligne{{$itemPanier->idPanier}}" class="main-hading" data-idPanier="{{$itemPanier->idPanier}}">
                                    <th>{{$itemPanier->nomVoyage}}</th>
                                    <th id="pu{{$itemPanier->idPanier}}" class="text-center">{{number_format($itemPanier->prix, 2, ',', ' ')}} $</th>
                                    <th class="text-center">@csrf<span onClick="retirerUn(this)" class="moins"><i class="far fa-minus-square"></i></span><span id="qte{{$itemPanier->idPanier}}" class="qteObj">{{$itemPanier->quantite}}</span><span onClick="ajouterUn(this)" class="plus"><i class="far fa-plus-square"></i></span></th>
                                    <th class="text-center" id="prix{{$itemPanier->idPanier}}">{{number_format($itemPanier->prix * $itemPanier->quantite, 2, ',', ' ')}} $</th> 
                                    <th class="text-center"><i onCLick="supprimer(this)" class="ti-trash remove-icon"></i></th>
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
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <!--<p class="mt-4"><strong>les-meilleurs-jeux.fr</strong> est basé à Paris et est donc soumis à la loi fiscale française. De ce fait, vous payez la TVA. De plus, la loi française impose d'indiquer les prix TTC. Les prix affichés de nos jeux comportent donc déjà les taxes.</p>
                                    <p class="mt-4">Dans un soucis de simplicité pour vous, <strong>les-meilleurs-jeux.fr</strong> vous propose de regler vos achats dans votre devise locale. Vous pouriez observer des variations de prix de jour en jour dûes au taux de change.</p>-->
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Sous total<span id="montantSousTotal">{{number_format($montant, 2, ',', ' ')}}</span> $</li>
                                        <li>TPS (5%)<span id="montantTPS">{{number_format($montant * 5 / 100, 2, ',', ' ')}}</span> $</li>
                                        <li>TVQ (9, 975%)<span id="montantTVQ">{{number_format($montant * 9.975 / 100, 2, ',', ' ')}}</span> $</li>
                                        <li class="last">Total<span id="grandTotal">{{number_format(($montant + ($montant * 5 / 100) + ($montant * 9.975 / 100)), 2, ',', ' ')}}</span> $</li>
                                    </ul>
                                    <div class="button5">
                                        <a href="/connexion/2" class="btn btn-block mb-2">COMMANDER</a>
                                        <a href="/voyages" class="btn btn-block">Continuer mes achats</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/panier.js')}}"></script>
    <!--================Blog Area =================-->
@endsection