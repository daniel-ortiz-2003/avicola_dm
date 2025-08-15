<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Flock;

class HighMortalityNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $flock;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Flock $flock)
    {
        $this->flock = $flock;
        $this->message = "Alerta: Mortalidad alta detectada en el lote '{$flock->name}'.";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Se enviará por broadcast y a la base de datos para un registro persistente.
        return ['broadcast', 'database'];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => '¡Alerta de Mortalidad Alta!',
            'body' => $this->message,
            'flock_id' => $this->flock->id,
            'url' => route('flocks.show', $this->flock->id)
        ]);
    }

    /**
     * Get the array representation of the notification for the database.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => '¡Alerta de Mortalidad Alta!',
            'body' => $this->message,
            'flock_id' => $this->flock->id,
        ];
    }
}
