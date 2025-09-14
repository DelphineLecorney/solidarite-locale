@extends('layouts.app')

@section('content')
    <div class="container mt-5">


        <div class="text-center my-5">
            <p class="lead mb-4">
                Une plateforme pour rapprocher les bénévoles et ceux qui ont besoin d’aide dans votre ville.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Se connecter</a>
            <a href="{{ route('register') }}" class="btn btn-success btn-lg">S’inscrire</a>
        </div>


        <h2 class="text-center mb-4">Aperçu des Dashboard</h2>
        <div class="row text-center">

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Dashboard User</h5>
                        <p class="card-text">Visualisez facilement les demandes d’aide.</p>
                    </div>
                    <img src="{{ asset('images/Dashboard_user.png') }}" class="card-img-top"
                        alt="Dashboard Suivi des demandes">
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Dashboard Admin</h5>
                        <p class="card-text">Visualisez facilement les demandes d’aide.</p>
                    </div>
                    <img src="{{ asset('images/Dashboard_admin.png') }}" class="card-img-top"
                        alt="Dashboard Suivi des demandes">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Create</h5>
                        <p class="card-text">Créer une demande d’aide.</p>
                    </div>
                    <img src="{{ asset('images/Create.png') }}" class="card-img-top"
                        alt="Dashboard Suivi des demandes">
                </div>
            </div>

            <div class="row mb-5">
                <!-- Nombre d'utilisateurs -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-people-fill fs-1 text-primary me-3"></i>
                            <div>
                                <h5 class="card-title">Nombre d'utilisateurs</h5>
                                <p class="card-text fs-2">{{ $usersCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nombre de demandes d'aide -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-cart-fill fs-1 text-success me-3"></i>
                            <div>
                                <h5 class="card-title">Nombre de demandes d'aide</h5>
                                <p class="card-text fs-2">{{ $requestsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nombre de catégories -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-tags-fill fs-1 text-warning me-3"></i>
                            <div>
                                <h5 class="card-title">Nombre de catégories</h5>
                                <p class="card-text fs-2">{{ $categoriesCount }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Autres stats -->
            {{-- <div class="col-md-3">
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-bar-chart-fill fs-1 text-danger me-3"></i>
                        <div>
                            <h5 class="card-title">Autres</h5>
                            <p class="card-text fs-2">{{ $othersCount }}</p>
                            <a href="#" class="btn btn-sm btn-outline-danger mt-2">Voir</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="text-center my-5">
        <h2>Notre mission</h2>
        <p class="lead">
            Faciliter la solidarité locale en connectant ceux qui ont besoin d’aide avec ceux qui veulent aider.
        </p>
    </div>

    </div>
@endsection
