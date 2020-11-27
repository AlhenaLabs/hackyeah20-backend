<?php

namespace App\Enums;

class NotificationsEnum
{
    public const FISHNET_LOST = 'FISHNET_LOST';
    public const FISHNET_STATUS_CHANGED = 'FISHNET_STATUS_CHANGED';
    public const ACCOUNT = 'ACCOUNT';
    public const FISHNET_STATUS_REMINDER = 'FISHNET_STATUS_REMINDER';

    public const ALL = [
        self::FISHNET_LOST,
        self::FISHNET_STATUS_CHANGED,
        self::ACCOUNT,
        self::FISHNET_STATUS_REMINDER
    ];
}
