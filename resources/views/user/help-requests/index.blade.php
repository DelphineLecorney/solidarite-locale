@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes demandes d'aide</h1>

    <a href="{{ route('user.help-requests.create') }}" class="btn btn-primary mb-3">Nouvelle demande</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpRequests as $helpRequest)
                <tr>
                    <td>{{ $helpRequest->title }}</td>
                    <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                    <td>{{ ucfirst($helpRequest->status) }}</td>
                    <td>
                        <a href="{{ route('user.help-requests.show', $helpRequest) }}"
                            class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('user.help-requests.edit', $helpRequest) }}"
                            class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('user.help-requests.destroy', $helpRequest) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune demande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
