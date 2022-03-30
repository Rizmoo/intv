<?php

namespace App\Enums;

use Konekt\Enum\Enum;

class OrderStatus extends Enum
{
    const __DEFAULT = self::RECEIVED;

    const RECEIVED   = 'received';
    const PAID      = 'paid';
    const CANCELLED = 'cancelled';
    const COMPLETED = 'delivered';
    const ASSIGNED = 'assigned';
}
