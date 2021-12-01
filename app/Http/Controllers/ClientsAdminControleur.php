<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $listeClients = Client::select("client.id as idClient", "client.*", "province.*", "premiercontact.*")->join('province', 'client.province_id', '=', 'province.id')->join('premiercontact', 'client.premierContact_id', '=', 'premiercontact.id')->get();
        
        return view('adminClients')->with('listeClients', $listeClients);
    }
}
