@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Nouvelle Facture</h1>

    <form action="{{ route('admin.factures.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="id" class="block text-gray-700 font-medium">Référence (ID)</label>
            <input id="id" type="text" name="id" value="{{ old('id') }}" 
                   class="border px-3 py-2 rounded-lg w-full" placeholder="Ex: FAC-001">
            @error('id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="article_id" class="block text-gray-700 font-medium">Article</label>
            <select id="article_id" name="article_id" class="border px-3 py-2 rounded-lg w-full">
                <option value="">-- Choisir un article --</option>
                @foreach($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->nom }} ({{ $article->quantite }} en stock)</option>
                @endforeach
            </select>
            @error('article_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantite" class="block text-gray-700 font-medium">Quantité à ajouter</label>
            <input id="quantite" type="number" name="quantite" value="{{ old('quantite') }}" 
                   class="border px-3 py-2 rounded-lg w-full" min="1">
            @error('quantite')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="montant" class="block text-gray-700 font-medium">Montant (en DT)</label>
            <input id="montant" type="number" name="montant" value="{{ old('montant') }}"
                   class="border px-3 py-2 rounded-lg w-full" min="0" step="0.01" placeholder="Ex: 150.00">
            @error('montant')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            Ajouter
        </button>
    </form>
</div>
@endsection
