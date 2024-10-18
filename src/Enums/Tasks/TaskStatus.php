<?php

namespace IsapOu\AgileCrm\Enums\Tasks;

use IsapOu\AgileCrm\Contracts\EnumContract;

enum TaskStatus: string implements EnumContract
{
    case YET_TO_START = 'YET_TO_START';
    case IN_PROGRESS = 'IN_PROGRESS';
    case COMPLETED = 'COMPLETED';

}
