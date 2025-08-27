@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 text-white px-6 py-4 flex justify-between items-center">
            <h4 class="text-xl font-semibold">{{ $ticket->titre }}</h4>
            <span class="px-3 py-1 bg-white text-indigo-700 rounded-full font-medium text-sm">
                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
            </span>
        </div>

        <!-- Body -->
        <div class="px-6 py-6 space-y-4">
            {{-- Ticket Info --}}
            <p class="text-gray-700">{{ $ticket->description }}</p>
            <p><strong>Demandeur:</strong> <span class="text-gray-800">{{ $ticket->user->name }}</span></p>

            {{-- Articles --}}
            @if($ticket->articles->isNotEmpty())
            <div>
                <h5 class="text-lg font-semibold text-gray-700 mb-2">Articles demandés</h5>
                <ul class="space-y-2">
                    @foreach($ticket->articles as $article)
                        <li class="flex justify-between items-center bg-gray-50 px-4 py-2 rounded-lg shadow-sm">
                            <span>{{ $article->nom }}</span>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">
                                {{ $article->pivot->quantite_utilisee }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Status Update --}}
            <div>
                <h5 class="text-lg font-semibold text-gray-700 mb-2">Mise à jour du statut</h5>
                <form action="{{ route('agent.updateStatus', $ticket->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2">
                        <option value="en_cours"   {{ $ticket->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="en_attente" {{ $ticket->status == 'en_attente' ? 'selected' : '' }}>En attente (pièces manquantes)</option>
                        <option value="affectue"   {{ $ticket->status == 'affectue' ? 'selected' : '' }}>Affectué</option>
                        <option value="annule"     {{ $ticket->status == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2 shadow transition flex items-center gap-2">
                        <i class="fas fa-check"></i> Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
