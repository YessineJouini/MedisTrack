<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = ['montant', 'date', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
