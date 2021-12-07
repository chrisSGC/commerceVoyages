<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Region
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionControleur extends Controller{
    /**
     * Permet de retourner la liste des régions
     *
     * @return void
     */
    public static function regions(){ 
        $listeRegions = Region::where("afficher", 1)->get();

        return $listeRegions;
    }
}
