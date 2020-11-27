<?php

namespace App\Notifications;

use App\Models\Fishnet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusReminderNotification extends Notification
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
        $fishnetRfid = $this->fishnet->rfid;

        return (new MailMessage)
            ->subject('WWF :: Fishnet status renewal reminder')
            ->greeting("Hello $name!")
            ->line("Your fishnet bought at: $fishnetBoughtDate needs status renewal.")
            ->line("Please update your fishnet status.");
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
