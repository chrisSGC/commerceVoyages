<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Categorie;

class AccueilControleur extends Controller{
    public function accueil(){
        $sixVoyages = Voyage::skip(0)->take(6)->get();
        $categories = Categorie::all();
        //
        return view('accueil')->with('sixVoyages', $sixVoyages)->with('categories', $categories);
    }
}
