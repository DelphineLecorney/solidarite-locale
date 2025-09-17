@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <x-dashboard-card title="Retour au dashboard" icon="bi-house-fill"
        iconBgClass="bg-secondary bg-opacity-10 text-secondary"
        buttonText="Dashboard"
        :buttonUrl="route('admin.dashboard')"
        buttonClass="secondary" />
</div>

<x-dashboard-section-title type="users">
    Liste des utilisateurs
</x-dashboard-section-title>

<x-dashboard-table title="Liste des utilisateurs">
<x-slot name="header">

            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </x-slot>

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
        </x-dashboard-table>
    </div>
@endsection
