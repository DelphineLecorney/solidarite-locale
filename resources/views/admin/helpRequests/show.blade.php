@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $helpRequest->title }}</h1>
    <p>{{ $helpRequest->description }}</p>
    <p><strong>Utilisateur :</strong> {{ $helpRequest->user->name ?? 'N/A' }}</p>

    <a href="{{ route('admin.help-requests.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
