@extends('layouts.app   ')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Modifier Facture</h1>

    <form action="{{ route('admin.factures.update', $facture) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium">Article</label>
            <select name="article_id" class="border px-3 py-2 rounded-lg w-full">
                @foreach($articles as $article)
                    <option value="{{ $article->id }}" 
                        @if($article->id == $facture->article_id) selected @endif>
                        {{ $article->nom }} ({{ $article->quantite }} en stock)
                    </option>
                @endforeach
            </select>
            @error('article_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Quantité</label>
            <input type="number" name="quantite" value="{{ old('quantite', $facture->quantite) }}" 
                   class="border px-3 py-2 rounded-lg w-full" min="1">
            @error('quantite')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
