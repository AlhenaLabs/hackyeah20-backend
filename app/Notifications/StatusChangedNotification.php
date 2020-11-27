<?php

namespace App\Notifications;

use App\Models\Fishnet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChangedNotification extends Notification
{
    use Queueable;

    private User $user;
    private Fishnet $fishnet;

    public function __construct(User $user, Fishnet $fishnet)
    {
        $this->user = $user;
        $this->fishnet = $fishnet;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $name = $this->user->name;
        $fishnetBoughtDate = $this->fishnet->rfid;
        $fishnetState = $this->fishnet->state;

        return (new MailMessage)
            ->subject('WWF :: Fishnet status changed')
            ->greeting("Hello $name!")
            ->line("Your fishnet bought at: $fishnetBoughtDate changed status.")
            ->line("new status: $fishnetState");
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
