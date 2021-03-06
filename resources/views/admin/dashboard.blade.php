@extends('layout.template')

@section('contenuAdmin')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
    </div>
    <h2>Les 20 dernieres ventes</h2>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($listeVentesFinale as $vente)
                    @if($vente->etatVente)
                        <tr class="text-center">
                    @else
                        <tr class="bg-warning text-center">
                    @endif
                        <td>{{$vente->idVente}}</td>
                        <td class="text-start">{{$vente->nomClient}}</td>
                        <td class="text-start">{{$vente->nomVoyage}}</td>
                        <td>{{$vente->dateVente}}</td>
                        <td>{{number_format($vente->prix, 2, ',', ' ')}} $</td>
                        <td>{{number_format($vente->quantite, 0)}}</td>
                        <td>{{number_format($vente->prix * $vente->quantite, 2, ',', ' ')}} $</td>
                        <td>{{number_format($vente->montantPercu, 2, ',', ' ')}} $</td>
                        @if($vente->etatVente)
                            <td><span class="badge bg-success">Payé</span></td> 
                        @else
                            <td><span class="badge bg-danger">Paiement nécessaire</span></td> 
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection