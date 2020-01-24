<!-- PAGE D'ACCUEIL DU SITE (front accessible à tous)-->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-main-head">
            <!-- barre de pagination -->
            {{$products->links()}}
            <!-- compteur -->
            <span class="display-5 font-weight-bold">
                <!-- compteur des produits soldés en ligne -->
                @if(preg_match('#/solde+#', $_SERVER['REQUEST_URI']))
                    <p>{{count($productsCount)}} produits soldés en ligne </span>
                    <!-- compteur des produits soldés hors ligne affiché uniquement si membre administrateur -->
                    @auth                           
                        @if($user->role === 1)                
                            <span class="number-products">/ {{count($productsCountBr)}} produits soldés hors ligne</span>
                        @endif                                                       
                    @endauth
                    </p>
                <!-- compteur des produits hommes ou femme en ligne -->
                @elseif(preg_match('#/homme+#', $_SERVER['REQUEST_URI']) || preg_match('#/femme+#', $_SERVER['REQUEST_URI']))
                    <p>Catégorie {{ $products[0]->title_category }} : {{count($productsCount)}} produits en ligne </span>
                    <!-- compteur des produits homme ou femme hors ligne affiché uniquement si membre administrateur -->
                    @auth                           
                        @if($user->role === 1)                
                            <span class="number-products">/ {{count($productsCountBr)}} produits hors ligne</span>
                        @endif                                                       
                    @endauth
                    </p>
                <!-- compteur de tous les produits en ligne -->
                @else
                <p>Boutique entière : {{count($productsCount)}} produits en ligne </span>
                    <!-- compteur des produits hors ligne affiché uniquement si membre administrateur -->
                    @auth                           
                        @if($user->role === 1)                
                            <span class="number-products">/ {{count($productsCountBr)}} produits hors ligne</span>
                        @endif                                                       
                    @endauth
                </p>
                @endif
            
        </div>        
        
        <!-- listing des produits en ligne : tous les produits OU produits en soldes OU produits de la catégorie homme OU produits de la catégorie femme  -->
        <div class="flex-products">
            @foreach($products as $product) 
                <div class="card mb-5" style="width: 18rem;">
                    <a href="{{ route('product.show', $product->id) }}"  title="Voir la fiche du produit">
                        <img class="card-img-top" src="{{ asset('images/'.$product->picture) }}" alt="{{ $product->title_product }}">                                
                    </a>
                    <div class="card-body text-center">
                        <h2 class="h2 card-title mb-5">{{ $product->title_product }}</h2>
                        <h3 class="card-title mb-3 font-weight-bold"> Catégorie {{$product->title_category}}</h3>
                        <!-- si produit est renseigné en solde dans la bdd -->
                        @if($product->code === 'solde')
                            <p class="card-title mb-4 font-italic" style="font-size:12px">Produit en solde</p>
                        @endif
                        <p class="card-text mb-4">Prix : @price($product->price)</p>
                        <!-- bouton d'accès à la fiche du produit -->
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-dark" title="Voir la fiche du produit">voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- barre de pagination -->
        <div class="flex-paginate">            
            <div>{{$products->links()}}</div>                    
        </div>        
    </div>
    
@endsection