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
                <div class="col-12">
                    <div class="alert alert-success">
                        <strong>Achat confirmé!</strong> Merci d'avoir acheté en toute illégalité vos prochaine vacances [avortées]! Un conseiller en voyage [ne] vous contera [pas] bientot afin de compléter les dernières formalités pour vos billets et l'imigration.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection