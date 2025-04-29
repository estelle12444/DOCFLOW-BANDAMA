<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $status;
    public $order;

    // Constructeur de la notification
    public function __construct($status, $order)
    {
        $this->status = $status;
        $this->id = $order;
    }

    // Méthode de notification par base de données
    public function via($notifiable)
    {
        return ['database'];
    }

    // Contenu de la notification
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order,
            'status' => $this->status,
            'message' => $this->status == 'confirmed'
                ? "L'ordre {$this->order} est validé et en cours de traitement."
                : "L'ordre {$this->order} a des irrégularités, veuillez vérifier les documents."
        ];
    }
}
