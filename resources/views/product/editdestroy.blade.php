@extends('layouts.admin')

@section('content')
<article>
    <div class="container">
        <div class="card card-formulaire mb-5">
            <div style="letter-spacing:2px" class="card-header text-danger font-weight-bold py-4">Souhaitez-vous supprimer ce produit ?</div>
            <div class="flex-destroy m-3">

                <div class="card" style="width: 20%; border:none;">
                    <img src="{{ asset('images/'.$product->url_image) }}" class="card-img-top" alt="{{ $product->url_image }}">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold text-center" style="font-size:18px">{{ $product->title_product }}</h2>
                    </div>
                </div>

                <ul class="card-body" style="width: 80%; padding-top:0px;">

                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Description</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->description }}</li>
                        </ul>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Catégorie</div>
                        <ul class="list-group list-group-flush">
                            @foreach($categories as $category)
                                @if($category->id === $product->category_id)
                                    <li class="list-group-item">{{ $category->title_category }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Référence</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->reference }}</li>
                        </ul>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Taille(s)</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->size }}</li>
                        </ul>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header font-weight-bold">Prix</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">@price($product->price)</li>
                        </ul>
                    </div>
                </ul>
            </div>

            <a href="">
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