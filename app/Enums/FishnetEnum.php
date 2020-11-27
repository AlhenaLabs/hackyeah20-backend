<?php

namespace App\Enums;

class FishnetEnum
{
    public const LOST = 'lost';
    public const PURCHASED = 'purchased';
    public const NEW = 'new';
    public const NEEDS_RENEWAL = 'needs renewal';
    public const IN_USE = 'in use';
    public const DAMAGED = 'damaged';
    public const RETURNED = 'returned';

    public const ALL = [
        self::LOST,
        self::PURCHASED,
        self::NEW,
        self::NEEDS_RENEWAL,
        self::IN_USE,
        self::DAMAGED,
        self::RETURNED
    ];
}
