<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class connexionControleur extends Controller{
    public function connexion(){
        return view('connexion');
    }
    
    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }

    private function verifierConcordance($aVerifier, $hash){
        return password_verify($aVerifier, $hash);
    }
}
