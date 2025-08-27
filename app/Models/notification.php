<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['message', 'date', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
