<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon application web de gestions de recettes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <!-- header de la page -->
    <header>
        @include('header')
    </header>
    <!--fin du header de la page-->

    <!--Contenu de la page-->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <!--fin du contenu-->

    <!--footer de la page-->
    <footer>
        @include('footer')
    </footer>
    <!--fin du footer de la page-->
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
