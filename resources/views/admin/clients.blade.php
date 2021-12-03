@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des clients</h1>
        <a href="/nouveauClient" class="btn btn-primary">Ajouter un client</a>
    </div>
    <h2>Liste des clients</h2>
    <div class="table-responsive">
        <table class="table table-striped table-borderless table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Province</th>
                    <th scope="col">Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listeClients as $client)
                    <tr class="text-center">
                        <td>{{$client->idClient}}</td>
                        <td class="text-start">{{$client->prenom}}</td>
                        <td class="text-start">{{$client->nom}}</td>
                        <td>{{$client->genre}}</td>
                        <td class="text-start">{{$client->adresse}}<br>{{$client->cp}} {{$client->ville}}</td>
                        <td>{{$client->telephone}}</td>
                        <td>{{$client->courriel}}</td>
                        <td>[{{$client->codeProvince}}] {{$client->province}}</td>
                        <td>{{$client->premierContact}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection