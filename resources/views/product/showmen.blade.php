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
    {{$productsMen->links()}}
    <h1>{{count($productsMenCount)}}</h1>
        
            @foreach($productsMen as $productMen)
            {{ $productMen->id }}
                <a href="{{ route('product.show', $productMen->id) }}"><img class="img-fluid" src="{{ asset('images/'.$productMen->url_image) }}" alt="{{ $productMen->title_product }}"></a>
                <p><a href="{{ route('product.show', $productMen->id) }}">{{ $productMen->title_product }}</a></p>
                <p>@price($productMen->price)</p>   
                
                                
            @endforeach
    </div>
@endsection