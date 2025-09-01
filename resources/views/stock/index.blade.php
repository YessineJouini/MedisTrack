@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-boxes"></i> Gestion du Stock
        </h1>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search form -->
    <form method="get" class="flex flex-col sm:flex-row gap-2 mb-4">
        <input type="text" name="q" value="{{ request('q') }}" 
               class="flex-1 rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" 
               placeholder="Rechercher un article...">
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition">
            <i class="fas fa-search mr-1"></i> Rechercher
        </button>
    </form>

    <!-- Table Card -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-3 border-b">
                        <a href="{{ route('admin.stock.index', [
                            'sort_by' => 'nom',
                            'order' => request('order') === 'asc' && request('sort_by') === 'nom' ? 'desc' : 'asc',
                            'q' => request('q')
                        ]) }}" class="flex items-center gap-1">
                            Article
                            @if(request('sort_by') === 'nom')
                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-3 border-b">
                        <a href="{{ route('admin.stock.index', [
                            'sort_by' => 'quantite',
                            'order' => request('order') === 'asc' && request('sort_by') === 'quantite' ? 'desc' : 'asc',
                            'q' => request('q')
                        ]) }}" class="flex items-center gap-1">
                            Quantité
                            @if(request('sort_by') === 'quantite')
                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-3 border-b">Stock minimum</th>

                    <th class="px-6 py-3 border-b">
                        <a href="{{ route('admin.stock.index', [
                            'sort_by' => 'prix',
                            'order' => request('order') === 'asc' && request('sort_by') === 'prix' ? 'desc' : 'asc',
                            'q' => request('q')
                        ]) }}" class="flex items-center gap-1">
                            Prix
                            @if(request('sort_by') === 'prix')
                                <i class="fas fa-sort-{{ request('order') === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>

                    <th class="px-6 py-3 border-b">Statut</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($articles as $article)
                    @php $lowStock = $article->quantite < $article->min_stock; @endphp
                    <tr class="hover:bg-gray-50 @if($lowStock) bg-red-50 @endif transition">
                        <td class="px-6 py-4 text-gray-700">{{ $article->nom }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $article->quantite }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $article->min_stock }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ number_format($article->prix, 2, ',', ' ') }} €</td>
                        <td class="px-6 py-4">
                            @if($lowStock)
                                <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Stock bas
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                    <i class="fas fa-check mr-1"></i> OK
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-500">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
