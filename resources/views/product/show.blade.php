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
        <img class="img-fluid" src="{{ asset('images/'.$product->url_image) }}" alt="{{ $product->title_product }}">
        <p>{{ $product->title_product }}</p> 
        <p>Réf. : {{ $product->reference }}</p>     
        <p>@price($product->price)</p>
        <p>Description :</p> 
        <p>{{$product->description}}</p>
        <?php 
            $sizes = explode(" ", $product->size);
        ?>

        

        <select id="pays" name="pays">
            <option value="taille">Taille</option>
            @foreach($sizes as $size)
            
            <option value="{{$size}}">{{$size}}</option>
    
            @endforeach
        </select> 



    </div>
@endsection