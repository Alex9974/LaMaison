<!-- PAGE D4AFFICHAGE DU PRODUIT AVANT SUPPRESSION (back office accessible uniquement aux membres administrateurs)-->

@extends('layouts.admin')

@section('content')
<article>
    <div class="container">
        <div class="card card-formulaire mb-5">
            <div style="letter-spacing:2px" class="card-header text-danger font-weight-bold py-4">Souhaitez-vous supprimer ce produit ?</div>
            <div class="flex-destroy m-3">

                <!-- affichage des 4 images du produit à supprimer -->
                <div class="card" style="width: 20%; border:none;">
                        @foreach($pictures as $picture)                                            
                                <img class="card-img-top mb-2" src="{{ asset('images/'.$picture->picture) }}" alt="{{ $product->title_product }}">                                                 
                        @endforeach
                </div>

                <!-- affichage des données du produit à supprimer -->
                <ul class="card-body" style="width: 80%; padding-top:0px;">

                    <!-- titre du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Titre du produit</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-info">{{ $product->title_product }}</li>
                        </ul>
                    </div>

                    <!-- description du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Description</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->description }}</li>
                        </ul>
                    </div>

                    <!-- catégorie du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Catégorie</div>
                        <ul class="list-group list-group-flush">                            
                                    <li class="list-group-item">{{ $category[0]->title_category }}</li>                               
                        </ul>
                    </div>

                    <!-- référence du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Référence</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->reference }}</li>
                        </ul>
                    </div>

                    <!-- tailles du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Taille(s)</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->size }}</li>
                        </ul>
                    </div>

                    <!-- prix du produit -->
                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Prix</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">@price($product->price)</li>
                        </ul>
                    </div>
                </ul>
            </div>

            <!-- bouton de suppression -->
            <a href="" title="Supprimer">
                <button type="button" class="btn btn-danger text-center btn-destroy" onclick="event.preventDefault(); document.getElementById('destroy').submit();">SUPPRIMER</button>
            </a>
            <form id="destroy" action="{{ route('admin.destroy', $product->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>           
        </div>
    </div>
</article>

@endsection