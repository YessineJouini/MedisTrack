@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
        <i class="fas fa-boxes"></i> Stock
    </h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search form --}}
    <form method="get" class="flex flex-col sm:flex-row gap-2 mb-4">
        <input type="text" name="q" value="{{ request('q') }}" 
               class="flex-1 rounded-lg border-gray-300 shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" 
               placeholder="Rechercher un article...">
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2 shadow transition">
            Rechercher
        </button>
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @php
                        $currentSort = request()->get('sort_by');
                        $currentOrder = request()->get('order', 'asc');

                        function sort_link($column, $label) {
                            $currentSort = request()->get('sort_by');
                            $currentOrder = request()->get('order', 'asc');
                            $order = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
                            $query = array_merge(request()->query(), ['sort_by' => $column, 'order' => $order]);
                            $url = request()->url() . '?' . http_build_query($query);
                            $indicator = '';
                            if ($currentSort === $column) {
                                $indicator = $currentOrder === 'asc' ? ' ▲' : ' ▼';
                            }
                            return '<a href="' . e($url) . '" class="hover:underline">' . e($label) . '</a>' . $indicator;
                        }
                    @endphp
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('nom', 'Article') !!}</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('quantite', 'Quantité') !!}</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('prix', 'Prix') !!}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-gray-700">{{ $article->nom }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $article->quantite }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ number_format($article->prix, 2, ',', ' ') }} €</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
