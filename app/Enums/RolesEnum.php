<?php

namespace App\Enums;

class RolesEnum
{
    public const ADMINISTRATOR = 'administrator';
    public const SELLER = 'seller';
    public const CUSTOMER = 'customer';

    public const ALL = [
        self::ADMINISTRATOR,
        self::SELLER,
        self::CUSTOMER
    ];
}
