<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPasswordNotification extends Notification
{
    use Queueable;

    private User $user;
    private string $password;

    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $name = $this->user->name;

        return (new MailMessage)
            ->subject('WWF :: Account information')
            ->greeting("Hello $name!")
            ->line('We have generated a new access password for your account. Here is your new password.')
            ->line($this->password);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
