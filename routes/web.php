<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilControleur;
use App\Http\Controllers\AgenceControleur;
use App\Http\Controllers\BlogControleur;
use App\Http\Controllers\ContactControleur;
use App\Http\Controllers\VoyageControleur;
use App\Http\Controllers\RegionControleur;
use App\Http\Controllers\PanierControleur;
use App\Http\Controllers\ConnexionControleur;
use App\Http\Controllers\CommandeControleur;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AccueilControleur::class, 'accueil'])->name('accueil.page');

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/voyages', [VoyageControleur::class, 'voyages'])->name('voyages.page');
Route::get('/voyages/plus', [VoyageControleur::class, 'obtenirPlusVoyages'])->name('voyages.plus');
Route::get('/voyages/{id}', [VoyageControleur::class, 'voyagesRegion'])->name('voyages.region');
Route::get('/voyages/fiche/{id}', [VoyageControleur::class, 'voyageFiche'])->name('voyages.details');
/*Route::get('/voyages', function () {
    return view('welcome');
});*/
Route::get('/blog', [BlogControleur::class, 'blog'])->name('blog.page');
Route::get('/panier', [PanierControleur::class, 'panier'])->name('panier.page');
Route::post('/panier/moins', [PanierControleur::class, 'moins'])->name('panier.moins');
Route::post('/panier/plus', [PanierControleur::class, 'plus'])->name('panier.plus');
Route::post('/panier/supprimer', [PanierControleur::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/ajouter', [PanierControleur::class, 'ajouter'])->name('panier.ajouter');
/*Route::get('/blog', function () {
    return view('welcome');
});*/
Route::get('/agence', [AgenceControleur::class, 'agence'])->name('agence.page');
/*Route::get('/contact', function () {
    return view('welcome');
});*/
Route::get('/contact', [ContactControleur::class, 'contact'])->name('contact.page');

Route::get('/connexion', [ConnexionControleur::class, 'connexion'])->name('connexion.page');
Route::post('/connexion/validerConnexion', [ConnexionControleur::class, 'validerConnexion'])->name('connexion.validerConnexion');
Route::post('/connexion/validerInscription', [ConnexionControleur::class, 'validerInscription'])->name('connexion.validerInscription');
Route::post('/connexion/verifierCompte', [ConnexionControleur::class, 'verifierCompte'])->name('connexion.verifier');

Route::get('/commande', [CommandeControleur::class, 'commande'])->name('commande.page');
Route::post('/commande/validerCommande', [CommandeControleur::class, 'validerCommande'])->name('commande.validerCommande');
Route::get('/commande/confirmer', [CommandeControleur::class, 'confirmer'])->name('commande.confirmerCommande');