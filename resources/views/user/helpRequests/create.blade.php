@extends('layouts.app')

@section('content')
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
<div class="mb-3">
    <label for="address_id">Adresse existante</label>
    <select name="address_id" id="address_id" class="form-select">
        <option value="">-- Sélectionner une adresse existante --</option>
        @foreach ($addresses as $address)
            <option value="{{ $address->id }}">
                {{ $address->street }}, {{ $address->city }} {{ $address->postcode }}
            </option>
        @endforeach
    </select>
</div>

<hr>

<h5>Ou créer une nouvelle adresse :</h5>
<div class="mb-3">
    <label for="street">Rue</label>
    <input type="text" name="street" class="form-control">
</div>
<div class="mb-3">
    <label for="city">Ville</label>
    <input type="text" name="city" class="form-control">
</div>
<div class="mb-3">
    <label for="postcode">Code postal</label>
    <input type="text" name="postcode" class="form-control">
</div>



    <button type="submit" class="btn btn-success">Créer</button>
    <a href="{{ route('user.help-requests.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
