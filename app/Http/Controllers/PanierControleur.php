<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;

class PanierControleur extends Controller{
    static public $montant = 100;
    static public $nombreArticles = 12;

    public static function panier(){
        $contenuPanier = Panier::where('ip', \Request::ip())->get();

        return $contenuPanier;
    }
}
