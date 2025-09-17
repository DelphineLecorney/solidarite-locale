@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-5">
        <x-dashboard-card title="Retour au dashboard" icon="bi-house-fill"
            iconBgClass="bg-secondary bg-opacity-10 text-secondary" buttonText="Dashboard" :buttonUrl="route('admin.dashboard')"
            buttonClass="secondary" />
    </div>
    <x-dashboard-section-title type="requests">
        Demandes d'aide
    </x-dashboard-section-title>
    <x-dashboard-table title="Demandes d'aide">
        <x-slot name="header">
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
        </x-slot>
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
                    <a href="{{ route('admin.help-requests.show', $request->id) }}" class="btn btn-sm btn-info">Voir</a>
                    <a href="{{ route('admin.help-requests.edit', $request->id) }}"
                        class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('admin.help-requests.destroy', $request) }}" method="POST" class="d-inline">
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
    </x-dashboard-table>
    </div>
@endsection
