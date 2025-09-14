@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $helpRequest->title }}</h1>
    <p>{{ $helpRequest->description }}</p>

    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Retour</a>
</div>

@endsection
