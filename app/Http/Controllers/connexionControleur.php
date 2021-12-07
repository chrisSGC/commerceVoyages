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
use App\Models\Client;
use App\Models\Premiercontact;

class ConnexionControleur extends Controller{
    private function obtenirListePremierContact($premierContact){
        $array = [];
        
        foreach($premierContact as $contact){
            $array[] = $contact->id;
        }

        return $array;
    }

    /**
     * Page de connexion / inscription
     * 
     * On retourne la vue avec la liste des premiers contacts possibles
     *
     * @return void
     */
    public function connexion(){
        return view('connexion')->with('erreurConnexion', 0)->with('premierContact', Premiercontact::All());
    }

    /**
     * Déconnexion
     * 
     * On supprime les sessions et on redirige vers l'accueil
     *
     * @param Request $request
     * @return void
     */
    public function deconnexion(Request $request){
        $request->session()->forget('utilisateur');
        $request->session()->forget('administrateur');
        return redirect('/');
    }

    /**
     * Validation de l'inscription
     * 
     * Si l'inscription passe les validations, on crée un nouveau client puis une session et on reidirge vers la fin de 
     *
     * @param Request $request
     * @return void
     */
    public function validerInscription(Request $request){
        $erreurConnexion = 0;
        $premierContact = Premiercontact::All();

        $request['genresPossibles'] = ['M', 'F'];
        $request['premierContactPossibles'] = $this->obtenirListePremierContact($premierContact);

        $request->validate(['courriel'=> ['required', 'email', 'email:rfc,dns', 'unique:client'], 'prenom' => ['required', 'string', 'min:3', 'max:20'], 'nom' => ['required', 'string', 'min:3', 'max:20'], 'motDePasse' => ['required', 'alpha_num', 'min:8', 'max: 20'], 'genre' => ['required', 'in_array:genresPossibles'], 'premierContact' => ['required', 'in_array:premierContactPossibles']]);

        // On crée le client
        $client = new Client();
        $client->prenom = $request->prenom;
        $client->nom = $request->nom;
        $client->courriel = $request->courriel;
        $client->motDePasse = $request->motDePasse;
        $client->genre = $request->genre;
        $client->premierContact_id = $request->premierContact;
        $client->save();

        $infosCompte = Client::select("id")->where('courriel', $request->courriel)->first();
        
        session(['utilisateur' => $infosCompte->id]);

        if(session('utilisateur')){ return redirect('/commande'); }

        return view('connexion')->with('erreurConnexion', $erreurConnexion)->with('premierContact', $premierContact);

    }

    /**
     * Validation de la connexion
     * 
     * Si l'adresse est admin@admin.ca et que le mdp est amdin, on connecte en tant qu'admin
     * 
     * Sinon on vérifie la concordance dans la bd
     *
     * @param Request $request
     * @return void
     */
    public function validerConnexion(Request $request){
        $erreurConnexion = 0;

        if($request->email == "admin@admin.ca"){
            if($request->identifiant == "admin"){
                session(['administrateur' => "JeSuisUnSuperAdmin"]);
                return redirect('/dashboard');
            }else{
                $erreurConnexion = 1;
            }
        }else{
            $request->validate(['email'=> ['required', 'email', 'email:rfc,dns'], 'identifiant' => ['required', 'alpha_num']]);

            $infosCompte = Client::select("motDePasse", "id")->where('courriel', $request->email)->first();

            if ($infosCompte) {
                if ($this->verifierConcordance($request->identifiant, $infosCompte->motDePasse)) {
                    // rediriger vers la page des infos de paiement
                    session(['utilisateur' => $infosCompte->id]);
                    return redirect('/commande');
                } else {
                    // rester sur la page avec une erreur
                    $erreurConnexion = 1;
                }
            } else {
                // rester sur la page avec une erreur
                $erreurConnexion = 1;
            }
        }
        
        return view('connexion')->with('erreurConnexion', $erreurConnexion)->with('premierContact', Premiercontact::All());
    }

    /**
     * Ajax vérification de compte des
     * N'est plus utilisée
     *
     * @param Request $request
     * @return void
     */
    public function verifierCompte(Request $request){
        $request->validate(['email'=> ['required', 'email', 'email:rfc,dns'], 'identifiant' => ['required', 'alpha_num']]);
        
        $infosCompte = Client::select("motDePasse", "id")->where('courriel', $request->courriel)->first();

        if($infosCompte){
            if(verifierConcordance($request->motDePasse, $infosCompte->motDePasse)){
                return ["code" => 200, "donnees" => ["id" => $infosCompte->id]];
            }else{
                return ["code" => 500, "donnees" => "Impossible de répondre à la demande"];
            }
        }else{
            return ["code" => 500, "donnees" => "Impossible de répondre à la demande"];
        }
    }
    
    /**
     * PErmet d'encrypter une donnée à la BCrypt
     *
     * @param [type] $aEncoder
     * @return void
     */
    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }

    /**
     * Permet de valider qu'une donnée correpsond à une donnée encryptée
     *
     * @param [type] $aVerifier
     * @param [type] $hash
     * @return void
     */
    private function verifierConcordance($aVerifier, $hash){
        return password_verify($aVerifier, $hash);
    }
}
