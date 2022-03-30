<?php

namespace App\Enums;

use Konekt\Enum\Enum;

class FleetStates extends Enum
{
    const __DEFAULT = self::PENDING;

    const PENDING   = 'idle';
    const MOVING      = 'MOVING';
}
