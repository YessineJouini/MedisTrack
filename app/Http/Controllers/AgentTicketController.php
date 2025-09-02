<?php

namespace App\Http\Controllers;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentTicketController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Ticket::with('user', 'articles');

        // Tr
        if ($request->has('sort_by') && $request->has('order')) {
            $sortBy = $request->get('sort_by');
            $order = $request->get('order') === 'asc' ? 'asc' : 'desc';
            if (in_array($sortBy, ['id', 'titre', 'status', 'created_at'])) {
                $query->orderBy($sortBy, $order);
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $tickets = $query->get();
        return view('agent.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'articles')->findOrFail($id);
        return view('agent.show', compact('ticket'));
    }


public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:en_cours,en_attente,affectue,annule'
    ]);

    $ticket = Ticket::findOrFail($id);

    if ($request->status === Ticket::STATUS_AFFECTUE && $ticket->status !== Ticket::STATUS_AFFECTUE) {
        foreach ($ticket->articles as $article) {
            // Reduce stock
            $article->quantite -= $article->pivot->quantite_utilisee;
            $article->save();

            // Check low stock
            if ($article->quantite <= $article->min_stock) {
                // Get all agents
 $users = User::whereIn(DB::raw('LOWER(role)'), ['agent', 'admin'])->get();
                // Send notification
                Notification::send($users, new LowStockNotification($article));
            }
        }
    }

    // Update ticket status
    $ticket->status = $request->status;
    $ticket->save();

    return redirect()->route('agent.index')->with('success', 'Statut du ticket mis à jour avec succès.');
}


}
