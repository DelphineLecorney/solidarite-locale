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

    <button type="submit" class="btn btn-success">Créer</button>
    <a href="{{ route('user.help-requests.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
