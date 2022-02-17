<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbartoggle"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <div class="navbar-toggler-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbartoggle">
            <ul class="flexHeader">
                <li><a href="/">Accueil</a></li>
                <li><a href="/recipe-list">Liste des recettes</a></li>
                @if (!Auth::check() && !Auth::guard('admin')->check())
                    <li><a href="/register">Inscription</a></li>
                    <li><a href="/connect">Connexion</a></li>
                @endif
                @if (Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- appelle du pseudo de l'utilisateur authentifier-->
                            Bienvenue {{ Auth::user()->pseudo }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/addRecipe" class="dropdown-item" type="button">Ajouter une recette</a>
                            </li>
                            <li><a href="/gestion_compte" class="dropdown-item" type="button">Gestion de
                                    compte</button></a>
                            <li><a href="/disconnect" class="dropdown-item" type="button">Se deconnecter</button></a>
                        </ul>
                    </div>
                @endif

                @if (Auth::guard('admin')->check())
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- appelle du pseudo de l'utilisateur authentifier-->
                            Bienvenue {{ Auth::guard('admin')->user()->pseudo }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/listUsers" class="dropdown-item" type="button">Gestion des utilisateurs</button></a></li>
                            <li><a href="/disconnect" class="dropdown-item" type="button">Se deconnecter</button></a>
                            </li>
                        </ul>
                    </div>
                @endif
            </ul>
        </div>

    </div>
</nav>
