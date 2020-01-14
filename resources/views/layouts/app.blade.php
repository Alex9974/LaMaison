<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Montserrat&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        
    
    </header>

    <main>
    
    </main>

    <footer>
    
    </footer>
    @section('sidebar')
        <div class="container">
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.showSolds') }}">SOLDES</a>
                    </li>                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.showMen') }}">HOMME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.showWomen') }}">FEMME</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">CONNEXION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">INSCRIPTION</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">DECONNEXION</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest

                </ul>
            </nav>
        </div>
    @show

    @yield('content')
</body>
</html>
