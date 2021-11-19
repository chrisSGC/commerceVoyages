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
                        <h2>{{$voyage->nomVoyage}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
 <!-- slider Area End-->
 <!--================Blog Area =================-->
 <section class="blog_area single-post-area section-padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-8 posts-list">
             <div class="single-post">
                <div class="feature-img">
                   <img class="img-fluid" src="{{ asset('img/hero/blog/single_blog_1.png') }}" alt="">
                </div>
                <div class="blog_details">
                   <table class="w-100">
                       <tr>
                           <th>Date</th><td>{{$voyage->dateDebut}}</td>
                        </tr>
                        <tr>
                           <th>Departement</th><td>[{{$voyage->codeDepartement}}] - {{$voyage->nomDepartement}}</td>
                        </tr>
                        <tr>
                           <th>Ville</th><td>{{$voyage->ville}}</td>
                        </tr>
                        <tr>
                           <th>Duree</th><td>{{$voyage->duree}} jours</td>
                       </tr>
                   </table>
                </div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <div><h2>{{$voyage->prix}}$</h2></div>
                    <div id="csrf" style="display: none">@csrf</div>
                    <button onClick='ajouterVoyageAuPanier({{$voyage->idVoyage}})' class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="button">Ajouter a mon panier</button>
                </aside>
                <aside class="single_sidebar_widget post_category_widget">
                   <h4 class="widget_title">Categorie</h4>
                   <ul class="list cat-list">
                     <li><p>{{$voyage->categorie}}</p></li>
                   </ul>
                </aside>
             </div>
          </div>
       </div>
    </div>
 </section>
 <script src="{{ asset('js/voyage.js')}}"></script>
 <!--================ Blog Area end =================-->
@endsection