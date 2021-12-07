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
                            <h2>Historique de mes achats</h2>
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
                                <th class="text-center">DATE ACHAT</th>
                                <th class="text-center">PRIX UNITAIRE</th>
                                <th class="text-center">NOMBRE DE VOYAGEURS</th>
                                <th class="text-center">TOTAL</th> 
                                <th class="text-center">PAIEMENT RECU</th> 
                                <th class="text-center">PAIEMENTS</th> 
                                <th class="text-center">ETAT</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contenuVentes as $item)
                                @if($item->etatVente)
                                    <tr class="main-hading">
                                @else
                                    <tr class="main-hading bg-warning">
                                @endif
                                    <th>{{$item->nomVoyage}}</th>
                                    <th>{{$item->dateVente}}</th>
                                    <th class="text-center">{{number_format($item->prix, 2, ',', ' ')}} $</th>
                                    <th class="text-center"><span class="qteObj">{{$item->quantite}}</span></th>
                                    <th class="text-center">{{number_format($item->prix * $item->quantite, 2, ',', ' ')}} $</th> 
                                    <th class="text-center">{{number_format($item->montantPercu, 2, ',', ' ')}} $</th> 
                                    @if($item->etatPaiement)
                                        <th class="text-center"><span class="badge badge-success">Payé</span></th> 
                                    @else
                                        <th class="text-center"><span class="badge badge-danger">Paiement nécessaire</span></th> 
                                    @endif
                                    @if($item->etatVente == 0)
                                        <th class="text-center"><span class="badge badge-danger">Vente annulée</span></th> 
                                    @else
                                        <th></th>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
        </div>
    </div>
    <!--================Blog Area =================-->
@endsection