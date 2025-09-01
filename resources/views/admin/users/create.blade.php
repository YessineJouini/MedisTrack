@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-user-plus text-blue-500"></i> Ajouter un Utilisateur
        </h1>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom</label>
                <input type="text" name="name" 
                    class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" 
                    class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input type="password" name="password" 
                    class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Confirmer Mot de passe</label>
                <input type="password" name="password_confirmation" 
                    class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Rôle</label>
                <select name="role" 
                    class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    required>
                    <option value="admin">Admin</option>
                    <option value="agent">Agent</option>
                    <option value="demandeur">Demandeur</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                   Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
