@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Mon Tableau de bord</h1>
    <div class="row mb-5">
        <!-- Retour au dashboard -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-house-fill fs-1 text-secondary me-3"></i>
                    <div>
                        <h5 class="card-title">Retour au dashboard</h5>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-outline-secondary mt-2">
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Créer une demande -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-plus-circle-fill fs-1 text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Créer une demande</h5>
                        <a href="{{ route('user.help-requests.create') }}" class="btn btn-sm btn-outline-success mt-2">
                            Créer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mes demandes acceptées -->
        @if ($acceptedRequests->isNotEmpty())
            <div class="col-md-4">
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-check2-circle fs-1 text-primary me-3"></i>
                        <div>
                            <h5 class="card-title">Mes demandes acceptées</h5>
                            <p class="card-text fs-2">{{ $acceptedRequests->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Mes demandes --}}
    <div class="container">
        <h1>Mes demandes d'aide</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="date-col">Date</th>
                    <th class="title-col">Titre</th>
                    <th class="status-col">Statut</th>
                    <th class="user-col">Utilisateur</th>
                    <th class="address-col">Adresse</th>
                    <th class="category-col">Catégorie</th>
                    <th class="desc-col">Description</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($helpRequests as $helpRequest)
                    <tr>
                        <td>{{ $helpRequest->created_at->format('d/m/Y') }}</td>
                        <td>{{ $helpRequest->title }}</td>
                        <td>
                            @php
                                $badgeClass = match ($helpRequest->status) {
                                    'pending' => 'bg-warning text-dark',
                                    'accepted' => 'bg-success',
                                    'done' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($helpRequest->status) }}</span>
                        </td>
                        <td>{{ $helpRequest->user->name ?? 'N/A' }}</td>
                        <td>
                            {{ $helpRequest->address?->street ?? 'Adresse non renseignée' }},
                            {{ $helpRequest->address?->postcode ?? '' }}
                            {{ $helpRequest->address?->city ?? '' }}
                        </td>
                        <td>{{ $helpRequest->category->name }}</td>
                        <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                        <td>
                            <a href="{{ route('user.help-requests.show', $helpRequest) }}"
                                class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('user.help-requests.edit', $helpRequest) }}"
                                class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('user.help-requests.destroy', $helpRequest) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mes demandes acceptées --}}
    <div class="container mt-5">
        <h1>Mes demandes acceptées</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="date-col">Date</th>
                    <th class="title-col">Titre</th>
                    <th class="status-col">Statut</th>
                    <th class="user-col">Utilisateur</th>
                    <th class="address-col">Adresse</th>
                    <th class="category-col">Catégorie</th>
                    <th class="desc-col">Description</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($acceptedRequests as $acceptedRequest)
                    <tr>
                        <td>{{ $acceptedRequest->created_at->format('d/m/Y') }}</td>
                        <td>{{ $acceptedRequest->title }}</td>
                        <td>
                            @php
                                $badgeClass = match ($acceptedRequest->status) {
                                    'pending' => 'bg-warning text-dark',
                                    'accepted' => 'bg-primary',
                                    'done' => 'bg-success',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($acceptedRequest->status) }}</span>
                        </td>
                        <td>{{ $acceptedRequest->user->name ?? 'N/A' }}</td>
                        <td>
                            {{ $acceptedRequest->address?->street ?? 'Adresse non renseignée' }},
                            {{ $acceptedRequest->address?->postcode ?? '' }}
                            {{ $acceptedRequest->address?->city ?? '' }}
                        </td>
                        <td>{{ $acceptedRequest->category->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($acceptedRequest->description, 50) }}</td>
                        <td>
                            <a href="{{ route('user.help-requests.show', $acceptedRequest) }}"
                                class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('user.help-requests.edit', $acceptedRequest) }}"
                                class="btn btn-warning btn-sm">Modifier</a>

                            @if ($acceptedRequest->status === 'accepted' && $acceptedRequest->accepted_by_user_id === auth()->id())
                                <form action="{{ route('user.help-requests.done', $acceptedRequest->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"
                                        onclick="return confirm('Marquer cette demande comme terminée ?')">
                                        Terminer
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('user.help-requests.destroy', $acceptedRequest) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune demande acceptée trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
