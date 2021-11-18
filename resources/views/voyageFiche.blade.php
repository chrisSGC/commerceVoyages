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
                   <table>
                       <tr>
                           <th>Date</th><td>DFGFGDF</td>
                        </tr>
                        <tr>
                           <th>Departement</th><td>DFGFGDF</td>
                        </tr>
                        <tr>
                           <th>Ville</th><td>DFGFGDF</td>
                        </tr>
                        <tr>
                           <th>Duree</th><td>DFGFGDF</td>
                       </tr>
                   </table>
                </div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <div><h2>PRIX</h2></div>
                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="button">Ajouter a mon panier</button>
                </aside>
                <aside class="single_sidebar_widget post_category_widget">
                   <h4 class="widget_title">Categorie</h4>
                   <ul class="list cat-list">
                      <li>
                         <a href="#" class="d-flex">
                            <p>Resaurant food</p>
                            <p>(37)</p>
                         </a>
                      </li>
                   </ul>
                </aside>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--================ Blog Area end =================-->
@endsection