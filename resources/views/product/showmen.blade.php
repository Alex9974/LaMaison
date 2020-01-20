<!-- PAGE D'AFFICHE DE TOUS LES PRODUITS EN LIGNE DES HOMMES (front accessible à tous)-->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            {{$products->links()}}
            <p><span class="display-5 font-weight-bold">Catégorie {{ $products[0]->title_category }} : {{count($productsMenCount)}} produits en ligne </span>
            @auth                           
                @if($user->role === 1)                
                    <span class="number-products">/ {{count($productsMenCountBr)}} produits hors ligne</span>
                @endif                                                       
            @endauth
            </p>
        </div>        
        
        <div class="flex-products">
            @foreach($products as $product) 
                <div class="card mb-5" style="width: 18rem;">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img class="card-img-top" src="{{ asset('images/'.$product->picture) }}" alt="{{ $product->title_product }}">
                    </a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title">{{ $product->title_product }}</h2>
                        <h3 class="card-title mb-4">Catégorie {{ $product->title_category }}</h3>
                        <p class="card-text mb-4">Prix : @price($product->price)</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-dark">voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div> 
        <div class="flex-paginate">            
            <div>{{$products->links()}}</div>                    
        </div>
    </div>   
@endsection