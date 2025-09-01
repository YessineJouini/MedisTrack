@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="max-w-5xl mx-auto px-4 py-2 mb-4 bg-green-100 text-green-800 rounded-lg shadow">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-5xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
        <i class="fas fa-ticket-alt"></i> Tous les tickets
    </h2>

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @php
                            $currentSort = request()->get('sort_by');
                            $currentOrder = request()->get('order', 'desc');

                            function sort_link($column, $label) {
                                $currentSort = request()->get('sort_by');
                                $currentOrder = request()->get('order', 'desc');
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
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('id', 'ID') !!}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('titre', 'Titre') !!}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{!! sort_link('status', 'Status') !!}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Demandeur</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $excludedStatuses = ['affectue', 'annule', 'annuler'];
                        $visibleTickets = is_iterable($tickets) ? collect($tickets)->filter(fn($t) => !in_array($t->status, $excludedStatuses)) : collect();

                        $statusColors = [
                            'en_cours' => 'bg-indigo-100 text-indigo-800',
                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                            'affectue' => 'bg-green-100 text-green-800',
                            'annule' => 'bg-red-100 text-red-800'
                        ];
                    @endphp

                    @forelse($visibleTickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $ticket->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $ticket->titre }}</td>
                            <td class="px-4 py-2 text-sm">
                                <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $ticket->user->name }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('agent.show', $ticket->id) }}" 
                                   class="inline-flex items-center px-4 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">
                                   <i class="fas fa-eye me-1"></i> Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Aucun ticket trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
