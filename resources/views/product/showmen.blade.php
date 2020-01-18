@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            {{$productsMen->links()}}
            <p><span class="display-5 font-weight-bold">Catégorie Homme : {{count($productsMenCount)}} produits en ligne </span>
            @auth                           
                @if($user->role === 1)                
                    <span class="number-products">/ {{count($productsMenCountBr)}} produits hors ligne</span>
                @endif                                                       
            @endauth
        </div>
        
        
        <div class="flex-products">
            @foreach($productsMen as $productMen) 
                <div class="card mb-5" style="width: 18rem;">
                <a href="{{ route('product.show', $productMen->id) }}"><img class="card-img-top" src="{{ asset('images/'.$productMen->url_image) }}" alt="{{ $productMen->title_product }}"></a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title">{{ $productMen->title_product }}</h2>
                        <h3 class="card-title mb-4">Catégorie Homme</h3>
                        <p class="card-text mb-4">Prix : @price($productMen->price)</p>
                        <a href="{{ route('product.show', $productMen->id) }}" class="btn btn-dark">voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div> 
        <div class="flex-paginate">            
            <div>{{$productsMen->links()}}</div>                    
        </div>
    </div>   
@endsection