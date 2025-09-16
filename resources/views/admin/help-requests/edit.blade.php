@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la demande</h1>

        <form action="{{ route('admin.help-requests.update', $helpRequest) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control" value="{{ $helpRequest->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $helpRequest->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('admin.help-requests.index') }}" class="btn btn-secondary">Annuler</a>
        </form>

        <form action="{{ route('admin.help-requests.destroy', $helpRequest) }}" method="POST" class="d-inline mt-2"
            onsubmit="return confirm('Voulez-vous vraiment supprimer cette demande ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@endsection
