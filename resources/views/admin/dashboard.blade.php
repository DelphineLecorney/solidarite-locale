@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Dashboard Admin</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Utilisateurs</h5>
                <p>{{ $userCount }}</p>
                <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">Voir les utilisateurs</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Missions</h5>
                <p>{{ $missionCount }}</p>
                <a href="{{ route('admin.missions') }}" class="btn btn-primary btn-sm">Voir les missions</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Demandes d'aide</h5>
                <p>{{ $helpRequestCount }}</p>
                <a href="{{ route('admin.helpRequests') }}" class="btn btn-primary btn-sm">Voir les demandes</a>
            </div>
        </div>
    </div>
</div>
@endsection
