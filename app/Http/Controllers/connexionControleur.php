<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class connexionControleur extends Controller{
    public function connexion(){
        return view('connexion');
    }

    public function verifierCompte(Request $request){
        //$validations = $request->validate(['courriel'=> ['required', 'email', 'email:rfc,dns'], 'motDePasse' => ['required', 'alpha_num']]);

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

        /*if($validations->errors()){
            $tableauErreurs = [];
            foreach($validations->errors() as $erreur){ $tableauErreurs[] = $erreur; }
            return ["code" => 500, "donnees" => $tableauErreurs];
        }else{
            // récupere le compte

            // vérifie concordance mdp

            // retourne message
            return['code' => 200, 'donnees' => "succes"];
        }*/
    }
    
    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }

    private function verifierConcordance($aVerifier, $hash){
        return password_verify($aVerifier, $hash);
    }
}
