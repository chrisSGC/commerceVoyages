<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Panier
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;

class PanierControleur extends Controller{
    /**
     * Attributs statiques permettant le calcul de certaines données et leur affichage dans le template
     *
     * @var integer
     */
    static public $montant = 0;
    static public $nombreArticles = 0;
    static public $contenuPanier = null;

    /**
     * Méthode statique qui permet d'initialiser les variables du panier
     *
     * @return void
     */
    public static function initialiserPanier(){
        self::$contenuPanier = Panier::select("panier.id as idPanier", "panier.*", "voyage.*")->join('voyage', 'panier.voyage_id', '=', 'voyage.id')->where('ip', \Request::ip())->get();

        self::$nombreArticles = self::$contenuPanier->sum("quantite");

        foreach(self::$contenuPanier as $item) {
            self::$montant += $item->quantite * $item->prix;
        }
    }

    /**
     * Permet d'afficher le panier
     *
     * @return void
     */
    public function panier(){
        self::initialiserPanier();

        return view('panier')->with('contenuPanier', self::$contenuPanier)->with('nombreArticles', self::$nombreArticles)->with('montant', self::$montant);
    }

    /**
     * Méthode appellée en ajax qui permet de retirer 1 unité à un item du panier
     *
     * @param Request $request
     * @return void
     */
    public function moins(Request $request){
        $request->validate(['idPanier'=> ['required', 'numeric', 'gt :-1']]);
        $ip = $request->ip();

        // recupere la quantite pour idPanier et ip
        $item = Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->first();

        // Si resultat
        if($item){
            $nouvelleQuantite = $item->quantite - 1;

            Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->update(["quantite" => $nouvelleQuantite]);

            // On initialise le panier a nouveua pour envoyer le montant global du panier actualise
            self::initialiserPanier();

            return json_encode(["code" => 200, "donnees" => ["quantite" => $nouvelleQuantite, "montant" => self::$montant]]);
        }else{
            return json_encode(["code" => 500]);
        }
    }

    /**
     * Méthode ajax qui permet d'ajouter 1 à un item du panier
     *
     * @param Request $request
     * @return void
     */
    public function plus(Request $request){
        $request->validate(['idPanier'=> ['required', 'numeric', 'gt :-1']]);
        $ip = $request->ip();

        // recupere la quantite pour idPanier et ip
        $item = Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->first();

        // Si resultat
        if($item){
            $nouvelleQuantite = $item->quantite + 1;

            Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->update(["quantite" => $nouvelleQuantite]);

            // On initialise le panier a nouveua pour envoyer le montant global du panier actualise
            self::initialiserPanier();

            return json_encode(["code" => 200, "donnees" => ["quantite" => $nouvelleQuantite, "montant" => self::$montant]]);
        }else{
            return json_encode(["code" => 500]);
        }
    }

    /**
     * Méthode ajax qui permet de supprimer un item du panier
     *
     * @param Request $request
     * @return void
     */
    public function supprimer(Request $request){
        $request->validate(['idPanier'=> ['required', 'numeric', 'gt :-1']]);
        $ip = $request->ip();

        // recupere la quantite pour idPanier et ip
        $item = Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->first();

        // Si resultat
        if($item){
            Panier::where("id", "=", $request->idPanier)->where("ip", "=", $ip)->delete();

            // une fois supprime, on initialise a nouveau le panier puis on retourne le montant total du panier pour actualiser les montants
            self::initialiserPanier();
            return json_encode(["code" => 200, "donnees" => ["montant" => self::$montant]]);
        }else{
            return json_encode(["code" => 500]);
        }
    }

    /**
     * Méthdoe ajax qui permet d'ajouter un item au panier
     *
     * @param Request $request
     * @return void
     */
    public function ajouter(Request $request){
        $request->validate(['idVoyage'=> ['required', 'numeric', 'gt :0']]);
        $ip = $request->ip();

        // On vérifie si l'item existe déjà
        $presenceItem = Panier::where("voyage_id", "=", $request->idVoyage)->where("ip", "=", $ip)->first();

        if($presenceItem){
            // on ajoute 1 à la quantité
            $nouvelleQuantite = $presenceItem->quantite + 1;

            Panier::where("voyage_id", "=", $request->idVoyage)->where("ip", "=", $ip)->update(["quantite" => $nouvelleQuantite]);
        }else{
            // On crée l'occurence
            $item = new Panier();
            $item->voyage_id = $request->idVoyage;
            $item->ip = $ip;
            $item->quantite = 1;
            $item->save();
        }

        // recupere la quantite pour idPanier et ip
        $itemAjoute = Panier::where("voyage_id", "=", $request->idVoyage)->where("ip", "=", $ip)->get();

        // Si resultat
        if($itemAjoute){
            return json_encode(["code" => 200]);
        }else{
            return json_encode(["code" => 500]);
        }
    }
}
