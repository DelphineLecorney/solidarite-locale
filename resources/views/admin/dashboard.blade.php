@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tableau de bord Admin</h1>

    <div class="row mb-5">

        <x-dashboard-card
            title="Utilisateurs"
            :count="$usersCount ?? 0"
            icon="bi-people-fill"
            iconBgClass="bg-primary bg-opacity-10 text-primary"
            buttonText="Gérer"
            :buttonUrl="route('admin.user')"
            buttonClass="primary"
            buttonIcon="bi-gear-fill"
        />

        <x-dashboard-card
            title="Demandes d’aide"
            :count="$requestsCount ?? 0"
            icon="bi-cart-fill"
            iconBgClass="bg-success bg-opacity-10 text-success"
            buttonText="Gérer"
            :buttonUrl="route('admin.help-requests.index')"
            buttonClass="success"
            buttonIcon="bi-gear-fill"
        />

        <x-dashboard-card
            title="Missions"
            :count="$missionsCount ?? 0"
            icon="bi-list-check"
            iconBgClass="bg-warning bg-opacity-10 text-warning"
            buttonText="Gérer"
            :buttonUrl="route('admin.missions')"
            buttonClass="warning"
            buttonIcon="bi-briefcase-fill"
        />

        <x-dashboard-card
            title="Autres"
            :count="$othersCount ?? 0"
            icon="bi-box-arrow-right"
            iconBgClass="bg-danger bg-opacity-10 text-danger"
        />
    </div>

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
                    <td colspan="9" class="text-center">Aucune demande pour le moment</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $helpRequests->links('pagination::bootstrap-5') }}
    </div>
@endsection
