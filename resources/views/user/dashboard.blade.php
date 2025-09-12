@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Mon Tableau de bord</h1>

    <!-- Cartes statistiques -->
    <div class="row mb-5">
        <!-- Mes demandes -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-cart-fill fs-1 text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Mes demandes</h5>
                        <p class="card-text fs-2">{{ $myRequestsCount ?? 0 }}</p>
                        <a href="{{ route('user.help-requests.create') }}" class="btn btn-sm btn-outline-success mt-2">
                            Créer une demande
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des demandes -->
    <h2 class="mb-3">Toutes les demandes d’aide</h2>

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
    {{ $request->address?->street ?? 'Adresse non renseignée' }},
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
                        <!-- Voir -->
                        <a href="{{ route('user.help-requests.show', $request->id) }}" class="btn btn-sm btn-info">Voir</a>

                        @if($request->user_id === auth()->id())
                            <!-- Modifier / Supprimer si c'est sa demande -->
                            <a href="{{ route('user.help-requests.edit', $request->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('user.help-requests.destroy', $request->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                            </form>
                        @elseif($request->status === 'pending')
                            <!-- Accepter si c'est une demande d’un autre -->
                            <form action="{{ route('user.help-requests.update', $request->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button class="btn btn-sm btn-success" onclick="return confirm('Accepter cette demande ?')">Accepter</button>
                            </form>
                        @endif
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
