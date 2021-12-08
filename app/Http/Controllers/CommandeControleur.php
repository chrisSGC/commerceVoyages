<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Commande
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Client;
use App\Models\Province;
use App\Models\Vente;
use App\Models\Paiement;

class CommandeControleur extends Controller{
    /**
     * Affiche le résumé de la commande du client
     *
     * @param Request $request
     * @return void
     */
    public function commande(Request $request){
        $utilisateur = Client::where('id', $request->session()->get('utilisateur'))->first();

        $montant = 0;
        $annee = date("Y");
        $contenuPanier = Panier::select("panier.id as idPanier", "panier.*", "voyage.*")->join('voyage', 'panier.voyage_id', '=', 'voyage.id')->where('ip', \Request::ip())->orWhere("client_id", "=", session()->get('utilisateur'))->get();

        $nombreArticles = $contenuPanier->sum("quantite");

        foreach($contenuPanier as $item) { $montant += $item->quantite * $item->prix; }

        return view('membre.commande')->with('utilisateur', $utilisateur)->with('provinces', Province::all())->with('contenuPanier', $contenuPanier)->with('nombreArticles', $nombreArticles)->with('montant', $montant);
    }

    /**
     * Valide les informations entrées par le client lors de sa commande
     * 
     * Si tout est bon, on vide le panier et on ajoute le paiement
     *
     * @param Request $request
     * @return void
     */
    public function validerCommande(Request $request){
        $utilisateur = Client::find($request->session()->get('utilisateur'))->first();
        $montant = $compteurPaye = 0;
        //$request['provincePossibles'] = $this->listeProvinces();
        $annee = date("Y");
        $contenuPanier = Panier::select("panier.id as idPanier", "panier.*", "voyage.*")->join('voyage', 'panier.voyage_id', '=', 'voyage.id')->where('client_id', $request->session()->get('utilisateur'))->get();
        $compteurPanier = $contenuPanier->count();

        $nombreArticles = $contenuPanier->sum("quantite");

        foreach($contenuPanier as $item){ $montant += $item->quantite * $item->prix; }

        $request->validate(['adresse'=> ['required', 'string'], 'ville' => ['required', 'string', 'min:3', 'max:30'], 'codePostal' => ['required', 'string', 'min:6', 'max:7'], 'province' => ['required', 'integer', 'min:1', 'max:12'], 'telephone' => ['required', 'regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'], 'nomCarte' => ['required', 'string'], 'numeroCarte' => ['required', 'string'], 'moisCarte' => ['required', 'integer', 'min:1', 'max:12'], 'anneeCarte' => ['required', 'integer', 'min:'.$annee, 'max:'.($annee + 6)], 'cvv' => ['required', 'integer', 'min:000', 'max:999']]);

        // modifier les infos client
        Client::where("id", "=", $request->session()->get('utilisateur'))->update(["adresse" => $request->adresse, "ville" => $request->ville, "cp" => $request->codePostal, "province_id" => $request->province, "telephone" => $request->telephone]);

        $date = new \DateTime();
        $date = $date->format('Y-m-d');

        foreach($contenuPanier as $item) {
            // ajouter la vente
            $vente = new Vente();
            $vente->dateVente = $date;
            $vente->quantite = $item->quantite;
            $vente->client_id = $request->session()->get('utilisateur');
            $vente->voyage_id = $item->voyage_id;
            $vente->prix_paye = $item->prix;
            $vente->save();

            // A REVOIR panier
            // ajouter paiement
            $paiement = new Paiement();
            $paiement->datePaiement = $date;
            $paiement->montantPaiement = $item->quantite * $item->prix;
            $paiement->vente_id = $vente->id;
            $paiement->save();

            // vider le panier
            Panier::where('id', $item->idPanier)->delete();
        }

        return redirect('/commande/confirmer');

    }

    /**
     * Affiche la page de confirmation de commande.
     * 
     * Aucun traitement à faire ici
     *
     * @return void
     */
    public function confirmer(){
        return view('membre.sommaireCommande');
    }
}
