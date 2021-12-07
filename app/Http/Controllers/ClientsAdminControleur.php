<?php
/***
 * @author Christophe Ferru <christophe.ferru@gmail.com>
 * @copyright 2021 Christophe Ferru
 * @project YvanDesVoyages
 * @system Administration - Clients
 * 
 * TP Fin de session Programmation web Avancée - Aut 2021 - Cégep de Rivière-du-Loup
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Premiercontact;
use App\Models\Province;

class ClientsAdminControleur extends Controller{
    /**
     * Accueil du systeme de gestion des clients.
     * 
     * On retoruve la liste des clients avec les informations nécessaires à leur gestion comme leur infos, provencnace, premier contact.
     *
     * @return void
     */
    public function accueil(){
        $listeClients = Client::select("client.id as idClient", "client.*", "province.*", "premiercontact.*")->join('province', 'client.province_id', '=', 'province.id')->join('premiercontact', 'client.premierContact_id', '=', 'premiercontact.id')->orderBy('client.nom')->get();
        
        return view('admin.clients')->with('listeClients', $listeClients);
    }

    /**
     * Permet l'édition d'un client (Aussi bien l'ajout que la modification)
     * 
     * Si le mode est à modification, on recoite un id client, on va donc chercher les informations de ce dernier et les placer dans le old() afin de les afficher dans le formulaire
     * Si en revanche on est à ajout, aucune donnée n'est à aller chercher.
     *
     * @param [string] $mode Ajout ou modification
     * @param [int/null] $idClient
     * @return void
     */
    public function editionClient($mode, $idClient = null){
        if($idClient != null){
            $client = Client::find($idClient);

            session()->put('_old_input', ['prenom'=> $client->prenom, 'nom'=> $client->nom, 'adresse'=> $client->adresse, 'ville'=> $client->ville, 'cp'=> $client->CP, 'telephone' => $client->telephone, 'courriel' => $client->courriel, 'genre' => $client->genre, 'premierContact' => $client->premierContact_id, 'motDePasse'=> $client->motDePasse, 'province' => $client->province_id]);
        }else{
            session()->put('_old_input', []);
        }

        return view('admin.editionClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All())->with('mode', $mode)->with('idClient', $idClient);
    }

    /**
     * Permet d'enregistrer la modification ou inseriton d'un client
     * 
     * Documentation du fonctionnement:
     * 
     * The save() method performs an INSERT when you create a new model which is currently is not present in your database table:
     *
     *$flight = new Flight;
     *       
     *$flight->name = $request->name;
     *       
     *$flight->save(); // it will INSERT a new record
     *Also it can act like an UPDATE, when your model already exists in the database. So you can get the model, modify some properties and then save() it, actually performing  *db's UDPATE:
     *       
     *$flight = App\Flight::find(1);
     *       
     *$flight->name = 'New Flight Name';
     *       
     *$flight->save(); //this will UPDATE the record with id=1
     *
     * @param Request $request
     * @return void
     */
    public function enregistrerClient(Request $request){
        $request['genresPossibles'] = ['M', 'F'];
        $premiersContactsPossibles = Premiercontact::All()->count();
        $provincesPossibles = Province::All()->count();

        $request->validate(['prenom'=> ['required', 'string', 'min:1', 'max:10'], 'nom'=> ['required', 'string', 'min:1', 'max:10'], 'adresse'=> ['required', 'string', 'min:3', 'max:28'], 'ville'=> ['required', 'string', 'min:3', 'max:19'], 'cp'=> ['required', 'string', 'min:6', 'max:7'], 'telephone' => ['required', 'regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'], 'courriel' => ['required', 'email', 'email:rfc,dns'], 'genre' => ['required', 'in_array:genresPossibles.*'], 'premierContact' => ['required', 'integer', 'gt:0', 'lt:'.$premiersContactsPossibles], 'motDePasse'=> ['required',($request->mode == 'ajout') ? 'alpha_num' : 'string', 'min:8'], 'province' => ['required', 'integer', 'gt:0', 'lt:'.$provincesPossibles]]);

        $client = ($request->mode == 'modification') ? Client::find($request->idClient) : new client();
        $client->prenom = $request->prenom;
        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->ville = $request->ville;
        $client->CP = $request->cp;
        $client->telephone = $request->telephone;
        $client->courriel = $request->courriel;
        $client->genre = $request->genre;
        $client->province_id = $request->province;
        $client->motDePasse = ($request->mode == 'modification') ? $request->motDePasse : $this->crypterDonnee($request->motDePasse);
        $client->premierContact_id = $request->premierContact;
        $client->save();

        if($client->id){ return redirect('/gestion/clients'); }

        return view('admin.editionClient')->with('listeProvinces', Province::all())->with('listePremiersContacts', Premiercontact::All())->with('mode', $request->mode)->with('idClient', $request->idClient);
    }

    /**
     * Permet d'encoder à la maniere Bcrypt une chaine de caracteres pour en faire un mot de passe crypté
     *
     * @param [type] $aEncoder
     * @return void
     */
    private function crypterDonnee($aEncoder){
        return password_hash($aEncoder, PASSWORD_DEFAULT);
    }
}
