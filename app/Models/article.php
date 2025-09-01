<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['nom', 'quantite', 'prix' , 'min_quantite'];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'article_ticket')
                    ->withPivot('quantite_utilisee')
                    ->withTimestamps();
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}

