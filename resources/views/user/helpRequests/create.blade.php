@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une demande d'aide</h1>

    <form action="{{ route('user.help-requests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('user.help-requests.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
