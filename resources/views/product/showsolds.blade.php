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
    {{$productsSolds->links()}}
    <h1>{{count($productsSoldsCount)}}</h1>

        
            @foreach($productsSolds as $productSolds)
            {{ $productSolds->id }}
                <a href="{{ route('product.show', $productSolds->id) }}"><img class="img-fluid" src="{{ asset('images/'.$productSolds->url_image) }}" alt="{{ $productSolds->title_product }}"></a>
                <p><a href="{{ route('product.show', $productSolds->id) }}">{{ $productSolds->title_product }}</a></p>
                <p>@price($productSolds->price)</p>   
                
                                
            @endforeach
    </div>
@endsection