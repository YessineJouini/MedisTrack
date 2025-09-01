@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
        <i class="fas fa-plus"></i> Ajouter un Article
    </h1>

    <form action="{{ route('admin.stock.store') }}" method="POST" class="space-y-4 bg-white shadow-md rounded-xl p-6">
        @csrf

        <div>
            <label for="nom" class="block text-gray-700 font-medium mb-1">Nom de l'article</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                   class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

       <div>
    <label for="min_stock" class="block text-gray-700 font-medium mb-1">Stock min </label>
    <input type="number" name="min_stock" id="min_stock" min="0" value="{{ old('min_stock', 0) }}"
           class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
           required>
</div>
<div>
    <label for="prix" class="block text-gray-700 font-medium mb-1">Prix</label>
    <input type="number" step="0.01" name="prix" id="prix" value="{{ old('prix') }}"
           class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
           required>
</div>



     

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg px-4 py-2 shadow transition flex items-center gap-2">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <a href="{{ route('stock.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-medium rounded-lg px-4 py-2 shadow transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </form>
</div>
@endsection
