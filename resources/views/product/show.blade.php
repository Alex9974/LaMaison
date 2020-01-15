@extends('layouts.app')

@section('sidebar')
    @parent
        @if($user)    
            @if($user->role === 1)                
                    <li class="nav-item">
                        <a class="nav-link text-light btn-admin" href="{{ route('compte') }}">Accés administrateur</a>
                    </li>
            @endif
        @endif
@endsection

@section('content')
    <article>
        <div class="container">
            <div class="links-top">
                <a href="{{ route('product.index') }}">boutique</a> > 
                @if($product->code === 'solde')
                <a href="{{ route('product.showSolds') }}">solde</a> >
                @endif

                @foreach($categories as $cat)
                    @if($product->category_id === $cat->id)
                        <a href="@if($cat->title_category === 'Femme')
                        {{ route('product.showWomen') }}
                        @else
                        {{ route('product.showMen') }}
                        @endif">{{ $cat->title_category }}</a>                        
                    @endif
                @endforeach            
            </div>
            
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 text-center">
                    <img class="img-fluid" src="{{ asset('images/'.$product->url_image) }}" alt="{{ $product->title_product }}">
                </div>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="h3 card-title">{{ $product->title_product }}</h2>                        
                            <p class="card-text mb-3">Réf. : {{ $product->reference }}</p>
                            <p class="card-text mb-5">@price($product->price)</p>
                            <?php $sizes = explode(" ", $product->size); ?>
                            <div class="form-group">
                                <select id="inputSize" class="form-control">
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

                        <div class="card-header">Description</div>

                        <div class="card-body">
                            <p class="card-text">{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            <div class="col-2"></div>        
        </div>
    </article>    
@endsection