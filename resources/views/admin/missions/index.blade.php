@extends('layouts.app')
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

@section('content')
    <x-dashboard-section-title type="titleBlue">
        Missions
    </x-dashboard-section-title>
    <div class="row mb-5">
        <x-dashboard-card title="Retour au dashboard" icon="bi-house-fill"
            iconBgClass="bg-secondary bg-opacity-10 text-secondary" buttonText="Dashboard" :buttonUrl="route('admin.dashboard')"
            buttonClass="secondary" />

    </div>
    <x-dashboard-section-title type="missions">
        Missions disponibles
    </x-dashboard-section-title>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Organisation</th>
                <th>Adresse</th>
                <th>Capacité</th>
                <th>Période</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($missions as $mission)
                <tr>
                    <td>{{ $mission->title }}</td>
                    <td>{{ $mission->organization->name ?? 'N/A' }}</td>
                    <td>{{ $mission->address?->city ?? 'Non renseignée' }}</td>
                    <td>{{ $mission->capacity ?? 'Illimitée' }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($mission->starts_at)->format('d/m/Y') ?? '-' }}
                        {{ \Carbon\Carbon::parse($mission->ends_at)->format('d/m/Y') ?? '-' }}
                    </td>
                    <td>
                        {{-- <a href="{{ route('admin.missions.show', $mission->id) }}" class="btn btn-sm btn-info">Voir</a> --}}
                        {{-- <a href="{{ route('admin.missions.destroy.edit', $mission->id) }}"
                        class="btn btn-sm btn-warning">Modifier</a> --}}
                        <form action="{{ route('admin.missions.destroy', $mission) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Supprimer cette mission ?')">Supprimer</button>
                        </form>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune mission trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $missions->links() }}
@endsection
