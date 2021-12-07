<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Gestion de compte / compte client
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Paiement;

class CompteControleur extends Controller{ 
    /**
     * Permet de vérifier si un utilisateur lambda est connecté
     *
     * @return void
     */
    public static function verifierConnexion(){
        return (session()->missing('utilisateur')) ? false : true;
    }

    /**
     * Permet de vérifier si le compte est de type administrateur, utilsiateur ou non
     *
     * @return void
     */
    public static function obtenirTypeCompte(){
        if(session()->has('administrateur')){
            return 1;
        }elseif(session()->has('utilisateur')){
            return 2;
        }else{
            return false;
        }
    }

    /**
     * Permet d'afficher l'historique des commandes du client
     *
     * @return void
     */
    public function historique(){
        $contenuVentes = Vente::select("vente.id as idVente", "vente.*", "voyage.*")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->where('client_id', session()->get('utilisateur'))->orderByDesc('vente.id')->get();

        $contenuFinal = [];

        foreach($contenuVentes as $vente){
            // recuepre le montant percu
            $montant = Paiement::where('vente_id', $vente->idVente)->sum('montantPaiement');

            $contenuFinal[] = ["nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'etatPaiement' => (($montant >= ($vente->quantite * $vente->prix)) ? true : false), 'etatVente' => $vente->etat];
        }

        return view('membre.achats')->with('contenuVentes', json_decode(json_encode($contenuFinal), FALSE));
    }

    /**
     * Permet d'afficher le formulaire d'ajout de paiement
     *
     * @return void
     */
    public function paiement(){
        return view('membre.paiement')->with('listeVentes', Vente::select("vente.id as idVente", "voyage.nomVoyage")->join('voyage', 'vente.voyage_id', '=', 'voyage.id')->where('client_id', session()->get('utilisateur'))->orderByDesc('vente.id')->get());
    }

    /** 
     * Permet de faire le traitement de validation du paiement
     * 
     * @return void
     */
    public function validerPaiement(Request $request){
        $annee = date("Y");

        $request->validate(['vente' => ['required', 'integer', 'gt:0'], 'montant' => ['required', 'numeric', 'gt:0'], 'nomCarte' => ['required', 'string'], 'numeroCarte' => ['required', 'string'], 'moisCarte' => ['required', 'integer', 'min:1', 'max:12'], 'anneeCarte' => ['required', 'integer', 'min:'.$annee, 'max:'.($annee + 6)], 'cvv' => ['required', 'integer', 'min:000', 'max:999']]);
        
        $date = new \DateTime();
        $date = $date->format('Y-m-d');

        $paiement = new Paiement();
        $paiement->datePaiement = $date;
        $paiement->montantPaiement = $request->montant;
        $paiement->vente_id = $request->vente;
        $paiement->save();

        return redirect('/historique');
    }
}
