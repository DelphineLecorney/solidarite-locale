<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité Locale</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/') }}">
                        <i class="bi bi-people-fill me-2"></i>
                        Solidarité Locale
                    </a>
                </div>
            </nav>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @elseif(auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    @endauth

                </ul>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif

                <div class="bg-light justify-content-center p-3 rounded shadow-sm mb-3 mx-auto">
                    <h2 class="mb-1">Bonjour @auth {{ Auth::user()->name }}
                        @else
                        invité @endauth 👋</h2>
                </div>


                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">S’inscrire</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger btn-sm rounded-pill px-3 d-flex align-items-center gap-2"
                            type="submit">
                            <i class="bi bi-box-arrow-right"></i>
                            Déconnexion
                        </button>
                    </form>
                @endguest
            </div>
        </div>
        </div>
    </nav>


    <main class="flex-grow-1 container mt-4">
        @yield('content')
    </main>


    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            &copy; {{ date('Y') }} Solidarité Locale. Tous droits réservés.
            <div class="mt-2">
                <a href="#" class="text-white me-2">Mentions légales</a>
                <a href="#" class="text-white">Contact</a>
            </div>
        </div>
    </footer>

</body>

</html>
