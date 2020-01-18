<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cb60812a1d.js" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="bg-dark py-4 border-bottom-primary">
            <div class="container">
                <div class="flex-nav-sup">
                    <h1 class="text-info mb-3"><span class="text-light" style="font-size:32px">boutique</span> La Maison</h1>
                    <nav>
                        @auth
                            <ul class="links-lg">                            
                                @if($user->role === 1)                
                                    <li class="nav-item text-right mb-2">
                                        <a class="nav-link text-light btn-admin" href="{{ route('compte') }}"><i class="fas fa-user-lock"></i> Accés administrateur</a>
                                    </li>
                                @endif                                                       
                            </ul>
                        @endauth 
                        <ul class="nav">
                            @guest
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light" href="{{ route('login') }}">connexion</a>
                                </li>
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light" href="{{ route('register') }}">inscription</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <p class="nav-link text-info btn-pseudo">Bonjour {{$user->name}}</p>
                                </li>
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light btn-deconnex" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-lock"></i></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                            @endguest      
                        </ul>  
                    </nav>
                </div>




                
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-nav-inf">
                            <li class="nav-item ">
                                <a class="nav-link text-light" href="{{ route('product.index') }}">
                                    @if($_SERVER['REQUEST_URI'] === '/')
                                        <span class="text-info font-weight-bold">accueil</span> 
                                    @elseif(preg_match('#/\?page=[0-9]+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">accueil</span>
                                    @else
                                        accueil
                                    @endif                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showSolds') }}">
                                    @if($_SERVER['REQUEST_URI'] === '/solde')
                                        <span class="text-info font-weight-bold">solde</span> 
                                    @elseif(preg_match('#/solde\?page=[0-9]+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">solde</span> 
                                    @else
                                        solde
                                    @endif       
                                </a>
                            </li>                
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showMen') }}">
                                    @if($_SERVER['REQUEST_URI'] === '/homme')
                                        <span class="text-info font-weight-bold">homme</span> 
                                    @elseif(preg_match('#/homme\?page=[0-9]+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">homme</span> 
                                    @else
                                        homme
                                    @endif       
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showWomen') }}">
                                    @if($_SERVER['REQUEST_URI'] === '/femme')
                                        <span class="text-info font-weight-bold">femme</span>  
                                    @elseif(preg_match('#/femme\?page=[0-9]+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">femme</span> 
                                    @else
                                        femme
                                    @endif       
                                </a>
                            </li>


                            <li class="nav-item admin-link-sm mt-3">
                                @auth                        
                                    @if($user->role === 1)             
                                        <a class="nav-link text-light btn-admin" href="{{ route('compte') }}"><i class="fas fa-user-lock"></i> Accés administrateur</a>
                                    @endif
                                @endauth 
                            </li> 


                            @guest
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light" href="{{ route('login') }}">connexion</a>
                                </li>
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light" href="{{ route('register') }}">inscription</a>
                                </li>
                            @else
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light btn-deconnex-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-lock"></i> déconnexion</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                            @endguest        



                            
                            
                            





                        </ul>
                    </div>
                </nav>
            </div>            
            
    </header>
    

    <main>
    @yield('content')
    </main>

    <footer class="bg-dark py-4">
        <p class="text-info text-center letter-space">© <?= date("d-m-Y") ?> - <span style="font-weight:bold">boutique La Maison</span> </p>    
    </footer>

    <!-- -----------Bootstrap JS------------------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
</body>
</html>
