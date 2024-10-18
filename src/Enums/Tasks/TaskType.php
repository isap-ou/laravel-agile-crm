<?php

namespace IsapOu\AgileCrm\Enums\Tasks;

use IsapOu\AgileCrm\Contracts\EnumContract;

enum TaskType: string implements EnumContract
{
    case CALL = 'CALL';
    case EMAIL = 'EMAIL';
    case FOLLOW_UP = 'FOLLOW_UP';
    case MEETING = 'MEETING';
    case MILESTONE = 'MILESTONE';
    case SEND = 'SEND';
    case TWEET = 'TWEET';
    case OTHER = 'OTHER';
}
