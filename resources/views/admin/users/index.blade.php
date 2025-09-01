@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👥 Gestion des Utilisateurs</h1>
        <a href="{{ route('admin.users.create') }}" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
           + Ajouter
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-3 border-b">Nom</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b">Rôle</th>
                    <th class="px-6 py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm rounded-full
                            @if($user->role === 'admin') bg-red-100 text-red-600 
                            @elseif($user->role === 'agent') bg-blue-100 text-blue-600 
                            @else bg-gray-100 text-gray-600 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-3">
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="text-yellow-600 hover:text-yellow-800 font-medium">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                              class="inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium">
                                    Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
