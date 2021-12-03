@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des clients</h1>
        <a href="/clients" class="btn btn-primary">Retour</a>
    </div>
    <h2>Ajouter un client</h2>
    <div class="table-responsive">
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="prenomclient" class="form-label">Prénom</label>
                <input type="text" name="prenomclient" class="form-control" value="{{@old('prenomclient')}}" id="prenomclient" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <label for="nomClient" class="form-label">Nom</label>
                <input type="text" name="nomClient" class="form-control" value="{{@old('nomClient')}}" id="nomClient" placeholder="Nom de famille" required>
            </div>
            <div class="mb-3">
                <label for="adresseClient" class="form-label">Adresse</label>
                <input type="text" name="adresseClient" class="form-control" value="{{@old('adresseClient')}}" id="adresseClient" placeholder="#, Rue" required>
            </div>
            <div class="mb-3">
                <label for="cpClient" class="form-label">Code postal</label>
                <input type="text" name="cpClient" class="form-control" value="{{@old('cpClient')}}" id="cpClient" placeholder="AAA AAA" required>
            </div>
            <div class="mb-3">
                <label for="villeClient" class="form-label">Ville</label>
                <input type="text" name="villeClient" class="form-control" value="{{@old('villeClient')}}" id="villeClient" placeholder="Ville" required>
            </div>
            <div class="mb-3">
                <label for="courrielClient" class="form-label">Courriel</label>
                <input type="mail" name="courrielClient" class="form-control" value="{{@old('courrielClient')}}" id="cpClient" placeholder="votrecourriel@ici.svp" required>
            <div class="mb-3">
            </div>
                <label for="telephoneClient" class="form-label">Téléphone</label>
                <input type="tel" name="telephoneClient" class="form-control" value="{{@old('telephoneClient')}}" id="telephoneClient" placeholder="111-111-1111" required>
            </div>
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-success" type="submit">Ajouter</button>
            </div>
        </form>
    </div>
@endsection