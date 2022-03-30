<?php

namespace App\Enums;

use Konekt\Enum\Enum;

class Locations extends Enum
{
    const __DEFAULT = self::MOMBASA;

    const MOMBASA   = 'Mombasa';
    const NAIROBI   = 'Nairobi';
}
