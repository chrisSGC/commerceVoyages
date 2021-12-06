@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des clients</h1>
        <a href="/gestion/editionClient/ajout" class="btn btn-primary">Ajouter un client</a>
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
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listeClients as $client)
                    <tr class="text-center">
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->idClient}}</a></td>
                        <td class="text-start"><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->prenom}}</a></td>
                        <td class="text-start"><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->nom}}</a></td>
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->genre}}</a></td>
                        <td class="text-start"><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->adresse}}<br>{{$client->cp}} {{$client->ville}}</a></td>
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->telephone}}</a></td>
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->courriel}}</a></td>
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">[{{$client->codeProvince}}] {{$client->province}}</a></td>
                        <td><a href="/gestion/editionClient/modification/{{$client->idClient}}" class="link-dark text-decoration-none">{{$client->premierContact}}</a></td>
                        <td><a href="/gestion/supprimerClient/{{$client->idClient}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection