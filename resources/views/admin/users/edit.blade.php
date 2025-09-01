@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Modifier Utilisateur</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
        @csrf 
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" value="{{ $user->name }}" 
                   class="border rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" 
                   class="border rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe 
                <span class="text-gray-400 text-xs">(laisser vide si inchangé)</span>
            </label>
            <input type="password" name="password" 
                   class="border rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Confirmer Mot de passe</label>
            <input type="password" name="password_confirmation" 
                   class="border rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Rôle</label>
            <select name="role" class="border rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                <option value="admin" @if($user->role=="admin") selected @endif>Admin</option>
                <option value="agent" @if($user->role=="agent") selected @endif>Agent</option>
                <option value="demandeur" @if($user->role=="demandeur") selected @endif>Demandeur</option>
            </select>
        </div>

        <button class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition">
            ✅ Mettre à jour
        </button>
    </form>
</div>
@endsection
