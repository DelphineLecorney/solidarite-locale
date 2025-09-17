@extends('layouts.app')

@section('content')

<x-dashboard-section-title type="titleBlue">
    Création de demandes d'aide
</x-dashboard-section-title>
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

        <div class="mb-3">
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <h5>Adresse :</h5>
        <div class="mb-3">
            <label for="street">Rue</label>
            <input type="text" name="street" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="city">Ville</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="postcode">Code postal</label>
            <input type="text" name="postcode" class="form-control" required pattern="^[0-9]{4}$"
                title="Le code postal doit contenir 4 chiffres">
        </div>


        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('user.help-requests.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
