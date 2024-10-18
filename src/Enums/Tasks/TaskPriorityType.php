<?php

namespace IsapOu\AgileCrm\Enums\Tasks;

use IsapOu\AgileCrm\Contracts\EnumContract;

enum TaskPriorityType: string implements EnumContract
{
    case HIGH = 'HIGH';
    case NORMAL = 'NORMAL';
    case LOW = 'LOW';

}
