@extends('layout.template')

@section('contenuAdmin')
<?php echo"<script>window.listeVoyages = ".json_encode($listeVoyages).";</script>";?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Historiques des ventes</h1>
    </div>
    <h2>Liste des ventes</h2>
    <div class="alert col-12 alert-primary" role="alert">
        <h4 class="alert-heading d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>&nbsp;
            <span>Informations</span></h4>
        <hr>
        <p>Cette page liste les ventes de la plus récente à la plus ancienne. cliquez sur une vente pour voir les paiements recus associés à cette dernière.</p>
        <p>Dans le cas ou vous avez recu un paiement depuis une autre plateforme que le site, vous pouvez ajouter un paiement mannuellement en cliquant sur l'icone ICONE et en entrant les données.</p>
        <p>Il est aussi possible d'ajouter depuis cette page une nouvell vente.</p>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#nouvelleVenteModal">Ajouter une vente</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Client</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Date</th>
                    <th scope="col">PU</th>
                    <th scope="col">Qte</th>
                    <th scope="col">Total</th>
                    <th scope="col">Montant percu</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listeVentesFinale as $vente)
                    @if($vente->etatVente)
                        <tr style="cursor: pointer;" class="text-center">
                    @else
                        <tr style="cursor: pointer;" class="bg-warning text-center">
                    @endif
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{$vente->idVente}}</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})" class="text-start">{{$vente->nomClient}}</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})" class="text-start">{{$vente->nomVoyage}}</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{$vente->dateVente}}</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{number_format($vente->prix, 2, ',', ' ')}} $</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{number_format($vente->quantite, 0)}}</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{number_format($vente->prix * $vente->quantite, 2, ',', ' ')}} $</td>
                        <td onClick="afficherPaiements({{$vente->idVente}})">{{number_format($vente->montantPercu, 2, ',', ' ')}} $</td>
                        @if($vente->etatVente)
                            <td onClick="afficherPaiements({{$vente->idVente}})"><span class="badge bg-success">Payé</span></td> 
                        @else
                            <td onClick="afficherPaiements({{$vente->idVente}})"><span class="badge bg-danger">Paiement nécessaire</span></td> 
                        @endif
                        <td>
                            <span data-bs-toggle="modal" data-bs-target="#ajouterPaiementModal" onClick="ajouterPaiement({{$vente->idVente}})" class="badge bg-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/>
                                </svg>
                            </span>
                            <span onClick="annulerVente(this, {{$vente->idVente}})" class="badge bg-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </span>
                        </td>
                    </tr>
                    <tr class="d-none" id="paiements_{{$vente->idVente}}">
                        <td colspan="10">
                            <table class="table table-borderless table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id="listePaiements_{{$vente->idVente}}">
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ajouterPaiementModal" tabindex="-1" aria-labelledby="titreModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titreModal">Ajouter un paiement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formAjoutPaiement" action="">
                    <div class="modal-body">
                        <input type="hidden" value="" name="idVenteAssociee" id="idVenteAssociee" />
                        @csrf
                        <div class="alert mb-3 d-none" id="erreurAjout">
                            <h4 class="alert-heading" id="erreurAjoutTitre"></h4>
                            <hr>
                            <p id="erreurAjoutContenu"></p>
                        </div>
                        <div class="mb-3">
                            <label for="montantPaiementSupp" class="form-label">Montant du paiement</label>
                            <input type="number" name="montantPaiementSupp" step=".01" class="form-control" id="montantPaiementSupp" placeholder="150.00">
                        </div>
                        <div class="mb-3">
                            <label for="datePaiementSupp" class="form-label">Date du paiement</label>
                            <input type="date" name="datePaiementSupp" class="form-control" id="datePaiementSupp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="annulerAjout" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" id="validerAjout" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="nouvelleVenteModal" tabindex="-1" aria-labelledby="titreModalNvVente" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titreModalNvVente">Ajouter une vente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formAjoutVente" action="">
                    <div class="modal-body">
                        @csrf
                        <div class="alert mb-3 d-none" id="erreurAjoutVente">
                            <h4 class="alert-heading" id="erreurAjoutVenteTitre"></h4>
                            <hr>
                            <p id="erreurAjoutVenteContenu"></p>
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <select class="form-select" name="client" id="client" aria-label="Default select example">
                                <option selected>Selectionnez un client</option>
                                @foreach($listeClients as $client)
                                    <option value="{{$client->id}}">{{$client->prenom}} {{$client->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voyage" class="form-label">Voyage</label>
                            <select class="form-select" name="voyage" id="voyage" aria-label="Default select example">
                                <option selected>Selectionnez un voyage</option>
                                @foreach($listeVoyages as $voyage)
                                    <option value="{{$voyage->id}}">{{$voyage->nomVoyage}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nbrPassagers" class="form-label">Nombre de passagers</label>
                            <input type="number" name="nbrPassagers" step="1" min="1" class="form-control" id="nbrPassagers" placeholder="1">
                        </div>
                        <div class="mb-3">
                            <label for="nbrPassagers" class="form-label">Prix hors taxes</label>
                            <input type="text" disabled class="form-control" id="prixTotalVoyageHT">
                        </div>
                        <div class="mb-3">
                            <label for="dateAchat" class="form-label">Date de l'achat</label>
                            <input type="date" name="dateAchat" class="form-control" id="dateAchat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="annulerAjoutVente" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" id="validerAjoutVente" disabled class="btn btn-success">Remplissez les champs</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin/ventes.js')}}"></script>
@endsection