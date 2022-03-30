<?php

namespace App\Enums;

use Konekt\Enum\Enum;

class ShipmentStates extends Enum
{
    const __DEFAULT = self::PENDING;

    const PENDING   = 'pending';
    const PAID      = 'paid';
    const CANCELLED = 'cancelled';
    const COMPLETED = 'delivered';
    const ONMOVE = 'In Transit';
}
