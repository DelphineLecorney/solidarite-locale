@extends('layouts.app')

@section('content')
<h1 class="mb-4">Tableau de bord</h1>

<div class="row mb-5">
    <!-- Mes demandes -->
<div class="col-md-4">
    <div class="card shadow-sm mb-3 border-0">
        <div class="card-body d-flex align-items-center">
            <i class="bi bi-gear-fill fs-1 text-success me-3"></i>
            <div>
                <h5 class="card-title">Gérer mes demandes</h5>
                <p class="card-text fs-2">{{ $myRequestsCount ?? 0 }}</p>
                <a href="{{ route('user.help-requests.index') }}" class="btn btn-sm btn-outline-success mt-2">
                    Gérer
                </a>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Tableau principal -->
<h2 class="mb-3">Toutes les demandes d’aide</h2>

<table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Utilisateur</th>
            <th>Catégorie</th>
            <th>Description</th>
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
                <td>{{ $request->description}}</td>
                <td>
                    {{ $request->address?->street ?? 'Adresse non renseignée' }},
                    {{ $request->address?->postcode ?? '' }}
                    {{ $request->address?->city ?? '' }}
                </td>
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

                    @if($request->user_id === auth()->id())
                        <a href="{{ route('user.help-requests.edit', $request->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('user.help-requests.destroy', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                        </form>
                    @elseif($request->status === 'pending')
                        <form action="{{ route('user.help-requests.accept', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Accepter cette demande ?')">Accepter</button>
                        </form>
                                            <form action="{{ route('user.help-requests.done', $request->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Marquer comme terminée ?')">
                            Terminer
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">Aucune demande pour le moment</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $helpRequests->links('pagination::bootstrap-5') }}
</div>
@endsection
