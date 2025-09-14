@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tableau de bord Admin</h1>

    <!-- Cartes statistiques -->
    <div class="row mb-5">
        <!-- Utilisateurs -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people-fill fs-1 text-primary me-3"></i>
                    <div>
                        <h5 class="card-title">Utilisateurs</h5>
                        <p class="card-text fs-2">{{ $usersCount ?? 0 }}</p>
                        <a href="{{ route('admin.user') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Gérer les utilisateurs
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demandes d’aide -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-cart-fill fs-1 text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Demandes d’aide</h5>
                        <p class="card-text fs-2">{{ $requestsCount ?? 0 }}</p>
                        <a href="{{ route('admin.help-requests.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Gérer les demandes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Missions -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-list-check fs-1 text-warning me-3"></i>
                    <div>
                        <h5 class="card-title">Missions</h5>
                        <p class="card-text fs-2">{{ $missionsCount ?? 0 }}</p>
                        <a href="{{ route('admin.missions') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Gérer les missions
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Autres -->
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

    <!-- Tableau des demandes -->
    <h2 class="mb-3">Demandes d’aide</h2>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Titre</th>
                <th>Statut</th>
                <th>Utilisateur</th>
                <th>Adresse</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->created_at->format('d/m/Y') }}</td>
                    <td>{{ $request->title }}</td>
                    <td>
                        @php
                            $badgeClass = match ($request->status) {
                                'pending' => 'bg-warning text-dark',
                                'accepted' => 'bg-success',
                                'done' => 'bg-danger',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($request->status) }}</span>
                    </td>
                    <td>{{ $request->user->name }}</td>
                    <td>
                        {{ $request->address?->street ?? 'Adresse non renseignée' }},
                        {{ $request->address?->postcode ?? '' }} {{ $request->address?->city ?? '' }}
                    </td>
                    <td>{{ $request->category->name }}</td>
                    <td>{{ $request->description }}</td>
                    <td>
                        <a href="{{ route('admin.help-requests.show', $request->id) }}"
                            class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('admin.help-requests.edit', $request->id) }}"
                            class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.help-requests.destroy', $request) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
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

    <div class="d-flex justify-content-center mt-4">
        {{ $helpRequests->links('pagination::bootstrap-5') }}
    </div>
@endsection
