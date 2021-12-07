<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Admin - ventes
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vente;
use App\Models\Paiement;
use App\Models\Voyage;
use App\Models\Client;

class VentesAdminControleur extends Controller{
    /**
     * Index du systeme des ventes
     *
     * @return void
     */
    public function accueil(){
        $contenuVentes = Vente::select("vente.id as idVente", "vente.*", "voyage.*", "client.*")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->join('client', 'vente.client_id', '=', 'client.id')->where("vente.etat", "=", 1)->orderByDesc('vente.id')->get();

        $listeVentesFinale = [];

        foreach($contenuVentes as $vente){
            // recuepre le montant percu
            $montant = Paiement::where('vente_id', $vente->idVente)->sum('montantPaiement');

            $listeVentesFinale[] = ["idVente" => $vente->idVente, "nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'nomClient' => $vente->prenom.' '.$vente->nom, 'etatVente' => (($montant >= ($vente->quantite * $vente->prix)) ? true : false)];
        }
        
        return view('admin.ventes')->with('listeVentesFinale', json_decode(json_encode($listeVentesFinale), FALSE))->with("listeVoyages", Voyage::where('actif', '=', 1)->get())->with("listeClients", Client::all());
    }
    
    /**
     * Méthdoe ajax qui permet d'afficher les paiements d'une vente
     *
     * @param [type] $idVente
     * @return void
     */
    public function detailsPaiements($idVente){ 
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $donnees = ['idVente' => $idVente];

            Validator::make($donnees, ['idVente' => 'required|integer|gt:0']);

            $paiements = Paiement::where('vente_id', $idVente)->get();
    
            return json_encode(["code" => 200, "donnees" => $paiements]);
        }
    }

    /**
     * Méthode ajax qui permet d'ajouter un paiement sur une vente
     *
     * @param Request $request
     * @return void
     */
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

    /**
     * Méthode ajax qui permet d'ajouter une vente pour un client donné
     *
     * @param Request $request
     * @return void
     */
    public function ajouterVente(Request $request){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $request->validate(['dateAchat'=> ['required', 'date'], 'nbrPassagers' => ['required', 'integer', 'gt:0'], 'client' => ['required', 'integer', 'gt:0'], 'voyage' => ['required', 'integer', 'gt:0']]);

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

    /**
     * Méthode ajax qui permet de supprimer un paiement
     *
     * @param [type] $idPaiement
     * @return void
     */
    public function supprimerPaiement($idPaiement){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $donnees = ['idPaiement' => $idPaiement];

            Validator::make($donnees, ['idPaiement' => 'required|integer|gt:0']);

            Paiement::destroy($idPaiement);
            
            return json_encode(["code" => 200]);
        }
    }

    /**
     * Méthode ajax qui permet d'annuler une vente et supprimer les paiements associés.
     * 
     * On ne supprime pas une vente annulmée pour permettre dnas un développement futur d'avoir des stats sur les ventes annulées
     *
     * @param [type] $idVente
     * @return void
     */
    public function annulerVente($idVente){
        if(session()->missing('administrateur')){ 
            return http_response_code(404);
        }else{
            $donnees = ['idVente' => $idVente];

            Validator::make($donnees, ['idVente' => 'required|integer|gt:0']);

            Vente::find($idVente)->update(["etat" => 2]); // On passe l'etat a annule car on va garder des statistiques de ventes annulees

            $paiements = Paiement::where("vente_id", "=", $idVente)->delete();
            
            return json_encode(["code" => 200]);
        }
    }
}
