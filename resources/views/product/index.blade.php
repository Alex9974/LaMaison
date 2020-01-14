@extends('layouts.app')

@section('sidebar')
    @parent
        @if($user)    
            @if($user->role === 1)                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('compte') }}">MON COMPTE</a>
                    </li>
            @endif
        @endif
@endsection

@section('content')
    <div class="container">
    {{$products->links()}}

    <h1>{{count($productsCount)}}</h1>   

        
            @foreach($products as $product)
                {{ $product->id }}
                <a href="{{ route('product.show', $product->id) }}"><img class="img-fluid" src="{{ asset('images/'.$product->url_image) }}" alt="{{ $product->title_product }}"></a>
                <p><a href="{{ route('product.show', $product->id) }}">{{ $product->title_product }}</a></p>
                <p>@price($product->price)</p>                
            @endforeach
    </div>
@endsection