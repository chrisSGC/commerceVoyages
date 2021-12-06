<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Paiement;
use App\Models\Voyage;
use App\Models\Client;

class VentesAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $contenuVentes = Vente::select("vente.id as idVente", "vente.*", "voyage.*", "client.*")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->join('client', 'vente.client_id', '=', 'client.id')->where("vente.etat", "=", 1)->orderByDesc('vente.id')->get();

        $listeVentesFinale = [];

        foreach($contenuVentes as $vente){
            // recuepre le montant percu
            $montant = Paiement::where('vente_id', $vente->idVente)->sum('montantPaiement');

            $listeVentesFinale[] = ["idVente" => $vente->idVente, "nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'nomClient' => $vente->prenom.' '.$vente->nom, 'etatVente' => (($montant >= ($vente->quantite * $vente->prix)) ? true : false)];
        }
        
        return view('admin.ventes')->with('listeVentesFinale', json_decode(json_encode($listeVentesFinale), FALSE))->with("listeVoyages", Voyage::all())->with("listeClients", Client::all());
    }
    
    public function detailsPaiements($idVente){ 
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $paiements = Paiement::where('vente_id', $idVente)->get();
    
            return json_encode(["code" => 200, "donnees" => $paiements]);
        }
    }

    public function ajouterPaiement(Request $request){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $paiement = new Paiement();
            $paiement->datePaiement = $request->datePaiementSupp;
            $paiement->montantPaiement = $request->montantPaiementSupp;
            $paiement->vente_id = $request->idVenteAssociee;
            $paiement->save();
    
            return json_encode(["code" => 200]);
        }
    }

    public function ajouterVente(Request $request){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            // recupere le prix du voyage
            $voyage = Voyage::find($request->voyage)->first();
    
            // calcule le prix total
            $prixVoyage = $request->nbrPassagers * $voyage->id;
    
            $vente = new Vente();
            $vente->dateVente = $request->dateAchat;
            $vente->quantite = $request->nbrPassagers;
            $vente->prix_paye = $prixVoyage;
            $vente->client_id = $request->client;
            $vente->voyage_id = $request->voyage;
    
            $vente->save();
    
            return json_encode(["code" => 200]);
        }
    }

    public function supprimerPaiement($idPaiement){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            Paiement::destroy($idPaiement);
            
            return json_encode(["code" => 200]);
        }
    }

    public function annulerVente($idVente){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            Vente::find($idVente)->update(["etat" => 2]); // On passe l'etat a annule car on va garder des statistiques de ventes annulees

            $paiements = Paiement::where("vente_id", "=", $idVente)->delete();
            
            return json_encode(["code" => 200]);
        }
    }
}
