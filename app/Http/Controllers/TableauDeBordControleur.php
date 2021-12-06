<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Paiement;

class TableauDeBordControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $contenuVentes = Vente::select("vente.id as idVente", "vente.*", "voyage.*", "client.*")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->join('client', 'vente.client_id', '=', 'client.id')->orderByDesc('vente.id')->take(20)->get();

        $listeVentesFinale = [];

        foreach($contenuVentes as $vente){
            // recuepre le montant percu
            $montant = Paiement::where('vente_id', $vente->idVente)->sum('montantPaiement');

            $listeVentesFinale[] = ["idVente" => $vente->idVente, "nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'nomClient' => $vente->prenom.' '.$vente->nom, 'etatVente' => (($montant == ($vente->quantite * $vente->prix)) ? true : false)];
        }
        
        return view('admin.dashboard')->with('listeVentesFinale', json_decode(json_encode($listeVentesFinale), FALSE));
    }
}
