<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Premiercontact;
use App\Models\Province;

class ClientsAdminControleur extends Controller{
    public function accueil(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        $listeClients = Client::select("client.id as idClient", "client.*", "province.*", "premiercontact.*")->join('province', 'client.province_id', '=', 'province.id')->join('premiercontact', 'client.premierContact_id', '=', 'premiercontact.id')->orderBy('client.nom')->get();
        
        return view('admin.clients')->with('listeClients', $listeClients);
    }

    public function nouveauClient(){
        if(session()->missing('administrateur')){ return redirect('/'); }

        return view('admin.nouveauClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All());
    }

    public function ajouterClient(Request $request){
        if(session()->missing('administrateur')){ return redirect('/'); }
        $request['genresPossibles'] = ['M', 'F'];
        $premiersContactsPossibles = Premiercontact::All()->count();
        $provincesPossibles = Province::All()->count();

        $request->validate(['prenom'=> ['required', 'string', 'min:1', 'max:10'], 'nom'=> ['required', 'string', 'min:1', 'max:10'], 'adresse'=> ['required', 'string', 'min:3', 'max:28'], 'ville'=> ['required', 'string', 'min:3', 'max:19'], 'cp'=> ['required', 'string', 'min:6', 'max:7'], 'telephone' => ['required', 'regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'], 'courriel' => ['required', 'email', 'email:rfc,dns', 'unique:client'], 'genre' => ['required', 'in_array:genresPossibles.*'], 'premierContact' => ['required', 'integer', 'gt:0', 'lt:'.$premiersContactsPossibles], 'motDePasse'=> ['required', 'alpha_num', 'min:8'], 'province' => ['required', 'integer', 'gt:0', 'lt:'.$provincesPossibles]]);

        $client = new client();
        $client->prenom = $request->prenom;
        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->ville = $request->ville;
        $client->CP = $request->cp;
        $client->telephone = $request->telephone;
        $client->courriel = $request->courriel;
        $client->genre = $request->genre;
        $client->province_id = $request->province;
        $client->motDePasse = $this->crypterDonnee($request->motDePasse);
        $client->premierContact_id = $request->premierContact;
        $client->save();

        if($client->id){ return redirect('/clients'); }

        return view('admin.nouveauClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All());
    }

    public function modifierClient($idClient){
        if(session()->missing('administrateur')){ return redirect('/'); }
        session()->put('_old_input', ['prenom'=> $aaa, 'nom'=> $aaa, 'adresse'=> $aaa, 'ville'=> $aaa, 'cp'=> $aaa, 'telephone' => $aaa, 'courriel' => $aaa, 'genre' => $aaa, 'premierContact' => $aaa, 'motDePasse'=> $aaa, 'province' => $aaa]);


        /*The save() method performs an INSERT when you create a new model which is currently is not present in your database table:

            $flight = new Flight;
           
            $flight->name = $request->name;
           
            $flight->save(); // it will INSERT a new record
           Also it can act like an UPDATE, when your model already exists in the database. So you can get the model, modify some properties and then save() it, actually performing db's UDPATE:
           
           $flight = App\Flight::find(1);
           
           $flight->name = 'New Flight Name';
           
           $flight->save(); //this will UPDATE the record with id=1*/

        return view('admin.nouveauClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All());
    }

    public function editionClient($mode, $idClient = null){
        if(session()->missing('administrateur')){ return redirect('/'); }

        if($idClient != null){
            $client = Client::find($idClient);

            session()->put('_old_input', ['prenom'=> $client->prenom, 'nom'=> $client->nom, 'adresse'=> $client->adresse, 'ville'=> $client->ville, 'cp'=> $client->CP, 'telephone' => $client->telephone, 'courriel' => $client->courriel, 'genre' => $client->genre, 'premierContact' => $client->premierContact_id, 'motDePasse'=> $client->motDePasse, 'province' => $client->province_id]);
        }

        return view('admin.nouveauClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All());
    }

    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }
}
