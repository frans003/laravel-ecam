<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">

        <!-- Nom de l'application -->

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Barre de navigation pour navigation sur écran plus petit -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Coté gauche de la barre de navigation -->
            <ul class="navbar-nav mr-auto">

                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Carnet d'Universités <span class="caret"></span>
                            </a>
    
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/Notes_App - V2/public/universites">
                                    Afficher la liste
                                </a>
                                <a class="dropdown-item" href="/Notes_App - V2/public/universites/create">
                                    Inscrire
                                </a>
                            </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Régistre des cours <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/Notes_App - V2/public/cours">
                                Afficher
                            </a>
                            <a class="dropdown-item" href="/Notes_App - V2/public/cours/create">
                                Créer
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Catalogue de notes <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/Notes_App - V2/public/notes">
                                Afficher
                            </a>
                            <a class="dropdown-item" href="/Notes_App - V2/public/notes/create">
                                Créer
                            </a>
                        </div>
                    </li>
            </ul>

            <!-- Coté droit de la barre de navigation -->

            <ul class="navbar-nav ml-auto">

                <!-- Liens d'authentication -->
                
                    <!-- Utilisateur non connecté -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>

                    <!-- Utilisateur connecté -->
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                            <a class="dropdown-item" href="/Notes_App - V2/public/dashboard">
                                Dashboard
                            </a>

                            <a class="dropdown-item" href="/Notes_App - V2/public/profile">
                                Mon Profil
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </li>

                @endguest

            </ul>

        </div>

    </div>

</nav>