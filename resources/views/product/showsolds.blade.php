@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            {{$productsSolds->links()}}
            <p><span class="display-5 font-weight-bold">{{count($productsSoldsCount)}} produits soldés en ligne </span>
            @auth                           
                @if($user->role === 1)                
                    <span class="number-products">/ {{count($productsSoldsCountBr)}} produits soldés hors ligne</span>
                @endif                                                       
            @endauth
        </div>
        
        
        <div class="flex-products">
            @foreach($productsSolds as $productSolds) 
                <div class="card mb-5" style="width: 18rem;">
                <a href="{{ route('product.show', $productSolds->id) }}"><img class="card-img-top" src="{{ asset('images/'.$productSolds->url_image) }}" alt="{{ $productSolds->title_product }}"></a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title">{{ $productSolds->title_product }}</h2>
                        <h3 class="card-title mb-4">Produit en solde</h3>
                        <p class="card-text mb-4">Prix : @price($productSolds->price)</p>
                        <a href="{{ route('product.show', $productSolds->id) }}" class="btn btn-dark">voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex-paginate">            
            <div>{{$productsSolds->links()}}</div>                    
        </div> 
    </div>
@endsection