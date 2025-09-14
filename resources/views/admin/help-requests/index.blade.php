@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Demandes d’aide</h1>

    <a href="{{ route('admin.help-requests.create') }}" class="btn btn-primary mb-3">Nouvelle demande</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpRequests as $helpRequest)
                <tr>
                    <td>{{ $helpRequest->title }}</td>
                    <td>{{ Str::limit($helpRequest->description, 50) }}</td>
                    <td>{{ $helpRequest->user->name ?? 'N/A' }}</td>
                    <td>
                        <!-- Voir -->
                        <a href="{{ route('admin.help-requests.show', $helpRequest) }}" class="btn btn-info btn-sm">Voir</a>

                        <!-- Modifier -->
                        <a href="{{ route('admin.help-requests.edit', $helpRequest) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Supprimer -->
                        <form action="{{ route('admin.help-requests.destroy', $helpRequest) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Voulez-vous vraiment supprimer cette demande ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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
