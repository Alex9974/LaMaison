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
    <header class="bg-dark py-4 border-bottom-primary fixed-top">
        @section('sidebar')
            <div class="container">
                <div class="flex-nav-sup">
                    <h1 class="text-info mb-3">Boutique <span class="display-4">la maison</span></h1>
                    <nav>
                        <ul class="nav">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">inscription</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">déconnexion</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                            @show
                        </ul>
                    </nav>
                </div>
                
                <nav class="mt-4">
                    <ul class="nav flex-nav-inf">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('product.index') }}">accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('product.showSolds') }}">soldes</a>
                        </li>                
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('product.showMen') }}">homme</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('product.showWomen') }}">femme</a>
                        </li> 
                    </ul>
                </nav>
            </div>
            
    </header>

    <main>
    @yield('content')
    </main>

    <footer class="bg-dark py-4">
        <p class="text-info text-center letter-space">© 2020 - boutique La Maison</p>    
    </footer>

    
</body>
</html>
