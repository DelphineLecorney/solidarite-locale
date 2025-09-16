@extends('layouts.app')

@section('content')
    <div class="col-md-4">
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-house-fill fs-1 text-secondary me-3"></i>
                <div>
                    <h5 class="card-title">Retour au dashboard</h5>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary mt-2">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <h1>Liste des utilisateurs</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
