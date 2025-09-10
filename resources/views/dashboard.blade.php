@extends('layouts.app')

@section('content')
<h1 class="mb-4">Tableau de bord</h1>

<!-- Cartes statistiques -->
<div class="row mb-5">
    <div class="col-md-3">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-people-fill fs-1 text-primary me-3"></i>
                <div>
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text fs-2">{{ $usersCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-cart-fill fs-1 text-success me-3"></i>
                <div>
                    <h5 class="card-title">Demandes d’aide</h5>
                    <p class="card-text fs-2">{{ $requestsCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-list-check fs-1 text-warning me-3"></i>
                <div>
                    <h5 class="card-title">Catégories</h5>
                    <p class="card-text fs-2">{{ $categoriesCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-box-arrow-right fs-1 text-danger me-3"></i>
                <div>
                    <h5 class="card-title">Autres</h5>
                    <p class="card-text fs-2">{{ $othersCount ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tableau des dernières demandes -->
<h2 class="mb-3">Dernières demandes d’aide</h2>

<form method="GET" action="{{ route('dashboard') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="category" class="form-select">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select name="status" class="form-select">
            <option value="">Tous les statuts</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Acceptée</option>
            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Terminée</option>
        </select>
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">Filtrer</button>
    </div>
</form>

<table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Utilisateur</th>
            <th>Catégorie</th>
            <th>Adresse</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($helpRequests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->title }}</td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->category->name }}</td>
            <td>
                @auth
                    {{ $request->address->street }}, {{ $request->address->city }}
                @else
                    <em>Connectez-vous pour voir l’adresse</em>
                @endauth
            </td>
            <td>{{ $request->created_at->format('d/m/Y') }}</td>
            <td>
                @php
                    $badgeClass = match($request->status) {
                        'pending' => 'bg-warning text-dark',
                        'accepted' => 'bg-success',
                        'done' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ ucfirst($request->status) }}</span>
            </td>
            <td>
                <a href="{{ route('requests.show', $request->id) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Aucune demande pour le moment</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination Bootstrap -->
<div class="d-flex justify-content-center mt-4">
    {{ $helpRequests->links('pagination::bootstrap-5') }}
</div>
@endsection
