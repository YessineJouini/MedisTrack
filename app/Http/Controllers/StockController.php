<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of stock (all articles).
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Search by name
        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('nom', 'like', "%{$q}%");
        }

        // Sorting
        $sortBy = $request->get('sort_by');
        $order = $request->get('order') === 'asc' ? 'asc' : 'desc';
        if (in_array($sortBy, ['nom', 'quantite', 'prix'])) {
            $query->orderBy($sortBy, $order);
        } else {
            $query->orderBy('nom', 'asc');
        }
$articles = $query->get();
       if (request()->is('admin/*')) {
        return view('admin.stock.index', compact('articles'));
    }

    return view('stock.index', compact('articles'));
    }

    /**
     * Show the form for creating a new stock (article).
     */
    public function create()
    {
        return view('admin.stock.create');
    }

    /**
     * Store a newly created stock (article).
     */
    public function store(Request $request)
    {
   $request->validate([
    'nom' => 'required|string|max:255',
    'min_stock' => 'required|integer|min:0',
    'prix' => 'required|numeric|min:0',
]);

Article::create([
    'nom' => $request->nom,
    'quantite' => 0,
    'min_stock' => $request->min_stock,
    'prix' => $request->prix,
]);




        return redirect()->route('admin.stock.index')
                         ->with('success', 'Nouvel article ajouté au stock !');
    }

    /**
     * Display the specified article stock.
     */
    public function show(Article $article)
    {
        return view('stock.show', compact('article'));
    }

    /**
     * Show the form for editing stock of a specific article.
     */
   public function edit(Article $stock)
{
    return view('admin.stock.edit', ['article' => $stock]);
}

public function update(Request $request, Article $stock)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'quantite' => 'required|integer|min:0',
        'prix' => 'required|numeric|min:0'
    ]);

    $stock->update($request->only(['nom', 'quantite', 'prix']));

    return redirect()->route('admin.stock.index')
                     ->with('success', "Stock de {$stock->nom} mis à jour !");
}

public function destroy(Article $stock)
{
    $stock->delete();

    return redirect()->route('admin.stock.index')
                     ->with('success', "Article supprimé du stock.");
}

}
