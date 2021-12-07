<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Voyages
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Region;

class VoyageControleur extends Controller{
    // Offset qui détermine ou nous en sommes dans la liste d'affichage
    static $offset = 9;

    /**
     * Index du systeme, permet d'afficher 9 voyages
     *
     * @return void
     */
    public function voyages(){ 
        $neufVoyages = Voyage::where('actif', '=', 1)->skip(0)->take(9)->get();

        return view('voyages')->with('neufVoyages', $neufVoyages);
    }
    
    /**
     * Méthode ajax qui permet d'afficher 6 voyages de plus à partir de l'ofset
     *
     * @return void
     */
    public function obtenirPlusVoyages(){ 
        $neufVoyagesDePlus = Voyage::where('actif', '=', 1)->skip(self::$offset)->take(9)->get();

        self::$offset = self::$offset + 9;

        return json_encode(["code" => 200, "donnees" => $neufVoyagesDePlus]);
    }

    /**
     * Permet d'afficher des voyages en fonction d'une région précise
     *
     * @param [type] $idRegion
     * @return void
     */
    public function voyagesRegion($idRegion){ 
        $region = Region::find($idRegion);
        $voyagesRegion = $region->voyagesAssocies;
        
        return view('voyagesRegion')->with('region', $region)->with('voyagesRegion', $voyagesRegion);
    }

    /**
     * Permet d'afficher les détails d'un voyage précis
     *
     * @param [type] $idVoyage
     * @return void
     */
    public function voyageFiche($idVoyage){
        $voyage = Voyage::select("voyage.id as idVoyage", "voyage.*", "categorie.categorie", "departement.nomDepartement", "departement.codeDepartement")->join('categorie', 'categorie.id', '=', 'voyage.categorie_id')->join('departement', 'departement.id', '=', 'voyage.departement_id')->where('voyage.id', $idVoyage)->where('actif', '=', 1)->first();

        return view('voyageFiche')->with('voyage', $voyage);
    }
}
