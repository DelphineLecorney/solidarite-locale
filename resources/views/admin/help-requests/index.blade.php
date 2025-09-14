@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-house-fill fs-1 text-secondary me-3"></i>
                <div>
                    <h5 class="card-title">Retour au dashboard</h5>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary mt-2">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <h1>Demandes d’aide</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
    </table>
</div>
@endsection
