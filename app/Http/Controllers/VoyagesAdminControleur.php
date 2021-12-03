<?php
// middleware auth group
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Departement;
use App\Models\Categorie;

class VoyagesAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $listeVoyages = Voyage::select("voyage.id as idVoyage", "voyage.*", "departement.*", "categorie.*")->join('departement', 'voyage.departement_id', '=', 'departement.id')->join('categorie', 'voyage.categorie_id', '=', 'categorie.id')->where("actif", '=', 1)->orderByDesc('dateDebut')->get();
        
        return view('adminVoyages')->with('listeVoyages', $listeVoyages);
    }

    public function supprimerVoyage($idVoyage){
        if(session()->missing('administrateur')){ return redirect('/'); }

        Voyage::find($idVoyage)->update(["actif" => 0]);

        return redirect("/listeVoyages");
    }

    public function nouveauVoyage(){
        if(session()->missing('administrateur')){ return redirect('/'); }
        
        return view('adminNouveauVoyage')->with('listeDepartements', Departement::all())->with('listeCategories', Categorie::all());
    }

    public function ajouterVoyage(Request $request){
        if(session()->missing('administrateur')){ return redirect('/'); }
        $lesDepartements = Departement::all();
        $lesCategories = Categorie::all();
        $request['departementsPossibles'] = $this->obtenirListeDepartements($lesDepartements);
        $request['categoriesPossibles'] = $this->obtenirListeCategories($lesCategories);
        $departementsPossibles = $lesDepartements->count();
        $categoriesPossibles = $lesCategories->count();

        /**
         * ON EN EST LA
         */
        $request->validate(['nomVoyage'=> ['required', 'string', 'min:3', 'max:50'], 'villeVoyage'=> ['required', 'string', 'min:3', 'max:50'], 'prixVoyage' => ['required', 'numeric', 'gt:1'], 'dateVoyage' => ['required', 'date'], 'dureeVoyage' => ['required', 'integer', 'gt:1'], 'departementVoyage' => ['required', 'integer', 'gt:0', 'lt:'.$departementsPossibles], 'categorieVoyage' => ['required', 'integer', 'gt:0', 'lt:'.$categoriesPossibles]]);

        $voyage = new Voyage();
        $voyage->nomVoyage = $request->nomVoyage;
        $voyage->dateDebut = $request->dateVoyage;
        $voyage->duree = $request->dureeVoyage;
        $voyage->ville = $request->villeVoyage;
        $voyage->prix = $request->prixVoyage;
        $voyage->departement_id = $request->departementVoyage;
        $voyage->categorie_id = $request->categorieVoyage;
        $voyage->save();

        if($voyage->id){ return redirect('/listeVoyages'); }
        
        return view('adminNouveauVoyage')->with('listeDepartements', $lesDepartements)->with('listeCategories', $lesCategories);
    }

    private function obtenirListeDepartements($listeDepartements){
        $array = [];
        
        foreach ($listeDepartements as $departement) {
            $array[] = $departement->id;
        }

        return $array;
    }

    private function obtenirListeCategories($listeCategories){
        $array = [];
        
        foreach ($listeCategories as $categorie) {
            $array[] = $categorie->id;
        }

        return $array;
    }
}
