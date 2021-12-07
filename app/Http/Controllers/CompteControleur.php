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

            $contenuFinal[] = ["nomVoyage" => $vente->nomVoyage, "dateVente" => $vente->dateVente, "quantite" => $vente->quantite, 'prix' => $vente->prix, 'montantPercu' => $montant, 'etatPaiement' => (($montant == ($vente->quantite * $vente->prix)) ? true : false), 'etatVente' => $vente->etat];
        }

        return view('membre.achats')->with('contenuVentes', json_decode(json_encode($contenuFinal), FALSE));
    }
}
