@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <!-- Card header -->
        <div class="bg-indigo-600 text-white px-6 py-4">
            <h3 class="text-xl font-semibold">{{ $ticket->titre }}</h3>
        </div>

        <!-- Card body -->
        <div class="px-6 py-6 space-y-4">
            <!-- Description -->
            <div>
                <p class="font-semibold">Description:</p>
                <p class="text-gray-700">{{ $ticket->description }}</p>
            </div>

            <!-- Ticket info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <p class="font-semibold">Status: 
                        @php
                            $statusColors = [
                                'en_cours' => 'bg-indigo-100 text-indigo-800',
                                'en_attente' => 'bg-yellow-100 text-yellow-800',
                                'done' => 'bg-green-100 text-green-800',
                                'affectue' => 'bg-green-100 text-green-800',
                                'annule' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </p>
                    <p class="font-semibold">Créé le: <span class="text-gray-700">{{ $ticket->created_at->format('Y-m-d H:i') }}</span></p>
                </div>
                <div class="space-y-2">
                    <p class="font-semibold">Demandeur: <span class="text-gray-700">{{ $ticket->user->name }}</span></p>
                </div>
            </div>

            <!-- Articles -->
            @if($ticket->articles->isNotEmpty())
                <div class="mt-4">
                    <h5 class="font-semibold text-gray-800 mb-2">Articles demandés</h5>
                    <ul class="space-y-2">
                        @foreach($ticket->articles as $article)
                            <li class="flex justify-between items-center bg-gray-50 px-4 py-2 rounded-lg shadow-sm">
                                <span>{{ $article->nom }}</span>
                                <span class="px-2 py-1 bg-gray-300 text-gray-800 text-sm rounded-full">
                                    {{ $article->pivot->quantite_utilisee }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Back button -->
            <a href="{{ route('tickets.index') }}" class="inline-flex items-center mt-6 px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg shadow transition">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>
    </div>
</div>
@endsection
