@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
        <i class="fas fa-plus-circle"></i> Créer un ticket
    </h2>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Titre --}}
        <div>
            <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
            <input type="text" name="titre" id="titre" 
       class="block w-full rounded-lg border-gray-300 shadow-sm px-4 py-3 text-gray-700 text-base focus:ring-indigo-500 focus:border-indigo-500" 
       value="{{ old('titre') }}" required>

        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="6" 
                      class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                      required>{{ old('description') }}</textarea>
        </div>

        {{-- Articles --}}
        <div>
            <h5 class="text-lg font-semibold text-gray-700 mb-2">Articles demandés</h5>
            <p class="text-sm text-gray-500 mb-4">Indiquez la quantité de chaque article souhaité (laisser à 0 si non nécessaire).</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($articles as $article)
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-start">
                        <h6 class="font-semibold text-gray-800 mb-2">{{ $article->nom }}</h6>
                        <input type="number" name="articles[{{ $article->id }}]" 
                               min="0" value="0" 
                               class="w-full border rounded-lg px-3 py-2 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="Quantité">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3 mt-6">
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition">
                <i class="fas fa-paper-plane me-2"></i> Soumettre
            </button>
            <a href="{{ route('tickets.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg shadow transition">
                <i class="fas fa-times me-2"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection
