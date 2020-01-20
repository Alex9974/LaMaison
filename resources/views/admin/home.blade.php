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
        <!-- pagination -->
        {{$products->links()}}
        <!-- compteur -->
        <p><span class="display-5 font-weight-bold">{{count($productsTotal)}} produits dans la boutique</span><span class="number-products"> / {{count($productsCount)}} en ligne et {{count($productsCountBr)}} hors ligne</span> </p>
    </div>

    <!-- listing de tous les produits en bdd -->
    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">Nom du produit</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Prix</th>
                <th scope="col">Statut</th>
                <th scope="col">Mettre à jour</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <th>{{$product->title_product}}</th>
                    <td>{{$product->title_category}}</td>
                    <td>@price($product->price)</td>
                    <td>{{$product->status}}</td>
                    <!-- pour une mise à jour du produit -->
                    <td><a href="{{ route('admin.edit', $product->id) }}"><button type="button" class="btn btn-info"></button></a></td>
                    <!-- pour une suppression du produit -->
                    <td><a href="{{ route('admin.editdestroy', $product->id) }}"><button type="button" class="btn btn-danger"></button></a></td>  
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


