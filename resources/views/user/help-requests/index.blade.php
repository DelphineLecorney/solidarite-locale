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
    @if($acceptedRequests->isNotEmpty())
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

<div class="container">
    <h1>Mes demandes d'aide</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpRequests as $helpRequest)
                <tr>
                    <td>{{ $helpRequest->title }}</td>
                    <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                    <td>{{ ucfirst($helpRequest->status) }}</td>
                    <td>
                        <a href="{{ route('user.help-requests.show', $helpRequest) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('user.help-requests.edit', $helpRequest) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('user.help-requests.destroy', $helpRequest) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune demande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="container">
    <h1>Mes demandes acceptées</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($acceptedRequests as $acceptedRequest)
                <tr>
                    <td>{{ $acceptedRequest->title }}</td>
                    <td>{{ Str::limit($acceptedRequest->description, 50) }}</td>
                    <td>{{ ucfirst($acceptedRequest->status) }}</td>
                    <td>
                        <a href="{{ route('user.help-requests.show', $acceptedRequest) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('user.help-requests.edit', $acceptedRequest) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('user.help-requests.destroy', $acceptedRequest) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune demande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
