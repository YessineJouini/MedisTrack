@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-2">
        <i class="fas fa-chart-line text-indigo-600"></i> Tableau de Bord
    </h1>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Articles -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-box text-blue-600"></i> Articles
                </h2>
                <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-semibold">
                    {{ $totalArticles }} total
                </span>
            </div>
            <p class="text-gray-600">
                <i class="fas fa-coins text-yellow-500 mr-1"></i> Valeur stock : 
                <span class="font-semibold">{{ $totalStockValue }} €</span>
            </p>
            <p class="text-gray-600 mt-1">
                <i class="fas fa-exclamation-triangle text-red-500 mr-1"></i> Faible stock : 
                <span class="font-semibold">{{ $lowStock }}</span>
            </p>
        </div>

        <!-- Factures -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-file-invoice text-green-600"></i> Factures
                </h2>
                <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                    {{ $totalFactures }} total
                </span>
            </div>
            <p class="text-gray-600">
                <i class="fas fa-plus-circle text-green-500 mr-1"></i> Quantité ajoutée : 
                <span class="font-semibold">{{ $factureQuantite }}</span>
            </p>
        </div>

        <!-- Tickets -->
        <!-- Tickets -->
<div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-ticket-alt text-purple-600"></i> Tickets
        </h2>
        <span class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-full font-semibold">
            {{ $totalTickets }} total
        </span>
    </div>
    <p class="text-gray-600">
        <i class="fas fa-minus-circle text-red-500 mr-1"></i> Quantité utilisée : 
        <span class="font-semibold">{{ $ticketQuantite }}</span>
    </p>
    <p class="text-gray-600 mt-1">
        <i class="fas fa-euro-sign text-indigo-600 mr-1"></i> Valeur totale : 
        <span class="font-semibold">{{ $ticketValeur }} €</span>
    </p>
</div>

    </div>
</div>
@endsection
