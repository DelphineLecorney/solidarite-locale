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


    <h2 class="text-center mb-4">Aperçu du Dashboard</h2>
    <div class="row text-center">

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('images/Captured180905.png') }}" class="card-img-top" alt="Dashboard Suivi des demandes">
                <div class="card-body">
                    <h5 class="card-title">Suivi des demandes</h5>
                    <p class="card-text">Visualisez facilement les dernières demandes d’aide.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('images/Captured180201.png') }}" class="card-img-top" alt="Dashboard Statistiques">
                <div class="card-body">
                    <h5 class="card-title">Statistiques globales</h5>
                    <p class="card-text">Obtenez un aperçu rapide des utilisateurs et catégories.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('images/dashboard3.png') }}" class="card-img-top" alt="Dashboard Organisation">
                <div class="card-body">
                    <h5 class="card-title">Organisation facile</h5>
                    <p class="card-text">Gérez vos bénévoles et demandes efficacement.</p>
                </div>
            </div>
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
