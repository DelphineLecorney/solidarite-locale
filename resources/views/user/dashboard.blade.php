@extends('layouts.app')

@section('content')
    <x-dashboard-section-title type="dashboard">
        Dashboard
    </x-dashboard-section-title>

    <div class="row mb-5">
        <x-dashboard-card title="Mes demandes" :count="$myRequestsCount" icon="bi-gear-fill"
            iconBgClass="bg-success bg-opacity-10 text-success" buttonText="Gérer" :buttonUrl="route('user.help-requests.index')" buttonClass="success" />

        <x-dashboard-card title="Missions disponibles" :count="$missionsCount" icon="bi-briefcase-fill"
            iconBgClass="bg-info bg-opacity-10 text-info" buttonText="Voir" :buttonUrl="route('user.missions.index')" buttonClass="info" />

        <x-dashboard-card title="Mes participations" :count="$myParticipationsCount" icon="bi-check2-circle"
            iconBgClass="bg-primary bg-opacity-10 text-primary" buttonText="Voir" :buttonUrl="route('user.missions.my-participations')" buttonClass="primary" />
    </div>


    <x-dashboard-section-title type="requests">
        Demandes d'aide
    </x-dashboard-section-title>
    <x-dashboard-table title="Demandes d'aide">
        <x-slot name="header">
            <tr>
                <th>Date</th>
                <th>Titre</th>
                <th>Statut</th>
                <th>Utilisateur</th>
                <th>Adresse</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </x-slot>

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
                <td>{{ $helpRequest->address?->street ?? 'Adresse non renseignée' }},
                    {{ $helpRequest->address?->postcode ?? '' }} {{ $helpRequest->address?->city ?? '' }}</td>
                <td>{{ $helpRequest->category->name }}</td>
                <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                <td>
                    <a href="{{ route('user.help-requests.show', $helpRequest) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('user.help-requests.index') }}" class="btn btn-success btn-sm">Accepter</a>
                    <a href="{{ route('user.help-requests.edit', $helpRequest) }}"
                        class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('user.help-requests.destroy', $helpRequest) }}" method="POST" class="d-inline">
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
    </x-dashboard-table>

    <div class="d-flex justify-content-center mt-4">
        {{ $helpRequests->links('pagination::bootstrap-5') }}
    </div>
@endsection
