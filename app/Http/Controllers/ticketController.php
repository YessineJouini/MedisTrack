<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Show all tickets of the logged-in demandeur.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->tickets();

        // Dynamic sorting
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

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show form to create a new ticket.
     */
 public function create()
{
    $articles = Article::select('id', 'nom', 'quantite')->orderBy('nom')->get();
    return view('tickets.create', compact('articles'));
}


    /**
     * Store a new ticket from the demandeur.
     */
   public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'articles' => 'array', 
        'articles.*' => 'integer|min:0', 
    ]);

    $ticket = Ticket::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'status' => Ticket::STATUS_EN_COURS,
        'user_id' => Auth::id(),
    ]);

   
    if ($request->has('articles')) {
        $articles = [];

        foreach ($request->articles as $id => $qty) {
            if ($qty > 0) {
                $articles[$id] = ['quantite_utilisee' => $qty];
            }
        }

        if (!empty($articles)) {
            $ticket->articles()->attach($articles);
        }
    }

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Votre ticket a été créé avec succès.');
}


    
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        return view('tickets.show', compact('ticket'));
    }
}
