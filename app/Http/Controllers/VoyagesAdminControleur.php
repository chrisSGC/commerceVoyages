<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Admin - Gestion des voyages
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Departement;
use App\Models\Categorie;

class VoyagesAdminControleur extends Controller{
    /**
     * Permet d'afficher les voyages qctifs
     *
     * @return void
     */
    public function accueil(){
        $listeVoyages = Voyage::select("voyage.id as idVoyage", "voyage.*", "departement.*", "categorie.*")->join('departement', 'voyage.departement_id', '=', 'departement.id')->join('categorie', 'voyage.categorie_id', '=', 'categorie.id')->where("actif", '=', 1)->orderByDesc('dateDebut')->get();
        
        return view('admin.voyages')->with('listeVoyages', $listeVoyages);
    }

    /**
     * Permet l'edition ou la création d'un voyage
     *
     * @param [type] $mode
     * @param [type] $idVoyage
     * @return void
     */
    public function editionVoyage($mode, $idVoyage = null){
        if($idVoyage != null){
            $voyage = Voyage::find($idVoyage);

            session()->put('_old_input', ['nomVoyage'=> $voyage->nomVoyage, 'prixVoyage'=> $voyage->prix, 'dateVoyage'=> $voyage->dateDebut, 'dureeVoyage'=> $voyage->duree, 'departementVoyage'=> $voyage->departement_id, 'villeVoyage' => $voyage->ville, 'categorieVoyage' => $voyage->categorie_id]);
        }else{
            session()->put('_old_input', []);
        }

        return view('admin.editionVoyage')->with('listeDepartements', Departement::all())->with('listeCategories', Categorie::all())->with('mode', $mode)->with('idVoyage', $idVoyage);
    }

    /**
     * Permet l'enregistrement ou l'update d'un voyage
     *
     * @param Request $request
     * @return void
     */
    public function enregistrerVoyage(Request $request){
        $lesDepartements = Departement::all();
        $lesCategories = Categorie::all();
        $departementsPossibles = $lesDepartements->count();
        $categoriesPossibles = $lesCategories->count();

        $request->validate(['nomVoyage'=> ['required', 'string', 'min:3', 'max:250'], 'villeVoyage'=> ['required', 'string', 'min:3', 'max:100'], 'prixVoyage' => ['required', 'numeric', 'gt:1'], 'dateVoyage' => ['required', 'date'], 'dureeVoyage' => ['required', 'integer', 'gt:1'], 'departementVoyage' => ['required', 'integer', 'gt:0', 'lt:'.$departementsPossibles], 'categorieVoyage' => ['required', 'integer', 'gt:0', 'lt:'.$categoriesPossibles]]);

        $voyage = ($request->mode == 'modification') ? Voyage::find($request->idVoyage) : new Voyage();
        $voyage->nomVoyage = $request->nomVoyage;
        $voyage->dateDebut = $request->dateVoyage;
        $voyage->duree = $request->dureeVoyage;
        $voyage->ville = $request->villeVoyage;
        $voyage->prix = $request->prixVoyage;
        $voyage->departement_id = $request->departementVoyage;
        $voyage->categorie_id = $request->categorieVoyage;
        $voyage->save();

        if($voyage->id){ return redirect('/gestion/voyages'); }

        return view('admin.editionVoyage')->with('listeDepartements', $lesDepartements)->with('listeCategories', $lesCategories)->with('mode', $request->mode)->with('idVoyage', $request->idVoyage);
    }
}
