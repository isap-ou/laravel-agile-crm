<?php

namespace Isapp\AgileCrm\Enums;

use Isapp\AgileCrm\Contracts\EnumContract;

enum ContactPropertyType: string implements EnumContract
{
    case SYSTEM = 'SYSTEM';
    case CUSTOM = 'CUSTOM';

}
