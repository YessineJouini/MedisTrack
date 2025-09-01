<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('article')->latest()->get();
        return view('admin.facture.index', compact('factures'));
    }

    public function create()
    {
        // Only show articles that exist
        $articles = Article::all();
        return view('admin.facture.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $article = Article::findOrFail($request->article_id);

        // Increase article stock
        $article->quantite += $request->quantite;
        $article->save();

        // Calculate montant
        $montant = $article->prix * $request->quantite;

        // Create facture
       Facture::create([
    'article_id' => $request->article_id,
    'quantite'   => $request->quantite,
    'montant'    => $montant,
    'date'       => Carbon::now(),
]);

        

        return redirect()->route('admin.factures.index')
                         ->with('success', 'Facture créée et stock mis à jour.');
    }

    public function edit(Facture $facture)
    {
        $articles = Article::all();
        return view('admin.facture.edit', compact('facture', 'articles'));
    }

    public function update(Request $request, Facture $facture)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $oldQuantity = $facture->article->quantite;

        $article = Article::findOrFail($request->article_id);

        // Adjust stock
        $article->quantite = $article->quantite - $oldQuantity + $request->quantite;
        $article->save();

        // Update facture
      $facture->update([
    'article_id' => $request->article_id,
    'quantite'   => $request->quantite,
    'montant'    => $article->prix * $request->quantite,
    'date'       => Carbon::now(),
]);


        return redirect()->route('admin.factures.index')
                         ->with('success', 'Facture mise à jour et stock ajusté.');
    }

    public function destroy(Facture $facture)
    {
        $article = $facture->article;
        $article->quantite -= ($facture->montant / $article->prix); // decrease by quantity
        $article->save();

        $facture->delete();

        return redirect()->route('admin.factures.index')
                         ->with('success', 'Facture supprimée et stock ajusté.');
    }
}
