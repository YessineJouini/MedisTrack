@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-blue-600 mb-6 flex items-center gap-2">
        <i class="fas fa-edit"></i> Modifier l'Article
    </h1>

<form action="{{ route('admin.stock.update', $article->id) }}" method="POST">
    @csrf
    @method('PUT')

        <div>
            <label for="nom" class="block text-gray-700 font-medium mb-1">Nom de l'article</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $article->nom) }}"
                   class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label for="quantite" class="block text-gray-700 font-medium mb-1">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="0" value="{{ old('quantite', $article->quantite) }}"
                   class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label for="prix" class="block text-gray-700 font-medium mb-1">Prix (€)</label>
            <input type="number" name="prix" id="prix" step="0.01" min="0" value="{{ old('prix', $article->prix) }}"
                   class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-4 py-2 shadow transition flex items-center gap-2">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
            <a href="{{ route('admin.stock.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-medium rounded-lg px-4 py-2 shadow transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </form>
</div>
@endsection
