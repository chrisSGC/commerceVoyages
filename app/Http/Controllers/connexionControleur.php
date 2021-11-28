<?php

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

    public function connexion(Request $request){
        return view('connexion')->with('erreurConnexion', 0)->with('premierContact', Premiercontact::All());
    }

    public function deconnexion(Request $request){
        $request->session()->forget('utilisateur');
        return redirect('/');
    }

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

    public function validerConnexion(Request $request){
        $erreurConnexion = 0;
        $request->validate(['email'=> ['required', 'email', 'email:rfc,dns'], 'identifiant' => ['required', 'alpha_num']]);

        $infosCompte = Client::select("motDePasse", "id")->where('courriel', $request->email)->first();

        if($infosCompte){
            if($this->verifierConcordance($request->identifiant, $infosCompte->motDePasse)){
                // rediriger vers la page des infos de paiement
                session(['utilisateur' => $infosCompte->id]);
                return redirect('/commande');
            }else{
                // rester sur la page avec une erreur
                $erreurConnexion = 1;
            }
        }else{
            // rester sur la page avec une erreur
            $erreurConnexion = 1;
        }

        return view('connexion')->with('erreurConnexion', $erreurConnexion)->with('premierContact', Premiercontact::All());
    }

    public function verifierCompte(Request $request){
        $request->motDePasse;

        $infosCompte = Client::select("motDePasse", "id")->where('courriel', $request->courriel)->first();

        if($infosCompte){
            if(verifierConcordance($request->motDePasse, $infosCompte->motDePasse)){
                return ["code" => 500, "donnees" => ["id" => $infosCompte->id]];
            }else{
                return ["code" => 500, "donnees" => "Impossible de répondre à la demande"];
            }
        }else{
            return ["code" => 500, "donnees" => "Impossible de répondre à la demande"];
        }
    }
    
    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }

    private function verifierConcordance($aVerifier, $hash){
        return password_verify($aVerifier, $hash);
    }
}
