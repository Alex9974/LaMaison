@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="flex-main-head">
        {{$products->links()}}
        <p><span class="display-5 font-weight-bold">{{count($productsTotal)}} produits dans la boutique</span><span class="number-products"> / {{count($productsCount)}} en ligne et {{count($productsCountBr)}} hors ligne</span> </p>
    </div>

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
                    <td>
                        @foreach($categories as $category)
                            @if($category->id === $product->category_id)
                                {{$category->title_category}}
                            @endif
                        @endforeach
                    </td>
                    <td>@price($product->price)</td>
                    <td>{{$product->status}}</td>
                    <td><a href="{{ route('admin.edit', $product->id) }}"><button type="button" class="btn btn-info"></button></a></td>
                    <td><a href="{{ route('admin.editdestroy', $product->id) }}"><button type="button" class="btn btn-danger"></button></a></td>  
                </tr>
            @endforeach    
        </tbody>
    </table>
    

    <div class="flex-paginate">            
        <div>{{$products->links()}}</div>                    
    </div>        



    
    
    
</div>
    
@endsection


