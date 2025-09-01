@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Factures</h1>

    <a href="{{ route('admin.factures.create') }}" 
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow mb-4 inline-block">
       Ajouter une facture
    </a>

    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Article</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantité ajoutée</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($factures as $facture)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $facture->id }}</td>
                        <td class="px-4 py-2">{{ $facture->article->nom }}</td>
                        <td class="px-4 py-2">{{ $facture->quantite }}</td>
                        <td class="px-4 py-2">{{ $facture->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.factures.edit', $facture) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                               Modifier
                            </a>
                            <form action="{{ route('admin.factures.destroy', $facture) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Aucune facture trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
