@extends('layouts.app')

@section('content')

        <x-dashboard-card title="Retour au dashboard" icon="bi-house-fill"
            iconBgClass="bg-secondary bg-opacity-10 text-secondary" buttonText="Dashboard" :buttonUrl="route('user.dashboard')"
            buttonClass="secondary" />
    <div class="container mt-5">
<x-dashboard-section-title type="participations">
    Mes participations aux missions
</x-dashboard-section-title>
        <h1 class="mb-4"></h1>


        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre de la mission</th>
                    <th>Organisation</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participations as $participation)
                    <tr>
                        <td>{{ $participation->mission->title }}</td>
                        <td>{{ $participation->mission->organization->name ?? 'N/A' }}</td>
                        <td>
                            <span
                                class="badge
                            @if ($participation->status === 'pending') bg-warning text-dark
                            @elseif($participation->status === 'confirmed') bg-success
                            @elseif($participation->status === 'cancelled') bg-danger
                            @else bg-secondary @endif
                        ">
                                {{ ucfirst($participation->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Vous n'avez encore participé à aucune mission.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
