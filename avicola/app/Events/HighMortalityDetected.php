<?php

namespace App\Events;

use App\Models\Flock;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HighMortalityDetected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The flock that is experiencing high mortality.
     *
     * @var \App\Models\Flock
     */
    public $flock;

    /**
     * The message for the notification.
     *
     * @var string
     */
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Flock $flock)
    {
        $this->flock = $flock;
        $this->message = "¡Alerta de Mortalidad Alta! El lote '{$flock->name}' ha superado el umbral.";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Se transmite en un canal privado 'admin-channel'.
        // Solo los usuarios autorizados (ej. administradores) podrán escucharlo.
        return [
            new PrivateChannel('admin-channel'),
        ];
    }
}
