<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Facture;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
class AdminController extends Controller
{
    public function dashboard()
{
    // Articles
    $totalArticles = Article::count();
    $totalStockValue = Article::sum(DB::raw('quantite * prix'));
    $lowStock = Article::whereColumn('quantite', '<', 'min_stock')->count();

    // Factures
    $totalFactures = Facture::count();
    $factureQuantite = Facture::sum('quantite');
    $facturesPerMonth = Facture::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')->pluck('count','month');

    // Tickets
    $totalTickets = Ticket::count();
    $ticketQuantite = DB::table('article_ticket')->sum('quantite_utilisee'); // if pivot
    $ticketsPerMonth = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')->pluck('count','month');
        $ticketValeur = \App\Models\Ticket::with('articles')->get()
    ->sum(function ($ticket) {
        return $ticket->articles->sum(function ($article) {
            return $article->pivot->quantite_utilisee * $article->prix;
        });
    });
    // Users
    $totalUsers = User::count();
    $admins = User::where('role', 'admin')->count();
    $agents = User::where('role', 'agent')->count();

    return view('admin.dashboard.dashboard', compact(
        'totalArticles','totalStockValue','lowStock',
        'totalFactures','factureQuantite','facturesPerMonth',
        'totalTickets','ticketQuantite','ticketsPerMonth',
        'totalUsers','admins','agents','ticketValeur'
        
    ));
}

}
