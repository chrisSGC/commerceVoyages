<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $listeClients = Client::all();
        
        return view('adminClients')->with('listeClients', $listeClients);
    }
}
