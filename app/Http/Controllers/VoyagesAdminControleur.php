<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class VoyagesAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $listeVoyages = Voyage::select("voyage.id as idVoyage", "voyage.*", "departement.*", "categorie.*")->join('departement', 'voyage.departement_id', '=', 'departement.id')->join('categorie', 'voyage.categorie_id', '=', 'categorie.id')->orderByDesc('dateDebut')->get();
        
        return view('adminVoyages')->with('listeVoyages', $listeVoyages);
    }
}
