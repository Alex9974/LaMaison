<!-- LAYOUT DES PAGES FRONT DU SITE -->
<!-- accessible à tous : non connecté, membre authentifié, membre administrateur (role = 1) -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Maison - 
    @if(preg_match('#^/solde+#', $_SERVER['REQUEST_URI']))
        Produits en solde
    @elseif(preg_match('#^/homme+#', $_SERVER['REQUEST_URI']))
        Produits Homme
    @elseif(preg_match('#^/femme+#', $_SERVER['REQUEST_URI']))
        Produits Femme
    @elseif(preg_match('#^/produit/[0-9]+#', $_SERVER['REQUEST_URI']))
        Produit {{ $product->title_product }} 
    @else
        Accueil
    @endif
    </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cb60812a1d.js" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- header -->
    <header class="bg-dark py-4 border-bottom-primary">
            <div class="container">
                <div class="flex-nav-sup">
                    <h1 class="text-info mb-3"><span class="text-light" style="font-size:32px">boutique</span> La Maison</h1>
                    <nav>
                        <!-- si membre authentifié et administrateur -->
                        @auth
                            <ul class="links-lg"> 
                                <!-- accés au back office -->
                                @if($user->role === 1)                
                                    <li class="nav-item text-right mb-2">
                                        <a class="nav-link text-light btn-admin" href="{{ route('compte') }}" title="Accès au back office"><i class="fas fa-user-lock"></i> Accés administrateur</a>
                                    </li>
                                @endif                                                       
                            </ul>
                        @endauth 
                        <ul class="nav">
                            <!-- si membre non authentifié -->
                            @guest
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light" href="{{ route('login') }}" title="Connexion">connexion</a>
                                </li>
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light" href="{{ route('register') }}" title="Inscription">inscription</a>
                                </li>
                            <!-- si membre authentifié -->
                            @else
                                <!-- affiche le pseudo de l'administrateur -->
                                <li class="nav-item">
                                    <p class="nav-link text-info btn-pseudo">Bonjour {{$user->name}}</p>
                                </li>
                                <!-- icone de déconnexion qui disparait pour petit écran-->
                                <li class="nav-item links-lg">
                                    <a class="nav-link text-light btn-deconnex" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Déconnexion"><i class="fas fa-lock"></i></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                            @endguest      
                        </ul>  
                    </nav>
                </div>

                <!-- barre de liens responsive -->                 
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-nav-inf">
                            <!-- lien vers la page d'accueil de l'application -->
                            <li class="nav-item ">
                                <a class="nav-link text-light" href="{{ route('product.index') }}" title="Aller à la page d'accueil">
                                    <!-- vérification de l'URI pour un affichage du lien en conséquence  -->
                                    @if($_SERVER['REQUEST_URI'] === '/' || preg_match('#^/\?page=[0-9]+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">accueil</span>                                    
                                    @else
                                        accueil
                                    @endif                                    
                                </a>
                            </li>
                            <!-- lien vers la page des produits soldés -->
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showSolds') }}" title="Aller à la page des produits soldés">
                                    <!-- vérification de l'URI pour un affichage du lien en conséquence  -->
                                    @if(preg_match('#^/solde+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">solde</span> 
                                    @else
                                        solde
                                    @endif       
                                </a>
                            </li> 
                            <!-- lien vers la page des produits de la catégorie Homme -->               
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showMen') }}" title="Aller à la page des produits homme">
                                    <!-- vérification de l'URI pour un affichage du lien en conséquence  -->
                                    @if(preg_match('#^/homme+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">homme</span> 
                                    @else
                                        homme
                                    @endif       
                                </a>
                            </li>
                            <!-- lien vers la page des produits de la catégorie Femme --> 
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('product.showWomen') }}" title="Aller à la page des produits femme">
                                    <!-- vérification de l'URI pour un affichage du lien en conséquence  -->
                                    @if(preg_match('#^/femme+#', $_SERVER['REQUEST_URI']))
                                        <span class="text-info font-weight-bold">femme</span>
                                    @else
                                        femme
                                    @endif       
                                </a>
                            </li>

                            <!-- Pour affichage sur petits écrans -->                            
                            <li class="nav-item admin-link-sm mt-3">
                                <!-- si membre authentifié et administrateur -->
                                @auth    
                                    <!-- accés au back office -->                    
                                    @if($user->role === 1)             
                                        <a class="nav-link text-light btn-admin" href="{{ route('compte') }}" title="Accès au back office"><i class="fas fa-user-lock"></i> Accés administrateur</a>
                                    @endif
                                @endauth 
                            </li> 

                            <!-- si membre non authentifié -->
                            @guest
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light" href="{{ route('login') }}" title="Connexion">connexion</a>
                                </li>
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light" href="{{ route('register') }}" title="Inscription">inscription</a>
                                </li>
                            <!-- si membre authentifié -->
                            @else
                                <!-- lien de déconnexion -->
                                <li class="nav-item links-sm">
                                    <a class="nav-link text-light btn-deconnex-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Déconexion"><i class="fas fa-lock"></i> déconnexion</a>
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
        <!-- emplacement du contenu des vues -->
        @yield('content')
    </main>

    <!-- footer -->
    <footer class="bg-dark py-4">
        <p class="text-info text-center letter-space">© <?= date("d-m-Y") ?> - <span style="color:white;">boutique <span class="titre-footer">La Maison</span></span> </p>    
    </footer>

    <!-- -----------Bootstrap JS------------------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
</body>
</html>
