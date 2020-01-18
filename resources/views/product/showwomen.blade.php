@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            {{$productsWomen->links()}}
            <p><span class="display-5 font-weight-bold">Catégorie Femme : {{count($productsWomenCount)}} produits en ligne </span><span class="number-products">/ {{count($productsWomenCountBr)}} produits hors ligne</span> </p>
        </div>
        
        
        <div class="flex-products">
            @foreach($productsWomen as $productWomen) 
                <div class="card mb-5" style="width: 18rem;">
                <a href="{{ route('product.show', $productWomen->id) }}"><img class="card-img-top" src="{{ asset('images/'.$productWomen->url_image) }}" alt="{{ $productWomen->title_product }}"></a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title">{{ $productWomen->title_product }}</h2>
                        <h3 class="card-title mb-4">Catégorie Femme</h3>
                        <p class="card-text mb-4">Prix : @price($productWomen->price)</p>
                        <a href="{{ route('product.show', $productWomen->id) }}" class="btn btn-dark">voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div> 
        <div class="flex-paginate">            
            <div>{{$productsWomen->links()}}</div>                    
        </div>
    </div>   
@endsection