@extends('layouts.app')

@section('content')
@section('content')

<div class="row mb-5">
    <x-dashboard-card title="Retour au dashboard" icon="bi-house-fill"
        iconBgClass="bg-secondary bg-opacity-10 text-secondary"
        buttonText="Dashboard"
        :buttonUrl="route('user.dashboard')"
        buttonClass="secondary" />

    <x-dashboard-card title="Créer une demande" icon="bi-plus-circle-fill"
        iconBgClass="bg-success bg-opacity-10 text-success"
        buttonText="Créer"
        :buttonUrl="route('user.help-requests.create')"
        buttonClass="success" />

    @if($acceptedRequests->isNotEmpty())
        <x-dashboard-card title="Mes demandes acceptées"
            :count="$acceptedRequests->count()"
            icon="bi-check2-circle"
            iconBgClass="bg-primary bg-opacity-10 text-primary"
            buttonText="Voir"
            buttonUrl="#accepted-requests"
            buttonClass="primary" />
    @endif
</div>

<div class="container">
<x-dashboard-section-title type="blueRequests">
   Mes demandes d'aide
</x-dashboard-section-title>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <x-dashboard-table title="Mes demandes d'aide">
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
                        $badgeClass = match($helpRequest->status) {
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
                    {{ $helpRequest->address?->postcode ?? '' }}
                    {{ $helpRequest->address?->city ?? '' }}
                </td>
                <td>{{ $helpRequest->category->name }}</td>
                <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                <td>
                    <a href="{{ route('user.help-requests.show', $helpRequest) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('user.help-requests.edit', $helpRequest) }}" class="btn btn-warning btn-sm">Modifier</a>
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
</div>

@if($acceptedRequests->isNotEmpty())
    <div class="container mt-5" id="accepted-requests">
<x-dashboard-section-title type="greenRequests">
   Mes demandes acceptées
</x-dashboard-section-title>

        <x-dashboard-table title="Mes demandes acceptées">
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

            @forelse($acceptedRequests as $acceptedRequest)
                <tr>
                    <td>{{ $acceptedRequest->created_at->format('d/m/Y') }}</td>
                    <td>{{ $acceptedRequest->title }}</td>
                    <td>
                        @php
                            $badgeClass = match($acceptedRequest->status) {
                                'pending' => 'bg-warning text-dark',
                                'accepted' => 'bg-primary',
                                'done' => 'bg-success',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($acceptedRequest->status) }}</span>
                    </td>
                    <td>{{ $acceptedRequest->user->name ?? 'N/A' }}</td>
                    <td>{{ $acceptedRequest->address?->street ?? 'Adresse non renseignée' }},
                        {{ $acceptedRequest->address?->postcode ?? '' }}
                        {{ $acceptedRequest->address?->city ?? '' }}
                    </td>
                    <td>{{ $acceptedRequest->category->name ?? 'N/A' }}</td>
                    <td>{{ Str::limit($acceptedRequest->description, 50) }}</td>
                    <td>
                        <a href="{{ route('user.help-requests.show', $acceptedRequest) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('user.help-requests.edit', $acceptedRequest) }}" class="btn btn-warning btn-sm">Modifier</a>

                        @if($acceptedRequest->status === 'accepted' && $acceptedRequest->accepted_by_user_id === auth()->id())
                            <form action="{{ route('user.help-requests.done', $acceptedRequest->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Marquer cette demande comme terminée ?')">Terminer</button>
                            </form>
                        @endif

                        <form action="{{ route('user.help-requests.destroy', $acceptedRequest) }}" method="POST" class="d-inline">
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
        </x-dashboard-table>
    </div>
@endif

@endsection
