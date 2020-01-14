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
    {{$productsWomen->links()}}
    <h1>{{count($productsWomenCount)}}</h1>

        
            @foreach($productsWomen as $productWomen)
            {{ $productWomen->id }}
                <a href="{{ route('product.show', $productWomen->id) }}"><img class="img-fluid" src="{{ asset('images/'.$productWomen->url_image) }}" alt="{{ $productWomen->title_product }}"></a>
                <p><a href="{{ route('product.show', $productWomen->id) }}">{{ $productWomen->title_product }}</a></p>
                <p>@price($productWomen->price)</p>   
                
                                
            @endforeach
    </div>
@endsection