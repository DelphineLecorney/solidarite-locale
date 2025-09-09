<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité Locale</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Home</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Utilisateurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Demandes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Se connecter</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <header class="my-5 d-flex justify-content-center">
        <div class="text-center p-1 rounded shadow-lg w-100"
             style="max-width: 700px; background: linear-gradient(135deg, #4e73df, #1cc88a); color: white;">
            <h1 class="display-4 fw-bold mb-3">
                Bienvenue
                @auth
                    {{ Auth::user()->name }}
                @else
                    invité sur Solidarité Locale
                @endauth
            </h1>

            @auth
                <p class="lead">Ravi de vous revoir sur <strong>Solidarité Locale</strong> !</p>
            @endauth
        </div>
    </header>


    <main class="container mt-4">
        @yield('content')
    </main>
</body>
</html>
