<!-- PAGE D'AFFICHE DE LA FICHE D'UN PRODUIT (front accessible à tous)-->

@extends('layouts.app')

@section('content')
    <article>
        <div class="container">
            <!-- fil d’Ariane -->
            <div class="links-top">
                <a href="{{ route('product.index') }}" title="Aller à la page d'accueil">boutique</a> > 
                <!-- si produit soldé -->
                @if($product->code === 'solde')
                <a href="{{ route('product.showSolds') }}" title="Aller à la page des produits soldés">solde</a> >
                @endif
                <!-- vérifie si catégorie homme ou catégorie femme -->
                <a href="@if($category[0]['title_category'] === 'Femme')
                {{ route('product.showWomen') }}
                @else
                {{ route('product.showMen') }}
                @endif" title="Aller à la page des produits {{ $category[0]['title_category'] }}">
                    {{ $category[0]['title_category'] }}
                </a>
            </div>            
            
            <div class="row">
                <div class="col-3">
                    <!-- affichage de l'image secondaire 1 -->
                    <div class="text-center">
                        <a href="{{ route('product.switchpicture', $picture2[0]->id) }}" title="Afficher l'image en grand">
                            <img class="img-fluid w-50 mb-3" src="{{ asset('images/'.$picture2[0]->picture) }}" alt="{{ $product->title_product }}">
                        </a>                        
                    </div>
                    <!-- affichage de l'image secondaire 2 -->
                    <div class="text-center">
                        <a href="{{ route('product.switchpicture', $picture3[0]->id) }}" title="Afficher l'image en grand">
                            <img class="img-fluid w-50 mb-3" src="{{ asset('images/'.$picture3[0]->picture) }}" alt="{{ $product->title_product }}">
                        </a>
                    </div>
                    <!-- affichage de l'image secondaire 3 -->
                    <div class="text-center">
                        <a href="{{ route('product.switchpicture', $picture4[0]->id) }}" title="Afficher l'image en grand">
                            <img class="img-fluid w-50 mb-3" src="{{ asset('images/'.$picture4[0]->picture) }}" alt="{{ $product->title_product }}">
                        </a>
                    </div>                   
                
                </div>

                <!-- affichage de l'image principale -->
                <div class="col-6 text-center">
                    <img class="img-fluid" src="{{ asset('images/'.$picture1[0]->picture) }}" alt="{{ $product->title_product }}">
                </div>

                <!-- affichage des données du produit -->
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <!-- titre -->
                            <h2 class="h3 card-title">{{ $product->title_product }}</h2> 
                            <!-- référence -->
                            <p class="card-text mb-3">Réf. : {{ $product->reference }}</p>
                            <!-- prix -->
                            <p class="card-text mb-5">@price($product->price)</p>
                            <!-- récupération des tailles et transformation de la chaîne de caractères en segments -->
                            <?php $sizes = explode(" ", $product->size); ?>
                            <div class="form-group">
                                <select id="inputSize" class="form-control">
                                    <!-- boucle sur le tableau des différentes tailles du produit -->
                                    <option selected>taille</option>
                                    @foreach($sizes as $size)            
                                        <option value="{{$size}}">{{$size}}</option>        
                                    @endforeach
                                </select>
                            </div>                        
                        </div>
                    </div>  

                </div>
            </div>

            <div class="row my-5">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <!-- description -->
                        <div class="card-header">Description</div>
                        <div class="card-body">
                            <p class="card-text" style="line-height: 32px; font-size: 12px">{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            <div class="col-2"></div>        
        </div>
    </article>    
@endsection