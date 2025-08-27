<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Article;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // DB + email (optional)
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Stock faible')
                    ->line("Le stock de {$this->article->nom} est faible ({$this->article->quantite})")
                    ->action('Voir l\'article', url('/articles/'.$this->article->id));
    }

    public function toArray($notifiable)
    {
        return [
            'article_id' => $this->article->id,
            'article_name' => $this->article->nom,
            'current_quantity' => $this->article->quantite,
 'message' => "Le stock de {$this->article->nom} est faible ({$this->article->quantite})",        ];
    }
}


