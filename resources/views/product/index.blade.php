@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            {{$products->links()}}
            <p><span class="display-5 font-weight-bold">Boutique entière : {{count($productsCount)}} produits en ligne </span><span class="number-products">/ {{count($productsCountBr)}} produits hors ligne</span> </p>
        </div>
        
        
        <div class="flex-products">
            @foreach($products as $product) 
                <div class="card mb-5" style="width: 18rem;">
                <a href="{{ route('product.show', $product->id) }}"><img class="card-img-top" src="{{ asset('images/'.$product->url_image) }}" alt="{{ $product->title_product }}"></a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title">{{ $product->title_product }}</h2>
                        <h3 class="card-title mb-4">
                            @foreach($category as $cat)
                                @if($product->category_id === $cat->id)
                                    Catégorie : {{$cat->title_category}}
                                @endif
                            @endforeach                         
                        </h3>
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