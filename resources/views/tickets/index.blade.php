@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-ticket-alt"></i> Mes tickets
            </h2>
            <a href="{{ route('tickets.create') }}" class="mt-3 md:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm transition">
                <i class="fas fa-plus me-2"></i> Nouveau ticket
            </a>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-green-800 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Tickets Table -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @php
                            function sort_link($column, $label) {
                                $currentSort = request()->get('sort_by');
                                $currentOrder = request()->get('order', 'desc');
                                $order = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
                                $query = array_merge(request()->query(), ['sort_by' => $column, 'order' => $order]);
                                $url = request()->url() . '?' . http_build_query($query);
                                $indicator = '';
                                if ($currentSort === $column) {
                                    $indicator = $currentOrder === 'asc' ? ' <i class=\'fas fa-caret-up\'></i>' : ' <i class=\'fas fa-caret-down\'></i>';
                                }
                                return '<a href="' . e($url) . '" class="hover:text-indigo-600 font-medium">' . e($label) . '</a>' . $indicator;
                            }
                        @endphp
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{!! sort_link('titre', 'Titre') !!}</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{!! sort_link('status', 'Status') !!}</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">{!! sort_link('created_at', 'Créé le') !!}</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $ticket->titre }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'en_cours' => 'bg-indigo-100 text-indigo-800',
                                        'en_attente' => 'bg-yellow-100 text-yellow-800',
                                        'affectue' => 'bg-green-100 text-green-800',
                                        'annule' => 'bg-red-100 text-red-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $ticket->created_at->format('d M Y - H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('tickets.show', $ticket->id) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-sm shadow-sm transition">
                                    <i class="fas fa-eye me-1"></i> Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-400">
                                <i class="fas fa-inbox text-3xl mb-2"></i>
                                <p>Vous n'avez pas encore de tickets.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
