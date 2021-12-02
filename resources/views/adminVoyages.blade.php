@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des voyages</h1>
    </div>
    <h2>Liste des voyages</h2>
    <div class="col-12">
        <a href="/nouveauVoyage" class="btn btn-primary">Ajouter un voyage</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Date de depart</th>
                    <th scope="col">Duree</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Departement</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listeVoyages as $voyage)
                    <tr class="text-center">
                        <td>{{$voyage->idVoyage}}</td>
                        <td class="text-start">{{$voyage->nomVoyage}}</td>
                        <td>{{$voyage->dateDebut}}</td>
                        <td>{{$voyage->duree}} jours</td>
                        <td>{{$voyage->ville}}</td>
                        <td>{{number_format($voyage->prix, 2, ',', ' ')}} $</td>
                        <td>[{{$voyage->codeDepartement}}] {{$voyage->nomDepartement}}</td>
                        <td>{{$voyage->categorie}}</td>
                        <td><a href="/supprimerVoyage/{{$voyage->idVoyage}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection