<!-- PAGE D'ACCUEIL DU BACK OFFICE (back office accessible uniquement aux membres administrateurs)-->

@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- message de validation si produit a bien été supprimé -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="flex-main-head">
        <!-- barre de pagination -->
        {{$products->links()}}
        <!-- compteur -->
        <p><span class="display-5 font-weight-bold">{{count($productsTotal)}} produits dans la boutique</span><span class="number-products"> / {{count($productsCount)}} en ligne et {{count($productsCountBr)}} hors ligne</span> </p>
    </div>

    <!-- listing de tous les produits en bdd (en ligne et brouillon) -->
    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">Nom du produit</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Prix</th>
                <th scope="col">Statut</th>
                <th scope="col-1">Mettre à jour</th>
                <th scope="col-1">Supprimer</th>
                <th scope="col-1">Voir la fiche</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <!-- affichage des doonées du produit -->
                    <th>{{$product->title_product}}</th>
                    <td>{{$product->title_category}}</td>
                    <td>@price($product->price)</td>
                    <td>{{$product->status}}</td>
                    <!-- pour envoyer vers le formulaire de mise à jour du produit -->
                    <td class="text-center text-info"><a href="{{ route('admin.edit', $product->id) }}" title="Mettre à jour le produit"><i class="far fa-edit icones-admin"></i></a></td>
                    <!-- pour une la page de confirmation de suppression du produit -->
                    <td class="text-center text-danger"><a href="{{ route('admin.editdestroy', $product->id) }}" title="Supprimer le produit"><i class="fas fa-trash icones-admin"></i></a></td> 
                    <!-- pour visualiser la fiche du produit -->
                    <td class="text-center text-success"><a href="{{ route('product.show', $product->id) }}" title="Voir le produit"><i class="far fa-eye icones-admin"></i></a></td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    
    <!-- pagination -->
    <div class="flex-paginate">            
        <div>{{$products->links()}}</div>                    
    </div> 
</div>
    
@endsection


