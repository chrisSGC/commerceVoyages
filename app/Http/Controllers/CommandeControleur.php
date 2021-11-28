<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Client;
use App\Models\Province;
use App\Models\Vente;
use App\Models\Paiement;

class CommandeControleur extends Controller{
    private function listeProvinces(){
        $array = [];

        foreach(Province::all() as $province){
            $array[] = $province->id;
        }

        return $array;
    }

    public function commande(Request $request){
        if($request->session()->missing('utilisateur')){
            return redirect('/connexion');
        }else{
            $utilisateur = Client::where('id', $request->session()->get('utilisateur'))->first();

            $montant = 0;
            $annee = date("Y");
            $contenuPanier = Panier::select("panier.id as idPanier", "panier.*", "voyage.*")->join('voyage', 'panier.voyage_id', '=', 'voyage.id')->where('ip', \Request::ip())->get();

            $nombreArticles = $contenuPanier->sum("quantite");

            foreach($contenuPanier as $item) { $montant += $item->quantite * $item->prix; }

            return view('commande')->with('utilisateur', $utilisateur)->with('provinces', Province::all())->with('contenuPanier', $contenuPanier)->with('nombreArticles', $nombreArticles)->with('montant', $montant);
        }
    }

    public function validerCommande(Request $request){
        if($request->session()->missing('utilisateur')){
            return redirect('/connexion');
        }else{
            $utilisateur = Client::find($request->session()->get('utilisateur'))->first();
            $montant = $compteurPaye = 0;
            $request['provincePossibles'] = $this->listeProvinces();
            $annee = date("Y");
            $contenuPanier = Panier::select("panier.id as idPanier", "panier.*", "voyage.*")->join('voyage', 'panier.voyage_id', '=', 'voyage.id')->where('ip', \Request::ip())->get();
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

                // ajouter paiement
                $paiement = new Paiement();
                $paiement->datePaiement = $date;
                $paiement->montantPaiement = $item->quantite * $item->prix;
                $paiement->vente_id = $vente->id;
                $paiement->save();

                // vider le panier
                Panier::where('id', $item->idPanier)->delete();

                $compteurPaye++;
            }

            if($compteurPaye != 0){
                return redirect('/commande/confirmer');
            }else{
                return view('commande')->with('utilisateur', $utilisateur)->with('provinces', Province::all())->with('contenuPanier', $contenuPanier)->with('nombreArticles', $nombreArticles)->with('montant', $montant);
            }            
        }
    }

    public function confirmer(Request $request){
        if($request->session()->missing('utilisateur')){
            return redirect('/connexion');
        }else{
            return view('sommaireCommande');
        }
    }
}
