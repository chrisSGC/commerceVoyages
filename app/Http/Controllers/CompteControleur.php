<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Paiement;

class CompteControleur extends Controller{ 
    public static function verifierConnexion(){
        return (session()->missing('utilisateur')) ? false : true;
    }

    public static function obtenirTypeCompte(){
        if(session()->has('administrateur')){
            return 1;
        }else{
            return 2;
        }
    }

    public function historique(){
        if(session()->missing('utilisateur')){
            return redirect('/connexion');
        }else{
            $contenuVentes = Vente::select("vente.id as idVente", "vente.*", "voyage.*")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->where('client_id', session()->get('utilisateur'))->orderByDesc('vente.id')->get();

            $contenuFinal = [];

            foreach($contenuVentes as $vente){
                // recuepre le montant percu
                $montant = Paiement::where('vente_id', $vente->idVente)->sum('montantPaiement');

                $contenuFinal[] = ["nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'etatPaiement' => (($montant == ($vente->quantite * $vente->prix)) ? true : false), 'etatVente' => $vente->etat];
            }

            return view('achats')->with('contenuVentes', json_decode(json_encode($contenuFinal), FALSE));
        }
    }
}
