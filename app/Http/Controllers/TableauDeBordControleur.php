<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Admin - Tableau de bord
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Paiement;

class TableauDeBordControleur extends Controller{
    /**
     * Accueil de l'administration, affiche uniquement la liste des dernieres ventes
     *
     * @return void
     */
    public function accueil(){
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
