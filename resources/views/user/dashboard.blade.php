@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tableau de bord Utilisateur</h1>

    <!-- Cartes statistiques -->
    <div class="row mb-5">
        <!-- Mes demandes d’aide -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-cart-fill fs-1 text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Mes demandes d’aide</h5>
                        <p class="card-text fs-2">{{ $helpRequestsCount ?? 0 }}</p>
                        <a href="{{ route('user.help-requests.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Voir mes demandes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Autres blocs pour user -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-list-check fs-1 text-warning me-3"></i>
                    <div>
                        <h5 class="card-title">Autres informations</h5>
                        <p class="card-text fs-2">{{ $othersCount ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des demandes -->
    <h2 class="mb-3">Mes demandes récentes</h2>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Titre</th>
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
                    <td>{{ $request->category->name }}</td>
                    <td>{{ $request->address->street }}, {{ $request->address->city }}</td>
                    <td>{{ $request->created_at->format('d/m/Y') }}</td>
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
                    <td>
                        <a href="{{ route('user.help-requests.show', $request->id) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('user.help-requests.edit', $request->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('user.help-requests.destroy', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune demande pour le moment</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $helpRequests->links('pagination::bootstrap-5') }}
    </div>
@endsection
