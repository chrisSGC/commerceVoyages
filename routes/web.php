<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilControleur;

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
Route::get('/', [AccueilControleur::class, 'accueil'])->name('accueil');

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/voyages', function () {
    return view('welcome');
});
Route::get('/blog', function () {
    return view('welcome');
});
Route::get('/agence', function () {
    return view('welcome');
});
Route::get('/contact', function () {
    return view('welcome');
});

Route::get('/voyages/tous', function() { return view('welcome'); });
Route::get('/voyages/ile-de-france', function() { return view('welcome'); });
Route::get('/voyages/grand-est', function() { return view('welcome'); });
Route::get('/voyages/bourgogne-franche-comte', function() { return view('welcome'); });
Route::get('/voyages/auvergne-rhone-alpes', function() { return view('welcome'); });
Route::get('/voyages/provence-alpes-cote-d-azur', function() { return view('welcome'); });
Route::get('/voyages/corse', function() { return view('welcome'); });
Route::get('/voyages/occitanie', function() { return view('welcome'); });
Route::get('/voyages/nouvelle-aquitaine', function() { return view('welcome'); });
Route::get('/voyages/pays-de-la-loire', function() { return view('welcome'); });
Route::get('/voyages/centre-val-de-loire', function() { return view('welcome'); });
Route::get('/voyages/bretagne', function() { return view('welcome'); });
Route::get('/voyages/normandie', function() { return view('welcome'); });
Route::get('/voyages/hauts-de-france', function() { return view('welcome'); });
Route::get('/voyages/dom-tom', function() { return view('welcome'); });
