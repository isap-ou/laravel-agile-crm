<?php

namespace Isapp\AgileCrm\Enums\Tasks;

use Isapp\AgileCrm\Contracts\EnumContract;

enum TaskPriorityType: string implements EnumContract
{
    case HIGH = 'HIGH';
    case NORMAL = 'NORMAL';
    case LOW = 'LOW';

}
