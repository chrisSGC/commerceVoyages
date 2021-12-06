@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des clients</h1>
        <a href="/clients" class="btn btn-primary">Retour</a>
    </div>
    <h2>Ajouter un client</h2>
    
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
    <div class="table-responsive">
        <form action="/ajouterClient" method="post">
            @csrf
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" value="{{@old('prenom')}}" id="prenom" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{@old('nom')}}" id="nom" placeholder="Nom de famille" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control" value="{{@old('adresse')}}" id="adresse" placeholder="#, Rue" required>
            </div>
            <div class="mb-3">
                <label for="cp" class="form-label">Code postal</label>
                <input type="text" name="cp" class="form-control" value="{{@old('cp')}}" id="cp" placeholder="AAA AAA" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" name="ville" class="form-control" value="{{@old('ville')}}" id="ville" placeholder="Ville" required>
            </div>
            <div class="mb-3">
                <label for="courriel" class="form-label">Courriel</label>
                <input type="mail" name="courriel" class="form-control" value="{{@old('courriel')}}" id="courriel" placeholder="votrecourriel@ici.svp" required>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" name="telephone" class="form-control" value="{{@old('telephone')}}" id="telephone" placeholder="111-111-1111" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Sexe</label>
                <div class="d-flex">
                    <div class="form-check mx-2">
                        <input class="form-check-input" type="radio" value="M" name="genre" id="genreM" {{ old('genre') == "M" ? "checked" : "" }}>
                        <label class="form-check-label" for="genreM">Homme</label>
                    </div>
                    <div class="form-check mx-2">
                        <input class="form-check-input" type="radio" value="F" name="genre" id="genreF" {{ old('genre') == "F" ? "checked" : "" }}>
                        <label class="form-check-label" for="genreF">Femme</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Province</label>
                <select class="form-select" name="province" id="province" aria-label="Default select example">
                    <option selected>Selectionnez une province</option>
                    @foreach($listeProvinces as $province)
                        <option {{ old('province') == $province->id ? "selected" : "" }} value="{{ $province->id }}">[{{$province->codeProvince}}] {{$province->province}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="premierContact" class="form-label">Premier contact</label>
                <select class="form-select" name="premierContact" id="premierContact" aria-label="Default select example">
                    <option selected>Selectionnez un mode de premier contact</option>
                    @foreach($listePremiersContacts as $contact)
                        <option {{ old('premierContact') == $contact->id ? "selected" : "" }} value="{{ $contact->id }}">{{$contact->premierContact}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="motDePasse" class="form-label">Mot de passe du compte client</label>
                <input type="password" name="motDePasse" class="form-control" value="{{@old('motDePasse')}}" id="motDePasse" placeholder="Mot de passe du compte client" required>
            </div>
            <div class="mb-3 d-flex flex-row-reverse">
                <button class="btn btn-success" type="submit">Ajouter</button>
            </div>
        </form>
    </div>
@endsection