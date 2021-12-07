<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Accueil
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Categorie;

class AccueilControleur extends Controller{
    /**
     * Accueil du site, tres peu de traitement ici, on affiche juste les 6 derniers voyages actifs
     *
     * @return void
     */
    public function accueil(){
        //if(session()->has('administrateur')){ return redirect('/dashboard'); }

        $sixVoyages = Voyage::where('actif', '=', 1)->orderByDesc('id')->take(6)->get();
        $categories = Categorie::all();

        return view('accueil')->with('sixVoyages', $sixVoyages)->with('categories', $categories);
    }
}
