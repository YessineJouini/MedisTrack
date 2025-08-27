<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
      const STATUS_EN_COURS = 'en_cours';
    const STATUS_EN_ATTENTE = 'en_attente';
    const STATUS_AFFECTUE = 'affectue';
    const STATUS_ANNULER = 'annuler';
    
    protected $fillable = ['titre', 'description', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_ticket')
                    ->withPivot('quantite_utilisee')
                    ->withTimestamps();
    }
}

