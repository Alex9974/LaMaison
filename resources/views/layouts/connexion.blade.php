<!-- LAYOUT DES PAGES FRONT DU SITE -->

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
<body class="bg-dark ">
    <header class="py-4 border-bottom-primary">
            <div class="container">
                <div class="flex-nav-sup">
                    <a href="{{ route('product.index') }}" alt="Page d'accueil">
                        <h1 class="text-info mb-3" style="font-size:100px; letter-spacing:3px"><span class="text-light" style="font-size:32px">boutique</span> La Maison</h1>
                    </a> 
                </div>
            </div>
    </header>
    

    <main slyle="margin-bottom:80px;">
    @yield('content')
    </main>

    <footer class="bg-dark py-4 footer-connex">
        <p class="text-info text-center letter-space">© <?= date("d-m-Y") ?> - <span style="font-weight:bold">boutique La Maison</span> </p>    
    </footer>

    <!-- -----------Bootstrap JS------------------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
</body>
</html>
