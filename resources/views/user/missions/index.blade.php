@extends('layouts.app')
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

@section('content')
    <x-dashboard-card title="Mes participations" :count="$myParticipationsCount" icon="bi-check2-circle"
        iconBgClass="bg-primary bg-opacity-10 text-primary" buttonText="Voir" :buttonUrl="route('user.missions.my-participations')" buttonClass="primary" />

    <h1 class="mb-4">Missions disponibles</h1>
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
                        <form action="{{ route('user.missions.participate', $mission) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Participer</button>
                        </form>
                    </td>
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
