@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des voyages</h1>
        <a href="/gestion/voyages" class="btn btn-warning">Retour</a>
    </div>
    <h2>{{ $mode == "ajout" ? "Ajouter" : "Modifier" }} un voyage</h2>
    @if ($errors->any())
        <div class="col-12">
            <div class="alert alert-danger">  
                <strong>Woop woop</strong> Hmmm ca sent l'illégalité ici! On va te balancer à la maréchaussée!!<br>
                <ul class="list-unstyled">  
                    @foreach ($errors->all() as $error)  
                        <li>{{ $error }}</li>  
                    @endforeach  
                </ul>  
            </div>
        </div>
    @endif
    <div class="col-12">
        <form action="/gestion/enregistrerVoyage" method="post">
            @csrf
            <input type="hidden" name="mode" value="{{$mode}}" />
            @if($mode == "modification")
                <input type="hidden" name="idVoyage" value="{{$idVoyage}}" />
            @endif
            <div class="mb-3">
                <label for="nomVoyage" class="form-label">Nom</label>
                <input type="text" name="nomVoyage" class="form-control" value="{{@old('nomVoyage')}}" id="nomVoyage" placeholder="Indiquez un nom" required>
            </div>
            <div class="mb-3">
                <label for="prixVoyage" class="form-label">Prix</label>
                <input type="number" name="prixVoyage" step=".01" min="1" value="{{@old('prixVoyage')}}" class="form-control" id="prixVoyage" placeholder="150.00" required>
            </div>
            <div class="mb-3">
                <label for="dateVoyage" class="form-label">Date de départ</label>
                <input type="date" name="dateVoyage" class="form-control" value="{{@old('dateVoyage')}}" id="dateVoyage">
            </div>
            <div class="mb-3">
                <label for="dureeVoyage" class="form-label">Durée (en jours)</label>
                <input type="number" name="dureeVoyage" step="1" min="1" value="{{@old('dureeVoyage')}}" class="form-control" id="dureeVoyage" placeholder="1" required>
            </div>
            <div class="mb-3">
                <label for="departementVoyage" class="form-label">Département</label>
                <select class="form-select" name="departementVoyage" id="departementVoyage" aria-label="Default select example">
                    <option selected>Selectionnez un département</option>
                    @foreach($listeDepartements as $departement)
                        <option {{ old('departementVoyage') == $departement->id ? "selected" : "" }} value="{{ $departement->id }}">[{{$departement->codeDepartement}}] {{$departement->nomDepartement}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="villeVoyage" class="form-label">Ville</label>
                <input type="text" name="villeVoyage" class="form-control" value="{{@old('villeVoyage')}}" id="villeVoyage" placeholder="Indiquez une ville" required>
            </div>
            <div class="mb-3">
                <label for="categorieVoyage" class="form-label">Catégorie</label>
                <select class="form-select" name="categorieVoyage" id="categorieVoyage" aria-label="Default select example">
                    <option selected>Selectionnez une catégorie</option>
                    @foreach($listeCategories as $categorie)
                        <option {{ old('categorieVoyage') == $categorie->id ? "selected" : "" }} value="{{ $categorie->id }}">{{$categorie->categorie}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-success" type="submit">{{ $mode == "ajout" ? "Ajouter" : "Modifier" }}</button>
            </div>
        </form>
    </div>
@endsection