@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des voyages</h1>
    </div>
    <h2>Liste des voyages</h2>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection