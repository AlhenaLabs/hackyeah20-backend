<?php

namespace App\Models;

use App\Enums\NotificationsEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification as NotificationClass;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['user_id', 'type'];

    public static function send(User $user, NotificationClass $notification, string $type): void
    {
        if (!in_array($type, NotificationsEnum::ALL)) {
            throw new BadRequestHttpException('Notification type not exist!');
        }

        NotificationFacade::send($user, $notification);

        Notification::create([
            'user_id' => $user->id,
            'type' => $type,
        ]);
    }
}
