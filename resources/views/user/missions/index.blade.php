@extends('layouts.app')
@if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

@section('content')
    <!-- Mes participations -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-check2-circle fs-1 text-primary me-3"></i>
                <div>
                    <h5 class="card-title">Mes participations</h5>
                    <p class="card-text fs-2">{{ $myParticipationsCount ?? 0 }}</p>
                    <a href="{{ route('user.missions.my-participations') }}" class="btn btn-sm btn-outline-primary mt-2">
                        Voir
                    </a>
                </div>
            </div>
        </div>
    </div>

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
